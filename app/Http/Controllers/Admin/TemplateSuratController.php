<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisSurat;
use App\Models\SuratField;
use App\Services\SuratFieldResolver;
use App\Services\TemplateSuratService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class TemplateSuratController extends Controller
{
    public function __construct(private readonly SuratFieldResolver $resolver) {}

    public function index()
    {

        $user = auth()->user();

        $query = JenisSurat::query();


        if ($user->role === 'admin_desa') {
            $query->where('desa_id', $user->desa_id);
        }

        $templates = $query->latest()->paginate(12);

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
                Rule::unique('jenis_surats', 'kode')
                    ->where(fn ($query) => $query->where('desa_id', auth()->user()?->desa_id ?? null)),
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

        $payload = [
            'nama' => $validated['nama'],
            'kode' => strtoupper($validated['kode']),
            'deskripsi' => $validated['deskripsi'] ?? null,
            'template' => $path,
            'aktif' => true,
        ];


        if (auth()->user()->role === 'admin_desa') {
            $payload['desa_id'] = auth()->user()->desa_id;
        }

        $jenis = JenisSurat::create($payload);


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

        if (auth()->user()->role === 'admin_desa') {
            abort_unless($templateSurat->desa_id === auth()->user()->desa_id, 403);
        }

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

        if (auth()->user()->role === 'admin_desa') {
            abort_unless($templateSurat->desa_id === auth()->user()->desa_id, 403);
        }

        $templateSurat->load('fields');

        $placeholders = session('placeholders');

        if (empty($placeholders) && $templateSurat->template) {
            $service = app(TemplateSuratService::class);
            $existing = $templateSurat->fields->pluck('nama_field')->all();
            $placeholders = array_values(array_diff(
                $service->extractPlaceholders($templateSurat->template),
                $existing
            ));
        }

        return view(
            'admin.template-surat.fields',
            compact('templateSurat', 'placeholders')
        );
    }

    public function storeField(Request $request, JenisSurat $templateSurat)
    {
        if (auth()->user()->role === 'admin_desa') {
            abort_unless($templateSurat->desa_id === auth()->user()->desa_id, 403);
        }

        $validated = $this->validateField($request, $templateSurat);

        $payload = $this->fieldPayload($validated, $request->boolean('wajib'));

        if ($templateSurat->fields()->where('nama_field', $payload['nama_field'])->exists()) {
            return back()->with('error', 'Nama field sudah ada untuk template ini. Gunakan nama lain.');
        }

        $templateSurat->fields()->create($payload);

        $remainingPlaceholders = $this->remainingPlaceholders($templateSurat);

        return back()
            ->with('success', 'Field surat berhasil ditambahkan.')
            ->with('placeholders', $remainingPlaceholders);
    }

    public function editField(JenisSurat $templateSurat, SuratField $field)
    {
        if (auth()->user()->role === 'admin_desa') {
            abort_unless($templateSurat->desa_id === auth()->user()->desa_id, 403);
        }

        $this->ensureFieldBelongsToTemplate($templateSurat, $field);

        return view('admin.template-surat.field-edit', compact('templateSurat', 'field'));
    }

    public function updateField(Request $request, JenisSurat $templateSurat, SuratField $field)
    {
        if (auth()->user()->role === 'admin_desa') {
            abort_unless($templateSurat->desa_id === auth()->user()->desa_id, 403);
        }

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
        if (auth()->user()->role === 'admin_desa') {
            abort_unless($templateSurat->desa_id === auth()->user()->desa_id, 403);
        }

        $this->ensureFieldBelongsToTemplate($templateSurat, $field);

        $field->delete();

        return back()->with('success', 'Field surat berhasil dihapus.');
    }


    public function bulkCreate(Request $request, JenisSurat $templateSurat)
    {
        if (auth()->user()->role === 'admin_desa') {
            abort_unless($templateSurat->desa_id === auth()->user()->desa_id, 403);
        }

        $placeholders = $request->input('placeholders', session('placeholders', []));

        if (! is_array($placeholders)) {

            $placeholders = is_string($placeholders) ? array_filter(array_map('trim', explode(',', $placeholders))) : [];
        }

        if (empty($placeholders)) {
            return back()->with('error', 'Tidak ada placeholder untuk dibuat.');
        }

        $created = [];
        $skipped = [];
        $normalizedPlaceholders = [];

        foreach ($placeholders as $ph) {
            $raw = trim((string) $ph);
            if ($raw === '') {
                continue;
            }

            $name = preg_replace('/[^a-z0-9_]/', '', str_replace(' ', '_', mb_strtolower($raw)));
            if ($name === '') {
                continue;
            }

            $normalizedPlaceholders[] = $name;
        }

        $normalizedPlaceholders = array_values(array_unique($normalizedPlaceholders));

        $maxUrutan = (int) $templateSurat->fields()->max('urutan');

        $profileKeys = array_map(fn ($v) => strtolower($v), array_keys($this->resolver->automaticData(auth()->user())));

        foreach ($normalizedPlaceholders as $name) {
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

        $remainingPlaceholders = array_values(array_diff($normalizedPlaceholders, $created, $skipped));

        $msg = 'Bulk create selesai.';
        if ($created) {
            $msg .= ' Dibuat: '.implode(', ', $created).'.';
        }
        if ($skipped) {
            $msg .= ' Dilewati (sudah ada): '.implode(', ', $skipped).'.';
        }
        if ($remainingPlaceholders) {
            $msg .= ' Masih tersisa: '.implode(', ', $remainingPlaceholders).'.';
        }

        return back()
            ->with('success', $msg)
            ->with('placeholders', $remainingPlaceholders);
    }

    private function remainingPlaceholders(JenisSurat $templateSurat): array
    {
        $templateSurat->refresh();

        $allPlaceholders = session('placeholders');

        if (empty($allPlaceholders) && $templateSurat->template) {
            $allPlaceholders = app(TemplateSuratService::class)->extractPlaceholders($templateSurat->template);
        }

        if (! is_array($allPlaceholders)) {
            $allPlaceholders = [];
        }

        $existing = $templateSurat->fields()->pluck('nama_field')->all();

        return array_values(array_diff(array_values(array_unique($allPlaceholders)), $existing));
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
            'options' => ['nullable', 'string', 'max:2000'],
            'wajib' => ['nullable', 'boolean'],
            'urutan' => ['nullable', 'integer', 'min:0'],
        ]);
    }

    private function fieldPayload(array $validated, bool $wajib): array
    {
        $raw = $validated['nama_field'];

        $name = preg_replace('/[^a-z0-9_]/', '', str_replace(' ', '_', mb_strtolower($raw)));

        $options = null;

        if (($validated['tipe'] ?? 'text') === 'select') {
            $options = $this->normalizeSelectOptions($validated['options'] ?? '');
        }

        return [
            'nama_field' => $name,
            'name' => $name,
            'label' => $validated['label'],
            'sumber_data' => $validated['sumber_data'],
            'tipe' => $validated['tipe'],
            'type' => $validated['tipe'] === 'select' ? 'select' : $validated['tipe'],
            'wajib' => $wajib,
            'required' => $wajib,
            'urutan' => $validated['urutan'] ?? 0,
            'options' => $options,
        ];
    }

    private function normalizeSelectOptions(string $raw): ?array
    {
        $entries = preg_split('/\r\n|\n|,/', $raw);

        if (! is_array($entries)) {
            return null;
        }

        $filtered = array_values(array_filter(array_map(fn ($value) => trim((string) $value), $entries), fn ($value) => $value !== ''));

        return $filtered === [] ? null : $filtered;
    }

    private function ensureFieldBelongsToTemplate(JenisSurat $templateSurat, SuratField $field): void
    {
        abort_unless($field->jenis_surat_id === $templateSurat->id, 404);
    }
}
