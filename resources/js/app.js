import './bootstrap.js';
import UIkit from 'uikit';
import Icons from 'uikit/dist/js/uikit-icons.js';

// loads the Icon plugin
UIkit.use(Icons);


import angular from 'angular';
import 'angular-sanitize';
import 'angular-cookies';
import Upload from 'ng-file-upload';

var app = angular.module('App', ['ngFileUpload', 'ngSanitize', 'ngCookies']);

// HTTP factory
import {Http} from './http.js';
app.factory('Http', Http);

// configuration angular JS
app.config(function($interpolateProvider, $cookiesProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
    $cookiesProvider.secure = true;
});

import {LoginController} from './controller/auth.js'; 
app.controller('LoginController', LoginController);