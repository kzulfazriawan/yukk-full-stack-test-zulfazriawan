@extends('layouts.auth')
@section('content')
<div ng-controller="VerificationController" ng-init="init()">
    <div class="uk-card uk-card-default uk-margin uk-border-rounded" ng-hide="is_verified">
        <div class="uk-card-header uk-padding-small">
            <h4 class="uk-margin-remove">Verify your Account</h4>
        </div>
        <div class="uk-card-body uk-padding-small">
            <p class="uk-text-small uk-margin-remove">
                Awesome! You just created a new Account,
                one more step to confirm on your email and activate your Account,
                then and you'll be able to use our services to the fullest.
            </p>
        </div>
        <div class="uk-card-footer uk-padding-small">
            <p class="uk-text-small uk-margin-remove"><a href="/auth">Back to Login</a></p>
            @if($show_url)
            <input type="text" class="uk-text-small uk-width-expand" readonly
                ng-model="url" />
            @endif
        </div>
    </div>

    <div class="uk-card uk-card-default uk-margin uk-border-rounded" ng-show="is_verified">
        <div class="uk-card-header uk-padding-small">
            <h4 class="uk-margin-remove" ng-show="verified_success">Account Verified!</h4>
            <h4 class="uk-margin-remove" ng-hide="verified_success">Activation Account ...</h4>
        </div>
        <div class="uk-card-body uk-padding-small">
            <p class="uk-text-small uk-margin-remove" ng-show="verified_success">
                Congratulations! Your new Account is already activated!<br/>
                You'll be redirected to Login in 3 seconds, if not click the link below.
            </p>
            <p class="uk-text-small uk-margin-remove" ng-hide="verified_success && verified_errors">
                Setting up your activation Account ...
            </p>
            <p class="uk-text-small uk-margin-remove uk-text-danger" ng-show="verified_errors">
                Verification email cannot be done. There's several factors such as email has been activated
                or the token is invalid, please make sure the valid confirmation link on your email.
            </p>
        </div>
        <div class="uk-card-footer uk-padding-small">
            <p class="uk-text-small uk-margin-remove" ng-show="verified_success || verified_errors"><a href="/auth">Back to Login</a></p>
            <p class="uk-text-small uk-margin-remove" ng-hide="verified_success">Stand By ...</p>
        </div>
    </div>
</div>
@endsection