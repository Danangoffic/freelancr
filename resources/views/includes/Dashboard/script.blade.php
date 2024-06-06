<script src="{{url('https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js')}}" defer></script>
<script src="{{asset('js/dashboard/init-alpine.js')}}"></script>
<script>
    function lo(a) {
        event.preventDefault();
        document.querySelector(a).submit();
    }
</script>
