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
		<nav class="uk-navbar-container" ng-controller="HeaderController" ng-init="init()">
			<div class="uk-container uk-text-small">
				<div uk-navbar>
					<div class="uk-navbar-left">
						<ul class="uk-navbar-nav">
							<li><a href="/">Home</a></li>
							<li><a href="/transactions">Transactions</a></li>
						</ul>
					</div>

					<div class="uk-navbar-right">
						<ul class="uk-navbar-nav">
							<li><% user.profile.name %> <span class="uk-label"><% user.balance | currency:"IDR ":0 %></li>
						</ul>
					</div>
				</div>
			</div>
		</nav>
		
        <div id="main" class="uk-container uk-container-expand uk-padding-small">
            @yield('content')
        </div>
		<div class="uk-width-expand uk-text-center uk-text-small footer">
			<label><span class="copy">&copy;</span> 2023 | <a href="https://github.com/kzulfazriawan">Github Kzulfazriawan</a></label>
		</div>
		<script src="/js/app.js"></script>
    </body>
</html>