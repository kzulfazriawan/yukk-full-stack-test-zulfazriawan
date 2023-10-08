@extends('layouts.dashboard')
@section('content')
<div ng-controller="HomeController" ng-init="init()">
    <div class="uk-card uk-card-default uk-margin">
        <div class="uk-card-media-top">
            <div class="uk-height-medium uk-flex uk-flex-center uk-flex-middle uk-background-cover uk-light" data-src="/media/pexels-johannes-plenio-cover.webp" uk-img>
                <h1>Background Image</h1>
                </div>
        </div>
        <div class="uk-card-body uk-padding-small">
            <div class="uk-width-expand uk-flex uk-flex-inline uk-flex-bottom profile-picture-wrapper">
                <div class="uk-width-auto">
                    <img class="uk-border-circle profile-picture-header" src="/media/profile-placeholder.jpg" alt="Avatar">
                </div>
                <div class="uk-width-expand uk-text-right">
                    <h3 class="uk-card-title uk-margin-remove-bottom">FirstName LastName</h3>
                    <p class="uk-text-small uk-margin-remove-top">Balances <span class="uk-label uk-text-small"><% user.balance | currency:"IDR ":0 %></span></p>
                </div>
            </div>
        </div>
    </div>

    <div class="uk-card uk-card-default uk-margin">
        <div class="uk-card-header uk-padding-small">
            <div class="uk-flex uk-flex-middle">
                <div class="uk-width-auto">
                    <div class="uk-inline">
                        <button class="uk-button uk-button-default" type="button">Click</button>
                        <div uk-dropdown="mode: click" class="uk-width-large">
                            <form class="uk-text-small" ng-submit="loadTrx()">
                                <fieldset class="uk-fieldset">
                                    <div class="uk-margin">
                                        <label>Status</label>
                                        <select class="uk-select" aria-label="Status"
                                            ng-options="item for item in filter.status" ng-model="transactions.status">
                                        </select>
                                    </div>
                                    <div class="uk-margin">
                                        <label>Income</label>
                                        <select class="uk-select" aria-label="Status"
                                            ng-options="item for item in filter.income" ng-model="transactions.income">
                                        </select>
                                    </div>
                                    <div class="uk-margin">
                                        <button type="submit" class="uk-button uk-button-primary">Filter</button>
                                        <button type="button" class="uk-button uk-button-default" ng-click="resetTrx()">Reset</button>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
                <h4 class="uk-width-expand uk-margin-remove uk-text-right">History Transactions</h4>
            </div>
        </div>
        <div class="uk-card-body uk-padding-small">
            <table class="uk-table uk-table-responsive uk-table-divider uk-table-small uk-text-small">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Title</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Services</th>
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
                            <span uk-icon="ban" class="uk-text-danger" ng-show="item.status != 'paid' && item.status != 'open'" uk-tooltip="<% item.status %>"></span>
                        </td>
                        <td>Table Data</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="uk-card-footer uk-padding-small" id="summary-trx">
            <ul class="uk-pagination" uk-margin>
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

@endsection