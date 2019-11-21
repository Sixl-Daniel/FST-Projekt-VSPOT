<script>
    const Flash = Swal.mixin({
        showConfirmButton: false,
        timer: 4000,
        backdrop: 'rgba(34,45,50,0.95)'
    })
    @if ($message = Session::get('flash'))
        Flash.fire('{{ $message }}');
    @endif
    @if ($message = Session::get('flash-info'))
        Flash.fire({
            title: '{{ $message }}',
            type: 'info'
        });
    @endif
    @if ($message = Session::get('flash-success'))
        Flash.fire({
            title: '{{ $message }}',
            type: 'success'
        });
    @endif
    @if ($message = Session::get('flash-warning'))
        Flash.fire({
            title: '{{ $message }}',
            type: 'warning'
        });
    @endif
    @if ($message = Session::get('flash-error'))
        Flash.fire({
            title: '{{ $message }}',
            type: 'error'
        });
    @endif
</script>
