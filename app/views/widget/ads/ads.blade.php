<div class="ads">
    @for($i = 0; $i < 5; $i++)
        <a href="{{$add_image['data'][$i]['jump_url']}}">
            <img src="{{url($add_image['data'][$i]['image_url'])}}"/>
        </a>
    @endfor

    <div class="ui-helper-clearfix"></div>

</div>

@section("css")
    @parent
    {{HTML::style("/css/widget/ads/ads.css")}}
@stop
