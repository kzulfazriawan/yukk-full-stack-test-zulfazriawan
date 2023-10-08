@extends('layouts.auth')
@section('content')
<form ng-controller="LoginController" ng-submit="submit()">
    <div class="uk-card uk-card-default uk-margin uk-border-rounded signin-register">
        <div class="uk-card-header uk-padding-small">
            <h4 class="uk-margin-remove">Login To Application</h4>
        </div>
        <div class="uk-card-body uk-padding-small">
            <fieldset class="uk-fieldset">
                <div class="uk-margin-small" ng-show="error.login.alert">
                    <div class="uk-alert-danger" uk-alert>
                        <a href class="uk-alert-close" uk-close></a>
                        <p><% error.login.alert %></p>
                    </div>
                </div>
                <div class="uk-margin-small" ng-show="success.login.alert">
                    <div class="uk-alert-success" uk-alert>
                        <a href class="uk-alert-close" uk-close></a>
                        <p><% success.login.alert %></p>
                    </div>
                </div>
                <div class="uk-margin-small">
                    <label class="uk-text-small">Email</label>
                    <input type="email" class="uk-input uk-text-small uk-border-rounded" placeholder="Your Email..."
                        ng-model="form.login.email" ng-class="{'uk-form-danger': error.login.email}" />
                    <label class="uk-text-small uk-text-danger" ng-show="error.login.email"><% error.login.email %></label>
                </div>
                <div class="uk-margin-small">
                    <label class="uk-text-small">Password</label>
                    <input type="password" class="uk-input uk-text-small uk-border-rounded" placeholder="Your Password..."
                        ng-model="form.login.password" ng-class="{'uk-form-danger': error.login.password}" />
                    <label class="uk-text-small uk-text-danger" ng-show="error.login.password"><% error.login.password %></label>
                </div>
            </fieldset>
        </div>
        <div class="uk-card-footer uk-padding-small">
            <button class="uk-button uk-button-primary uk-border-rounded" type="submit">Login</button>
            <p class="uk-text-small"><a href="" uk-toggle="target: .signin-register" ng-click="toggle()">Create a new Account</a></p>
        </div>
    </div>

    <div class="uk-card uk-card-default uk-margin uk-border-rounded signin-register" hidden>
        <div class="uk-card-header uk-padding-small">
            <h4 class="uk-margin-remove">Register new Account</h4>
        </div>
        <div class="uk-card-body uk-padding-small">
            <fieldset class="uk-fieldset">
                <div class="uk-margin-small" ng-show="error.register.alert">
                    <div class="uk-alert-danger" uk-alert>
                        <a href class="uk-alert-close" uk-close></a>
                        <p><% error.register.alert %></p>
                    </div>
                </div>
                <div class="uk-margin-small" ng-show="success.register.alert">
                    <div class="uk-alert-success" uk-alert>
                        <a href class="uk-alert-close" uk-close></a>
                        <p><% success.register.alert %></p>
                    </div>
                </div>
                <div class="uk-margin-small">
                    <label class="uk-text-small">Name</label>
                    <input type="text" class="uk-input uk-text-small uk-border-rounded" placeholder="Your Name..."
                        ng-model="form.register.name" ng-class="{'uk-form-danger': error.register.name}" />
                    <label class="uk-text-small uk-text-danger" ng-show="error.register.name"><% error.register.name %></label>
                </div>
                <div class="uk-margin-small">
                    <label class="uk-text-small">Email</label>
                    <input type="email" class="uk-input uk-text-small uk-border-rounded" placeholder="Your Email..."
                        ng-model="form.register.email" ng-class="{'uk-form-danger': error.register.email}" />
                    <label class="uk-text-small uk-text-danger" ng-show="error.register.email"><% error.register.email %></label>
                </div>
                <div class="uk-margin-small">
                    <label class="uk-text-small">Password</label>
                    <input type="password" class="uk-input uk-text-small uk-border-rounded" placeholder="Your Password..."
                        ng-model="form.register.password" ng-class="{'uk-form-danger': error.register.password}" />
                    <label class="uk-text-small uk-text-danger" ng-show="error.register.password"><% error.register.password %></label>
                </div>
                <div class="uk-margin-small">
                    <label class="uk-text-small">Confirm Password</label>
                    <input type="password" class="uk-input uk-text-small uk-border-rounded" placeholder="Confirm Your Password..."
                        ng-model="form.register.password_confirmation" ng-class="{'uk-form-danger': error.register.password_confirmation}" />
                    <label class="uk-text-small uk-text-danger" ng-show="error.register.password_confirmation"><% error.register.password_confirmation %></label>
                </div>
                <div class="uk-margin-small">
                    <label class="uk-text-small">
                        <input type="checkbox" class="uk-checkbox"
                            ng-model="form.register.agreement" />
                            I Accept the <a href="">Terms and Conditions</a>
                    </label>
                </div>
            </fieldset>
        </div>
        <div class="uk-card-footer uk-padding-small">
            <button class="uk-button uk-button-primary uk-border-rounded" type="submit" ng-disabled="!form.register.agreement">Register</button>
            <p class="uk-text-small"><a href="#" uk-toggle="target: .signin-register">Login your Account</a></p>
        </div>
    </div>
</form>
@endsection