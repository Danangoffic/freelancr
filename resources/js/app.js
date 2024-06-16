import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
function getConfirmCall(title) {
    return Swal.fire({
        title,
        showCancelButton: true,
        confirmButtonText: "Yes",
    });
}
