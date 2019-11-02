@extends('web.master')

@push('top_stylesheets_stack')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha256-l85OmPOjvil/SOvVt3HnSSjzF1TUMyT9eV0c2BzEGzU=" crossorigin="anonymous" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,400i,700,800,900&display=swap">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/css/swiper.min.css" integrity="sha256-DBYdrj7BxKM3slMeqBVWX2otx7x4eqoHRJCsSDJ0Nxw=" crossorigin="anonymous" />
@endpush

@push('top_scripts_stack')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/js/swiper.min.js" integrity="sha256-4sETKhh3aSyi6NRiA+qunPaTawqSMDQca/xLWu27Hg4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js" integrity="sha256-S1J4GVHHDMiirir9qsXWc8ZWw74PHHafpsHp5PXtjTs=" crossorigin="anonymous"></script>
@endpush

@section('top_info')
<!--
--------------------------------
VSPOT - Digital Signage Solution
https://www.vspot.eu/
--------------------------------
Benutzer: {{ $user->name }}
Gerät: {{ $device->display_name }}
Location: {{ $device->location }}
@unless($noChannel)
Kanal: {{ $channel->name }}
@endunless
--------------------------------
-->
@endsection

@unless($noChannel)
@section('top_css')
@parent()
<style>
/* dynamic css for screens */
@foreach ($screens as $screen)
{{ '.swiper-slide-'. $loop->iteration . ' {' }}
@if(!empty($screen->background_color))
    background-color: {{ $screen->background_color }};
@endif
@if(!empty($screen->bg_img_cdn_link))
    background-image: url({{ $screen->bg_img_cdn_link }});
@endif
@if(!empty($screen->text_color))
    color: {{ $screen->text_color }};
@endif
{{ '}' }}
@endforeach
/* end dynamic css for screens */
</style>
@endsection
@endunless

@section('content')
<main id="screens-container" class="swiper-container">
    <section class="swiper-wrapper">
        @if($noChannel)
            <article class="swiper-slide">
                <h1 class="heading heading--main">{{ $device->display_name }}</h1>
                <p>Dieses Gerät ist keinem Channel zugeordnet</p>
            </article>
        @else
            @forelse ($screens as $screen)
                <article id="swiper-slide-id-{{ $loop->iteration }}" class="swiper-slide swiper-slide-{{ $loop->iteration }}">
                    @if(!empty($screen->overlay_color))
                    <div class="overlay" style="background-color: {{ $screen->overlay_color }}"></div>
                    @endif
                    @includeFirst(['web.screentype.'.strtolower($screen->layout->name), 'web._layout_missing'])
                </article>
            @empty
                <article class="swiper-slide">
                    <h1 class="heading heading--main">{{ $channel->name }}</h1>
                    <p>Dieser Kanal ist leer</p>
                </article>
            @endforelse
        @endif
    </section>
    @if(!$noChannel && $screens->count() > 2)
    <div class="swiper-pagination"></div>
    @endif
</main>
<aside id="notification" class="pulse"></aside>
@endsection

@section('bottom_scripts')
<script>
(function initWebAccess() {

    var l = console.log;

    var notification = document.getElementById('notification');
    var visibleClass = 'visible';

    var lastVersion = false;
    var isOffline = false;

    var displayTime = {{ $channel->display_time ?? 5000 }};
    var transitionTime = {{ $channel->transition_time ??  1000 }};
    var refreshTime = {{ $channel->refresh_time ??  5 }} * 1000;

    var swiper = new Swiper('.swiper-container', {
        direction: 'vertical',
        @if(!$noChannel && $screens->count() > 1)
        loop: true,
        parallax:true,
        autoplay: {
            delay: displayTime,
        },
        preloadImages: false,
        @endif
        effect: 'fade',
        allowTouchMove: false,
        speed: transitionTime,
        @if(!$noChannel && $screens->count() > 2)
        pagination: {
            el: '.swiper-pagination',
            type: 'bullets'
        }
        @endif
    });

    function isNetworkError(error) {
        return !!error.isAxiosError && !error.response;
    }

    (function refresh() {
        setTimeout(function() {
            axios.get('{!! $device->webURLUpdate !!}')
                .then(function (response) {
                    var newVersion = response.data.lastUpdate;
                    if(lastVersion && newVersion > lastVersion) {
                        location.reload();
                    } else {
                        lastVersion = newVersion;
                    }
                    // notification.textContent='';
                    isOffline = false;
                    if (notification.classList.contains(visibleClass)) {
                        notification.classList.remove(visibleClass);
                    }
                    // l("Letzte Version: " + lastVersion + " / Neue Version: " + newVersion);
                })
                .catch(function (error) {
                    if (isNetworkError(error)) {
                        var errorEvent = new Date();
                        var dateOptions = { weekday: 'long', year: 'numeric', month: '2-digit', day: '2-digit', hour: '2-digit', minute: '2-digit', second: '2-digit'};
                        var eventDateTimeString = 'Offline seit ' + (errorEvent.toLocaleDateString('de-DE', dateOptions)) + ' Uhr';
                        l(eventDateTimeString);
                        if(!isOffline) notification.textContent = eventDateTimeString;
                        if (!notification.classList.contains(visibleClass)) {
                            notification.classList.add(visibleClass);
                        }
                        isOffline = true;
                    }
                    l(error);
                })
                .finally(function () {
                    refresh();
                });
        }, refreshTime);
    })();

})();
</script>
@endsection
