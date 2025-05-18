<script>
    var hostUrl = "{{ asset('') }}";
</script>

<script src="{{ asset('plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('js/scripts.bundle.js') }}"></script>


@stack('script')
@stack('js')
