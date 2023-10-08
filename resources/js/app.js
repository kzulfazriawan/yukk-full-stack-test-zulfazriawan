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
app.config(function($interpolateProvider, $cookiesProvider, $locationProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
    $cookiesProvider.secure = true;
    $locationProvider.html5Mode({
        enabled: true,
        requireBase: false
    });
});

import {LoginController} from './controller/auth.js'; 
app.controller('LoginController', LoginController);

import { VerificationController } from './controller/verification.js';
app.controller('VerificationController', VerificationController);

import { HomeController } from './controller/home.js';
app.controller('HomeController', HomeController);

import { TrxController } from './controller/trx.js';
app.controller('TrxController', TrxController);

import { TrxDetailController } from './controller/trx-detail.js';
app.controller('TrxDetailController', TrxDetailController);

import { TrxCreateController } from './controller/trx-create.js';
app.controller('TrxCreateController', TrxCreateController);

import { HeaderController } from './controller/header.js';
app.controller('HeaderController', HeaderController);