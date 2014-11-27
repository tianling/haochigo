<!Doctype html>
	<html>
		<head>
			<title>登录</title>
			@yield("css")
		</head>
		<body>

			{{-- 头部 ele logo --}}
            <h1 class="header">
                @yield("header")
            </h1>
            
            {{-- content --}}
            <div class="content ui-helper-clearfix">
                <div class="content_banner">
                    @yield("product_image")
                </div>
                <div class="content_form">
                    @yield("form")
                </div>
            </div>
            
            {{-- footer --}}
			<div id="footer">
				@yield("footer")
			</div>

			@yield("script")
		</body>
	</html>

