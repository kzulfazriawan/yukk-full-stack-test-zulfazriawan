@extends('layouts.dashboard')
@section('content')
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
                <p class="uk-text-meta uk-margin-remove-top">Last Sign In <time datetime="2016-04-01T19:00">April 01, 2016 19:00</time></p>
            </div>
        </div>
    </div>
</div>

<div class="uk-card uk-card-default uk-margin">
    <div class="uk-card-header uk-padding-small">
        <div class="uk-flex uk-flex-middle">
            <h4 class="uk-margin-remove">History Transactions</h4>
            <form class="uk-text-right uk-width-expand">
                <div class="uk-inline uk-width-1-3">
                    <span class="uk-form-icon" uk-icon="icon: calendar"></span>
                    <select class="uk-select uk-text-right uk-border-pill" id="form-stacked-select">
                        <option>-filter transactions-</option>
                        <option>Option 01</option>
                        <option>Option 02</option>
                    </select>
                </div>
            </form>
        </div>
    </div>
    <div class="uk-card-body uk-padding-small">
        <table class="uk-table uk-table-responsive uk-table-divider uk-table-small">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Title</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Table Data</td>
                    <td>Table Data</td>
                    <td>Table Data</td>
                </tr>
                <tr>
                    <td>Table Data</td>
                    <td>Table Data</td>
                    <td>Table Data</td>
                </tr>
                <tr>
                    <td>Table Data</td>
                    <td>Table Data</td>
                    <td>Table Data</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="uk-card-footer uk-padding-small">
        <ul class="uk-pagination uk-margin-remove">
            <li><a href="#"><span class="uk-margin-small-right" uk-pagination-previous></span> Previous</a></li>
            <li class="uk-margin-auto-left"><a href="#">Next <span class="uk-margin-small-left" uk-pagination-next></span></a></li>
        </ul>
    </div>
</div>


@endsection