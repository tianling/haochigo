<!Doctype html>
	<html>
		<head>
			<title>菜单</title>
			@yield("css")
		</head>
		<body>
			<div id="header">
				@yield("header")
			</div>
			<div id="content">
			    <div class="shop_header ui-helper-clearfix">
			         {{-- 商家顶部信息栏 --}}
                    @yield("shop_details")
			    </div>
                <div class="shop_container ui-helper-clearfix">
                    <div class="pop_window">
                        {{-- 左侧滑出的评论框 --}}
                        @yield("pop_window")
                    </div>
                    <div class="shop_left">
                        @yield("shop_left")
                    </div>
                    <div class="shop_right">
                        @yield("shop_right")
                    </div>
                </div>
                 
                 {{-- 右侧收藏商家按钮 --}}
                 <div class="shop_collect_bar">
                    	@yield("shop_collect_bar")
                 </div>
                {{-- 餐厅购物车 --}}

                <div class="shop_chart">
                    @yield("shop_cart")
                </div>
			</div>
			<div id="footer">
				@yield("footer")
			</div>
            
            {{-- 玻璃罩 --}}
            <div class="u-mask">
                
            </div>
			@yield("script")
		</body>
	</html>

