let mix = require("laravel-mix");
require('laravel-mix-imagemin');

mix.js("resources/js/app.js", "js")
   .css("node_modules/uikit/dist/css/uikit.min.css", "css")
   .less("resources/less/web.less", "css", {lessOptions: { strictMath: true }})
   .scripts([
      "node_modules/angular/angular.min.js",
      "node_modules/angular-cookies/angular-cookies.min.js",
      "node_modules/angular-sanitize/angular-sanitize.min.js",
      "node_modules/ng-file-upload/dist/ng-file-upload-all.min.js"
   ], "resources/js/scripts.js")
   .copy( 'resources/media', 'public/media', false)
