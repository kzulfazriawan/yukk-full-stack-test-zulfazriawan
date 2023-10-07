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
    <body>
		<div id="sidemenu" class="uk-align-left uk-margin-remove">
        </div>
        <div id="main" class="uk-container uk-container-expand uk-padding-small">
            @yield('content')
        </div>
		<script src="/js/app.js"></script>
    </body>
</html>