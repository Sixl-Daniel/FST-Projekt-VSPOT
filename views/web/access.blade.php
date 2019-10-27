@extends('web.master')

@push('top_stylesheets')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha256-l85OmPOjvil/SOvVt3HnSSjzF1TUMyT9eV0c2BzEGzU=" crossorigin="anonymous" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,400i,700,800,900&display=swap">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/css/swiper.min.css" integrity="sha256-DBYdrj7BxKM3slMeqBVWX2otx7x4eqoHRJCsSDJ0Nxw=" crossorigin="anonymous" />
@endpush

@push('top_scripts')
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
        background: {{ $screen->background_color }};
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
                <article class="swiper-slide swiper-slide-{{ $loop->iteration }}">
                    @includeFirst(['web.screentype.'.$screen->layout->name, 'web._layout_missing'])
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
@endsection

@section('bottom_scripts')
<script>
(function initWebAccess() {

    var lastVersion = false;

    var displayTime = {{ $channel->display_time ?? 5000 }};
    var transitionTime = {{ $channel->transition_time ??  1000 }};
    var refreshTime = {{ $channel->refresh_time ??  5 }} * 1000;

    var swiper = new Swiper('.swiper-container', {
        direction: 'horizontal',
        loop: true,
        effect: 'fade',
        autoplay: {
            delay: displayTime,
        },
        allowTouchMove: false,
        speed: transitionTime,
        @if(!$noChannel && $screens->count() > 2)
        pagination: {
            el: '.swiper-pagination',
            type: 'bullets'
        }
        @endif
    });

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
                    // console.log("Letzte Version: " + lastVersion + " / Neue Version: " + newVersion);
                })
                .catch(function (error) {
                    console.log(error);
                })
                .finally(function () {
                    refresh();
                });
        }, refreshTime);
    })();

})();
</script>
@endsection
