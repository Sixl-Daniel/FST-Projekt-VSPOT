<script>
if ('serviceWorker' in navigator ) {
    window.addEventListener('load', function() {
        navigator.serviceWorker.register('/service-worker.js').then(function(registration) {
            // registration sw successful
            console.log('ServiceWorker registration for VSPOT successful with scope: ', registration.scope);
        }, function(error) {
            // registration sw failed
            console.log('ServiceWorker registration for VSPOT failed: ', error);
        });
    });
}
</script>
