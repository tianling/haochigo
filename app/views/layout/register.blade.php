<!Doctype html>
	<html>
		<head>
			<title>注册</title>
			@yield("css")
		</head>
		<body>
            <div id="header">
                @yield("header")
            </div>

            <div class="content ui-helper-clearfix">
                <div class="content_left">
                    @yield("product_image")
                </div>
                <div class="content_right">
                    @yield("form")
                </div>
            </div>

			<div id="footer">
				@yield("footer")
			</div>
			@yield("script")
		</body>
	</html>

