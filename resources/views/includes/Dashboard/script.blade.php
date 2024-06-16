<script src="{{ url('https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js') }}" defer></script>
<script src="{{ asset('js/dashboard/init-alpine.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function getConfirmCall(title) {
        return Swal.fire({
            title,
            showCancelButton: true,
            confirmButtonText: "Yes",
            icon: "warning"
        });
    }

    function lo(a) {
        event.preventDefault();
        document.querySelector(a).submit();
    }
</script>
