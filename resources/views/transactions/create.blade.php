@extends('layouts.dashboard')
@section('content')
<form ng-controller="TrxCreateController" ng-init="init()" ng-submit="submit()">

    <div class="uk-card uk-card-default uk-margin uk-border-rounded">
        <div class="uk-card-header uk-padding-small">
            <div class="uk-flex uk-flex-middle">
                <h4 class="uk-width-expand uk-margin-remove uk-text-right">Create New Transactions</h4>
            </div>
        </div>
        <div class="uk-card-body uk-padding-small">
            <fieldset class="uk-fieldset">
                <div class="uk-margin-small" ng-show="error.transactions.alert">
                    <div class="uk-alert-danger" uk-alert>
                        <a href class="uk-alert-close" uk-close></a>
                        <p><% error.transactions.alert %></p>
                    </div>
                </div>
                <div class="uk-margin-small" ng-show="success.transactions.alert">
                    <div class="uk-alert-success" uk-alert>
                        <a href class="uk-alert-close" uk-close></a>
                        <p><% success.transactions.alert %></p>
                    </div>
                </div>
                <div uk-grid>
                    <div class="uk-width-1-2">
                        <label class="uk-text-small">Amount<sup>*</sup></label>
                        <input type="number" step="1000" min="10000" class="uk-input uk-text-small uk-border-rounded" placeholder="Amount in IDR ..."
                            ng-model="form.transactions.amount" ng-class="{'uk-form-danger': error.transactions.amount}" />
                        <label class="uk-text-small uk-text-danger" ng-show="error.transactions.amount"><% error.transactions.amount %></label>
                    </div>
                    <div class="uk-width-1-2">
                        <label class="uk-text-small">Title<sup>*</sup></label>
                        <input type="text" class="uk-input uk-text-small uk-border-rounded" placeholder="Transactions titles ..."
                            ng-model="form.transactions.title" ng-class="{'uk-form-danger': error.transactions.title}" />
                        <label class="uk-text-small uk-text-danger" ng-show="error.transactions.title"><% error.transactions.title %></label>
                    </div>
                    <div class="uk-width-1-2">
                        <label class="uk-text-small">Transactions<sup>*</sup></label>
                        <select class="uk-select uk-border-rounded" aria-label="Type"
                            ng-options="item for item in transactions.types" ng-model="form.transactions.type">
                        </select>
                        <label class="uk-text-small uk-text-danger" ng-show="error.transactions.type"><% error.transactions.type %></label>
                    </div>
                    <div class="uk-width-1-2">
                        <label class="uk-text-small">Services<sup>*</sup></label>
                        <select class="uk-select uk-border-rounded" aria-label="Services"
                            ng-options="item.id as item.name for item in transactions.services" ng-model="form.transactions.service_id">
                        </select>
                        <label class="uk-text-small uk-text-danger" ng-show="error.transactions.service_id"><% error.transactions.service_id %></label>
                    </div>
                    <div class="uk-width-expand">
                        <label class="uk-text-small">Remarks</label>
                        <textarea class="uk-textarea uk-text-small uk-border-rounded" rows="3"
                            ng-model="form.transactions.remarks"></textarea>
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="uk-card-footer uk-padding-small" id="summary-trx">
            <button class="uk-button uk-button-primary uk-border-rounded" type="submit">Create</button>
        </div>
    </div>
</form>

@endsection