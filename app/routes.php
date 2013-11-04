<?php

Route::get('/', function()
{
    echo "OK";
});

use SportExperiment\Controller\Researcher\Login;
use SportExperiment\Controller\Researcher\Dashboard;
use SportExperiment\Controller\Researcher\Session;
use SportExperiment\Filter\AuthorizeResearcher;

Route::get(Login::$URI, Login::getNamespace() . '@getLogin');

Route::post(Login::$URI, array('before'=>'csrf', 'uses'=>Login::getNamespace() .'@postLogin'));

Route::get(Dashboard::$URI, array(
    'before'=>AuthorizeResearcher::$FILTER_NAME, 'uses'=>Dashboard::getNamespace() . '@getDashboard'));

Route::post(Dashboard::$URI, array(
    'before'=>AuthorizeResearcher::$FILTER_NAME, 'uses'=>Session::getNamespace() . '@postSession'));

/*
 * Filters
 */
Route::filter(AuthorizeResearcher::$FILTER_NAME, AuthorizeResearcher::getNamespace());