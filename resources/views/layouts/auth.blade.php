<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" href="img/favicon.ico">
		<!-- CSS FILES -->
		<link rel="stylesheet" href="/css/uikit.min.css" />
        <link rel="stylesheet" href="/css/web.css" />
	</head>
    <body ng-app="App">
		<div class="uk-container uk-container-xsmall auth-container">
	        @yield('content')
		</div>
		<div class="uk-width-expand uk-text-center uk-text-small uk-position-bottom footer">
			<label><span class="copy">&copy;</span> 2023 | <a href="https://github.com/kzulfazriawan">Github Kzulfazriawan</a></label>
		</div>
		<script src="/js/app.js"></script>
    </body>
</html>