@extends('layouts.dashboard')
@section('content')
<div ng-controller="TrxController" ng-init="init()">

    <div class="uk-card uk-card-default uk-margin uk-border-rounded">
        <div class="uk-card-header uk-padding-small">
            <div class="uk-flex uk-flex-middle">
                <div class="uk-width-auto">
                    <div class="uk-inline">
                        <button class="uk-button uk-button-default uk-border-rounded" type="button">Filter</button>
                        <div uk-dropdown="mode: click" class="uk-width-large uk-border-rounded">
                            <form class="uk-text-small" ng-submit="loadTrx()">
                                <fieldset class="uk-fieldset">
                                    <div class="uk-margin">
                                        <label>Status</label>
                                        <select class="uk-select uk-border-rounded" aria-label="Status"
                                            ng-options="item for item in filter.status" ng-model="transactions.status">
                                        </select>
                                    </div>
                                    <div class="uk-margin">
                                        <label>Income</label>
                                        <select class="uk-select uk-border-rounded" aria-label="Status"
                                            ng-options="item for item in filter.income" ng-model="transactions.income">
                                        </select>
                                    </div>
                                    <div class="uk-margin">
                                        <label>Search</label>
                                        <input type="text" class="uk-input uk-border-rounded" ng-model="transactions.search" placeholder="Search Transactions ..." />
                                    </div>
                                    <div class="uk-margin">
                                        <button type="submit" class="uk-button uk-button-primary uk-border-rounded">Filter</button>
                                        <button type="button" class="uk-button uk-button-default uk-border-rounded" ng-click="resetTrx()">Reset</button>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
                <h4 class="uk-width-expand uk-margin-remove uk-text-right">Transaction Lists</h4>
            </div>
        </div>
        <div class="uk-card-body uk-padding-small" id="summary-trx">
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
        <div class="uk-card-footer uk-padding-small">
            <div class="uk-flex uk-flex-middle">
                <p class="uk-text-small uk-width-expand uk-margin-remove"><a href="/transactions/create">Create a new Transaction</a></p>
                <ul class="uk-pagination uk-flex-right uk-margin-remove" uk-margin>
                    <li
                        ng-class="{'uk-active': item.active }" ng-repeat="item in transactions.pagination">
                        <a href="#summary-trx" uk-scroll ng-click="loadTrx(item.url)">
                            <span ng-if="!item.label.includes('Next') && !item.label.includes('Previous')"><% item.label %></span>
                            <span ng-if="item.label.includes('Next')" class="uk-margin-small-left" uk-icon="chevron-right"></span>
                            <span ng-if="item.label.includes('Previous')" class="uk-margin-small-right" uk-icon="chevron-left"></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection