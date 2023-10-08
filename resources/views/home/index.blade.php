@extends('layouts.dashboard')
@section('content')
<div ng-controller="HomeController" ng-init="init()">
    <div class="uk-card uk-card-default uk-margin uk-border-rounded">
        <div class="uk-card-media-top">
            <div class="uk-height-medium uk-flex uk-flex-center uk-flex-middle uk-background-cover uk-light uk-border-rounded" data-src="/media/pexels-johannes-plenio-cover.webp" uk-img></div>
        </div>
        <div class="uk-card-body uk-padding-small">
            <div class="uk-width-expand uk-flex uk-flex-inline uk-flex-bottom profile-picture-wrapper">
                <div class="uk-width-auto">
                    <img class="uk-border-circle profile-picture-header" src="/media/profile-placeholder.jpg" alt="Avatar">
                </div>
                <div class="uk-width-expand uk-text-right">
                    <h3 class="uk-card-title uk-margin-remove-bottom"><% user.profile.name %></h3>
                    <p class="uk-text-small uk-margin-remove-top">Balances <span class="uk-label uk-text-small"><% user.balance | currency:"IDR ":0 %></span></p>
                </div>
            </div>
        </div>
    </div>

    <div class="uk-card uk-card-default uk-margin uk-border-rounded">
        <div class="uk-card-header uk-padding-small">
            <h4 class="uk-width-expand uk-margin-remove uk-text-right">Latest Transactions</h4>
        </div>
        <div class="uk-card-body uk-padding-small">
            <table class="uk-table uk-table-responsive uk-table-divider uk-table-small uk-text-small">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Title</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="item in transactions.data">
                        <td><% item.created_at | date:'MM/dd/yyyy HH:mm:ss' %></td>
                        <td><% item.title %></td>
                        <td><span class="uk-label" ng-class="{'uk-label-success': item.is_income, 'uk-label-danger': !item.is_income}"><% item.amount | currency:"IDR ":0 %></span></td>
                        <td>
                            <span uk-icon="check" class="uk-text-success" ng-show="item.status == 'paid'" uk-tooltip="<% item.status %>"></span>
                            <span uk-icon="pull" class="uk-text-primary" ng-show="item.status == 'open'" uk-tooltip="<% item.status %>"></span>
                            <span uk-icon="ban" class="uk-text-danger" ng-show="item.status == 'cancel'" uk-tooltip="<% item.status %>"></span>
                            <span uk-icon="close" class="uk-text-danger" ng-show="item.status == 'expired'" uk-tooltip="<% item.status %>"></span>
                        </td>
                        <td>
                            <ul class="uk-iconnav">
                                <li><a href="/transactions/detail/<% item.id %>" uk-tooltip="Show Detail Transaction"><span uk-icon="icon: file-text"></span></a></li>
                            </ul>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="uk-card-footer uk-padding-small" id="summary-trx">
            <p class="uk-text-small"><a href="/transactions">Go to Transactions</a> | <a href="/transactions/create">Create a new Transaction</a></p>
        </div>
    </div>
</div>

@endsection