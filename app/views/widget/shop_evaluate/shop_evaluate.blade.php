<div class="rst-rating-aside f-cb">
	<div class="rating-point f-cb" itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating">
    	<strong class="point" itemprop="ratingValue">{{ $top_bar["data"]["shop_total"] }}</strong>
	  	<div class="detail">
		    <span class="rating-stars">
		  		@for($i = 0, $len = ($top_bar["data"]["shop_total"]/2); $i < $len; $i++ )
		  			<i class="glyph-rating-star">★</i>
		  		@endfor
		  	</span>
	    	<span class="comment" href="/cq-jgmx/rating"><span itemprop="reviewCount">{{ $top_bar["data"]["comment_count"] }}</span>人评价</span>
	  	</div>
   </div>

   <ul class="rating-diagram">
     @foreach ($top_bar["data"]["shop_level"] as $key => $value)
     	<li class="diagram-item">
	      	<span class="rating-stars">
	      		@for ($i = 0; $i < substr($key, 6,1); $i++)
			  		<i class="glyph-rating-star">★</i>
			    @endfor

			    @for ($m = 0; $m < 5-substr($key, 6,1); $m++)
			  		<i class="glyph-rating-star off">★</i>
			    @endfor
	     	</span>

	     	<span class="bar" style="width: {{ ($value/100*120).'px' }}; "></span>
	     	{{ $value }}
	    </li>
     @endforeach
    </ul>
</div>

@section("css")
    @parent
    {{HTML::style("/css/widget/shop_evaluate/shop_evaluate.css")}}
@stop