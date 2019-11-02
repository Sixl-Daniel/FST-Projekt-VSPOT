<div class="content content--basic">
    @if(!empty($screen->heading))
        <h1 class="heading heading--main" data-swiper-parallax="-200" data-swiper-parallax-scale="0.5" data-swiper-parallax-opacity="0" data-swiper-parallax-duration="300">{{ $screen->heading }}</h1>
    @endif
    @if(!empty($screen->subheading))
        <h2 class="h3 heading heading--sub" data-swiper-parallax="+200" data-swiper-parallax-scale="0.5" data-swiper-parallax-opacity="0" data-swiper-parallax-duration="300">{{ $screen->subheading }}</h2>
    @endif
    @if(!empty($screen->text_block))
        <p class="text_block" data-swiper-parallax="+300" data-swiper-parallax-opacity="0" data-swiper-parallax-duration="300">{!! nl2br(e($screen->text_block)) !!}</p>
    @endif
</div>
