@extends('layouts.auth')
@section('content')
<form class="uk-container uk-container-xsmall" ng-controller="LoginController" ng-submit="submit()">
    <div class="uk-card uk-card-default uk-margin signin-register">
        <div class="uk-card-header uk-padding-small">
            <h4 class="uk-margin-remove">Login To Application</h4>
        </div>
        <div class="uk-card-body uk-padding-small">
            <fieldset class="uk-fieldset">
                <div class="uk-margin" ng-show="error.login.alert">
                    <div class="uk-alert-danger" uk-alert>
                        <a href class="uk-alert-close" uk-close></a>
                        <p><% error.login.alert %></p>
                    </div>
                </div>
                <div class="uk-margin" ng-show="success.login.alert">
                    <div class="uk-alert-success" uk-alert>
                        <a href class="uk-alert-close" uk-close></a>
                        <p><% success.login.alert %></p>
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-text-small">Email</label>
                    <input type="email" class="uk-input uk-border-rounded" placeholder="Your Email..."
                        ng-model="form.login.email" ng-class="{'uk-form-danger': error.login.email}" />
                    <label class="uk-text-small uk-text-danger" ng-show="error.login.email"><% error.login.email %></label>
                </div>
                <div class="uk-margin">
                    <label class="uk-text-small">Password</label>
                    <input type="password" class="uk-input uk-border-rounded" placeholder="Your Password..."
                        ng-model="form.login.password" ng-class="{'uk-form-danger': error.login.password}" />
                    <label class="uk-text-small uk-text-danger" ng-show="error.login.password"><% error.login.password %></label>
                </div>
            </fieldset>
        </div>
        <div class="uk-card-footer uk-padding-small">
            <button class="uk-button uk-button-primary" type="submit">Login</button>
            <p><a href="" uk-toggle="target: .signin-register" ng-click="toggle()">Create a new Account</a></p>
        </div>
    </div>

    <div class="uk-card uk-card-default uk-margin signin-register" hidden>
        <div class="uk-card-header uk-padding-small">
            <h4 class="uk-margin-remove">Register new Account</h4>
        </div>
        <div class="uk-card-body uk-padding-small">
            <fieldset class="uk-fieldset">
                <div class="uk-margin">
                    <label class="uk-text-small">Name</label>
                    <input type="email" class="uk-input uk-border-rounded" placeholder="Your Name..." />
                </div>
                <div class="uk-margin">
                    <label class="uk-text-small">Email</label>
                    <input type="email" class="uk-input uk-border-rounded" placeholder="Your Email..." />
                </div>
                <div class="uk-margin">
                    <label class="uk-text-small">Password</label>
                    <input type="password" class="uk-input uk-border-rounded" placeholder="Your Password..." />
                </div>
                <div class="uk-margin">
                    <label class="uk-text-small">Confirm Password</label>
                    <input type="password" class="uk-input uk-border-rounded" placeholder="Confirm Your Password..." />
                </div>
                <div class="uk-margin">
                    <label class="uk-text-small"><input type="checkbox" class="uk-checkbox" /> I Accept the <a href="">Terms and Conditions</a></label>
                </div>
            </fieldset>
        </div>
        <div class="uk-card-footer uk-padding-small">
            <button class="uk-button uk-button-primary" type="submit">Register</button>
            <p><a href="#" uk-toggle="target: .signin-register">Login to Your Account</a></p>
        </div>
    </div>
</form>
@endsection