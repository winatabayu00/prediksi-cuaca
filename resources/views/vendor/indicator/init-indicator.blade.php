<link href="{{ cachedAsset('vendor/indicator/plugins.bundle.css') }}" rel="stylesheet" type="text/css"/>
<script src="{{ cachedAsset('vendor/indicator/plugins.bundle.js') }}"></script>

@php
    $indicatorConfig = \Illuminate\Support\Facades\Session::get('notify.config');
    $indicatorConfig = json_decode($indicatorConfig, true);
@endphp

@isset($indicatorConfig)
    @if($indicatorConfig['mode'] == 'alert')

    @else
        <script>
            toastr.options = @json($indicatorConfig);

            @switch($indicatorConfig['type'])
            @case('success')
            toastr.success("{{ $indicatorConfig['text'] }}", "{{ $indicatorConfig['title'] }}");
            @break
            @case('info')
            toastr.info("{{ $indicatorConfig['text'] }}", "{{ $indicatorConfig['title'] }}");
            @break
            @case('warning')
            toastr.warning("{{ $indicatorConfig['text'] }}", "{{ $indicatorConfig['title'] }}");
            @break
            @case('error')
            toastr.error("{{ $indicatorConfig['text'] }}", "{{ $indicatorConfig['title'] }}");
            @break
            @endswitch
        </script>
    @endif
@endisset

@if($errors->any())
    @foreach($errors->all() as $error)
        <script type="text/javascript">
            toastr.warning("{{ $error }}", "!Validation Alert!");
        </script>
    @endforeach
@endif
