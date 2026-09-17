

import Alpine from 'alpinejs';
import { Html5Qrcode } from 'html5-qrcode';
import Swal from 'sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

window.Swal = Swal;
window.Alpine = Alpine;
window.Html5Qrcode = Html5Qrcode;

Alpine.start();

const setupDeleteConfirmations = () => {
    document.querySelectorAll('form[data-confirm-delete]').forEach((form) => {
        form.addEventListener('submit', (event) => {
            event.preventDefault();
            form.dataset.noLoader = 'true';

            const title = form.dataset.confirmTitle || 'Hapus data ini?';
            const text = form.dataset.confirmText || 'Data yang sudah dihapus tidak dapat dikembalikan.';
            const confirmButtonText = form.dataset.confirmButtonText || 'Hapus';
            const cancelButtonText = form.dataset.cancelButtonText || 'Batal';

            Swal.fire({
                title,
                text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0A2540',
                cancelButtonColor: '#64748b',
                confirmButtonText,
                cancelButtonText,
                reverseButtons: true,
            }).then((result) => {
                delete form.dataset.noLoader;

                if (result.isConfirmed) {
                    if (typeof window.showCrudLoader === 'function') {
                        window.showCrudLoader('Menghapus...');
                    }

                    form.submit();
                }
            });
        });
    });
};

window.addEventListener('DOMContentLoaded', setupDeleteConfirmations);
