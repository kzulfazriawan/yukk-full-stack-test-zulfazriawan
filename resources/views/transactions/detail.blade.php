@extends('layouts.dashboard')
@section('content')
<div ng-controller="TrxDetailController" ng-init="init('{{$uid}}')">
    <div id="modal-confirm" uk-modal ng-show="transactions.data.status == 'open'">
        <div class="uk-modal-dialog uk-modal-body uk-padding-small">
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
                <p class="uk-text-center uk-margin-remove">Confirm payment "<% transactions.data.title %>" ?</p>
                <p class="uk-text-center uk-margin-small">
                    <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
                    <button class="uk-button uk-button-primary" type="button"
                        ng-click="confirm('{{ $uid }}')">Confirm</button>
                </p>
            </fieldset>
        </div>
    </div>

    <div class="uk-card uk-card-default uk-margin uk-border-rounded">
        <div class="uk-card-header uk-padding-small">
            <div class="uk-flex uk-flex-middle">
                <p class="uk-text-small uk-margin-remove"
                    ng-show="transactions.data.status == 'open'">
                    <a href="#modal-confirm" uk-toggle><span uk-icon="icon: credit-card"></span> Confirm Payment</a>
                </p>
                <p class="uk-text-small uk-margin-remove"
                    ng-show="transactions.data.status == 'paid'">
                    <span uk-icon="icon: credit-card"></span> Confirmed Payment
                </p>
                <p class="uk-text-small uk-margin-remove"
                    ng-show="transactions.data.status != 'paid' && transactions.data.status != 'open'">
                    <span uk-icon="icon: credit-card"></span> Failed Payment
                </p>
                <h4 class="uk-width-expand uk-margin-remove uk-text-right"><% transactions.data.title %></h4>
            </div>
        </div>
        <div class="uk-card-body uk-padding-small">
            <div uk-grid>
                <div class="uk-width-1-2">
                    <label class="uk-text-small">Amount</label>
                    <p class="uk-text-small uk-margin-remove"><span class="uk-label" ng-class="{'uk-label-success': transactions.data.is_income, 'uk-label-danger': !transactions.data.is_income}"><% transactions.data.amount | currency:"IDR ":0 %></span></p>
                </div>
                <div class="uk-width-1-2">
                    <label class="uk-text-small">Status</label>
                    <p class="uk-text-small uk-margin-remove">
                        <span uk-icon="check" class="uk-text-success" ng-show="transactions.data.status == 'paid'" uk-tooltip="<% transactions.data.status %>"></span>
                        <span uk-icon="pull" class="uk-text-primary" ng-show="transactions.data.status == 'open'" uk-tooltip="<% transactions.data.status %>"></span>
                        <span uk-icon="ban" class="uk-text-danger" ng-show="transactions.data.status == 'cancel'" uk-tooltip="<% transactions.data.status %>"></span>
                        <span uk-icon="close" class="uk-text-danger" ng-show="transactions.data.status == 'expired'" uk-tooltip="<% transactions.data.status %>"></span>
                        <% transactions.data.status %>
                    </p>
                </div>
                <div class="uk-width-1-2">
                    <label class="uk-text-small">Date</label>
                    <p class="uk-text-small uk-margin-remove"><% transactions.data.created_at | date:'MM/dd/yyyy HH:mm:ss' %></p>
                </div>
                <div class="uk-width-1-2">
                    <label class="uk-text-small">Remarks</label>
                    <p class="uk-text-small uk-margin-remove"><% transactions.data.remarks %></p>
                </div>
            </div>
        </div>
        <div class="uk-card-footer uk-padding-small" id="summary-trx">
            <p class="uk-text-small"><a href="/transactions">Go to Transactions</a> | <a href="/transactions/create">Create a new Transaction</a></p>
        </div>
    </div>
</div>

@endsection