<!Doctype html>
	<html>
		<head>
			<title>主页</title>
			@yield("css")
		</head>
		<body>
			<div id="header">
				@yield("header")
			</div>
			<div id="content">
			    {{-- 地点与切换地区 --}}
                @yield("nav")
                <div class="ui-helper-clearfix">
                    <div class="sidebar">
                        @yield("sidebar")
                    </div>
                    <div class="rightContent">
                        @yield("rightContent")
                    </div>
                </div>
			</div>
			<div id="footer">
				@yield("footer")
			</div>
			@yield("script")
		</body>
	</html>



