<script>
    toast.settings({
        timeout: 7000,
        titleColor: '#ffffff',
        messageColor: '#ffffff',
        backgroundColor: '#333333',
        progressBarColor: '#c70038',
        theme: 'dark',
    });

    @if ($message = Session::get('toast'))
        toast.show({
            message: '{{ $message }}',
        });
    @endif

    @if ($message = Session::get('toast-overlay'))
        toast.show({
            overlay: true,
            displayMode: 'once',
            zindex: 999,
            message: '{{ $message }}',
            position: 'center',
        });
    @endif

    @if ($message = Session::get('toast-info'))
        toast.show({
            title: 'Info:',
            message: '{{ $message }}',
            icon: 'fas fa-info-circle',
        });
    @endif

    @if ($message = Session::get('toast-success'))
        toast.show({
            title: 'Ok!',
            message: '{{ $message }}',
            icon: 'fas fa-check-circle',
        });
    @endif

    @if ($message = Session::get('toast-warning'))
        toast.show({
            title: 'Warnung:',
            message: '{{ $message }}',
            icon: 'fas fa-exclamation-circle',
        });
    @endif

    @if ($message = Session::get('toast-error'))
        toast.show({
            title: 'Fehler:',
            message: '{{ $message }}',
            icon: 'fas fa-exclamation-triangle',
        });
    @endif

    @if ($message = Session::get('toast-message'))
        toast.show({
            message: '{{ $message }}',
            icon: 'far fa-envelope',
        });
    @endif

</script>
