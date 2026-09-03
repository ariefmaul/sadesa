<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisSurat;
use App\Models\SuratField;
use App\Services\TemplateSuratService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class TemplateSuratController extends Controller
{
    public function index()
    {
        // Use pagination so the view can render links() properly
        $templates = JenisSurat::latest()->paginate(12);

        return view('admin.template-surat.index', compact('templates'));
    }

    public function create()
    {
        return view('admin.template-surat.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => [
                'required',
                'string',
                'max:255',
            ],

            'kode' => [
                'required',
                'string',
                'max:50',
                'unique:jenis_surats,kode',
            ],

            'deskripsi' => [
                'nullable',
                'string',
            ],

            'template' => [
                'required',
                'file',
                'mimes:docx',
                'max:10240',
            ],
        ]);

        $file = $request->file('template');

        $filename = Str::slug($validated['kode'])
            .'-'.time()
            .'.docx';

        $path = $file->storeAs(
            'templates',
            $filename,
            'public'
        );

        $jenis = JenisSurat::create([
            'nama' => $validated['nama'],
            'kode' => strtoupper($validated['kode']),
            'deskripsi' => $validated['deskripsi'] ?? null,
            'template' => $path,
            'aktif' => true,
        ]);

        // Extract placeholders from uploaded template and redirect to fields view
        try {
            $service = app(TemplateSuratService::class);
            $placeholders = $service->extractPlaceholders($path);
        } catch (\Throwable $e) {
            $placeholders = [];
        }

        return redirect()
            ->route('admin.template-surat.fields', $jenis)
            ->with('success', 'Template surat berhasil ditambahkan.')
            ->with('placeholders', $placeholders);
    }

    public function destroy(JenisSurat $templateSurat)
    {
        if ($templateSurat->template) {
            \Storage::disk('public')
                ->delete($templateSurat->template);
        }

        $templateSurat->delete();

        return redirect()
            ->route('admin.template-surat.index')
            ->with('success', 'Template surat berhasil dihapus.');
    }

    public function fields(JenisSurat $templateSurat)
    {
        $templateSurat->load('fields');

        $placeholders = session('placeholders', []);

        return view(
            'admin.template-surat.fields',
            compact('templateSurat', 'placeholders')
        );
    }

    public function storeField(Request $request, JenisSurat $templateSurat)
    {
        $validated = $this->validateField($request, $templateSurat);

        $payload = $this->fieldPayload($validated, $request->boolean('wajib'));

        if ($templateSurat->fields()->where('nama_field', $payload['nama_field'])->exists()) {
            return back()->with('error', 'Nama field sudah ada untuk template ini. Gunakan nama lain.');
        }

        $templateSurat->fields()->create($payload);

        return back()
            ->with('success', 'Field surat berhasil ditambahkan.');
    }

    public function editField(JenisSurat $templateSurat, SuratField $field)
    {
        $this->ensureFieldBelongsToTemplate($templateSurat, $field);

        return view('admin.template-surat.field-edit', compact('templateSurat', 'field'));
    }

    public function updateField(Request $request, JenisSurat $templateSurat, SuratField $field)
    {
        $this->ensureFieldBelongsToTemplate($templateSurat, $field);

        $validated = $this->validateField($request, $templateSurat, $field);

        $payload = $this->fieldPayload($validated, $request->boolean('wajib'));

        if ($templateSurat->fields()->where('nama_field', $payload['nama_field'])->where('id', '!=', $field->id)->exists()) {
            return back()->with('error', 'Nama field sudah ada untuk template ini. Gunakan nama lain.');
        }

        $field->update($payload);

        return redirect()
            ->route('admin.template-surat.fields', $templateSurat)
            ->with('success', 'Field surat berhasil diperbarui.');
    }

    public function destroyField(JenisSurat $templateSurat, SuratField $field)
    {
        $this->ensureFieldBelongsToTemplate($templateSurat, $field);

        $field->delete();

        return back()->with('success', 'Field surat berhasil dihapus.');
    }

    /**
     * Bulk create fields from detected placeholders.
     */
    public function bulkCreate(Request $request, JenisSurat $templateSurat)
    {
        $placeholders = $request->input('placeholders', session('placeholders', []));

        if (! is_array($placeholders)) {
            // allow comma separated
            $placeholders = is_string($placeholders) ? array_filter(array_map('trim', explode(',', $placeholders))) : [];
        }

        if (empty($placeholders)) {
            return back()->with('error', 'Tidak ada placeholder untuk dibuat.');
        }

        $created = [];
        $skipped = [];

        $maxUrutan = (int) $templateSurat->fields()->max('urutan');

        $profileKeys = array_map(fn($v) => strtolower($v), array_keys($this->resolver->automaticData(auth()->user())));

        foreach ($placeholders as $ph) {
            $raw = trim((string) $ph);
            if ($raw === '') continue;

            $name = preg_replace('/[^a-z0-9_]/', '', str_replace(' ', '_', mb_strtolower($raw)));

            if ($templateSurat->fields()->where('nama_field', $name)->exists()) {
                $skipped[] = $name;
                continue;
            }

            $label = ucwords(str_replace('_', ' ', $name));

            $sumber = in_array($name, $profileKeys, true) ? 'profil' : 'pengajuan';
            if ($name === 'desa' || str_ends_with($name, 'desa')) {
                $sumber = 'desa';
            }

            $maxUrutan++;

            $payload = [
                'nama_field' => $name,
                'name' => $name,
                'label' => $label,
                'sumber_data' => $sumber,
                'tipe' => 'text',
                'type' => 'text',
                'wajib' => false,
                'required' => false,
                'urutan' => $maxUrutan,
            ];

            $templateSurat->fields()->create($payload);
            $created[] = $name;
        }

        $msg = 'Bulk create selesai.';
        if ($created) {
            $msg .= ' Dibuat: '.implode(', ', $created).'.';
        }
        if ($skipped) {
            $msg .= ' Dilewati (sudah ada): '.implode(', ', $skipped).'.';
        }

        return back()->with('success', $msg);
    }

    private function validateField(Request $request, JenisSurat $templateSurat, ?SuratField $field = null): array
    {
        return $request->validate([
            'nama_field' => [
                'required',
                'string',
                'max:100',
                'regex:/^[A-Za-z0-9_\s]+$/',
            ],
            'label' => ['required', 'string', 'max:255'],
            'sumber_data' => ['required', Rule::in(['user', 'profil', 'desa', 'pengajuan'])],
            'tipe' => ['required', Rule::in(['text', 'textarea', 'date', 'number', 'email', 'select'])],
            'wajib' => ['nullable', 'boolean'],
            'urutan' => ['nullable', 'integer', 'min:0'],
        ]);
    }

    private function fieldPayload(array $validated, bool $wajib): array
    {
        $raw = $validated['nama_field'];
        // normalize: lowercase, spaces -> underscore, allow only a-z0-9_
        $name = preg_replace('/[^a-z0-9_]/', '', str_replace(' ', '_', mb_strtolower($raw)));

        return [
            'nama_field' => $name,
            'name' => $name,
            'label' => $validated['label'],
            'sumber_data' => $validated['sumber_data'],
            'tipe' => $validated['tipe'],
            'type' => $validated['tipe'] === 'select' ? 'text' : $validated['tipe'],
            'wajib' => $wajib,
            'required' => $wajib,
            'urutan' => $validated['urutan'] ?? 0,
        ];
    }

    private function ensureFieldBelongsToTemplate(JenisSurat $templateSurat, SuratField $field): void
    {
        abort_unless($field->jenis_surat_id === $templateSurat->id, 404);
    }
}
