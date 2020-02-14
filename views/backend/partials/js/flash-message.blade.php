<script>
    iziToast.settings({
        timeout: 2400,
        theme: 'dark',
        progressBarColor: '#c70038',
        backgroundColor: '#1a2226',
        layout: 2,
        class: 'vspot-toast'
    });
    @if ($message = Session::get('flash'))
        iziToast.show({
            message: '{{ $message }}'
        });
    @endif
    @if ($message = Session::get('flash-key'))
        iziToast.show({
            title: 'Zugang',
            message: '{{ $message }}',
            icon: 'fas fa-key'
        });
    @endif
    @if ($message = Session::get('flash-info'))
        iziToast.show({
            title: 'Information',
            message: '{{ $message }}',
            icon: 'fas fa-info'
        });
    @endif
    @if ($message = Session::get('flash-success'))
        iziToast.show({
            title: 'Ok',
            message: '{{ $message }}',
            icon: 'fas fa-check-circle'
        });
    @endif
    @if ($message = Session::get('flash-warning'))
        iziToast.show({
            title: 'Warnung',
            message: '{{ $message }}',
            icon: 'fas fa-exclamation-triangle'
        });
    @endif
    @if ($message = Session::get('flash-error'))
        iziToast.show({
            title: 'Fehler',
            message: '{{ $message }}',
            icon: 'fas fa-bug'
        });
    @endif
</script>
