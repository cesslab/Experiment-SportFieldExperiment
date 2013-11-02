<?php

Route::get('/', function()
{
    echo "OK";
});

use SportExperiment\Framework\Controller\Researcher\Login;
use SportExperiment\Framework\Controller\Researcher\Dashboard;
use SportExperiment\Framework\Controller\Researcher\Session;

Route::get('/researcher/login', Login::getNamespace() . '@getLogin');

Route::post('/researcher/login',
    array(
        'before'=>'csrf',
        'uses'=>Login::getNamespace() .'@postLogin'));

Route::get('/researcher/dashboard',
    array(
        'before'=>'authResearcher',
        'uses'=>Dashboard::getNamespace() . '@getDashboard'));

Route::post('/researcher/dashboard',
    array(
        'before'=>'authResearcher',
        'uses'=>Session::getNamespace() . '@postSession'));

Route::filter('authResearcher', 
    '\\SportExperiment\\Framework\\Filter\\AuthResearcher');