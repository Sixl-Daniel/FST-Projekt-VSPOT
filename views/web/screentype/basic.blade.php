@if(!empty($screen->heading))
    <h1 class="heading heading--main">{{ $screen->heading }}</h1>
@endif
@if(!empty($screen->subheading))
    <h2 class="h3 heading heading--sub">{{ $screen->subheading }}</h2>
@endif
@if(!empty($screen->text_block))
    <p class="content content--textarea text-left mt-05">{!! nl2br(e($screen->text_block)) !!}</p>
@endif
