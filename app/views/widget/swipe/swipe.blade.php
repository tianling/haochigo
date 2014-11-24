<div class="swipe">
    <div id="m-slider" class="slideBox">
        <ul class="items">
            @foreach ($pic_swap as $k => $item)
            <li><a href="{{$item['jump_url']}}" title="{{$k + 1}}"><img src="{{$item['image_url']}}"></a></li>
            @endforeach
        </ul>
    </div>
</div>

@section("css")
    @parent
    {{HTML::style("/css/widget/swipe/swipe.css")}}
@stop
