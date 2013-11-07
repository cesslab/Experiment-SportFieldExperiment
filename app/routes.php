<?php

use SportExperiment\Controller\Researcher\Login as ResearcherLogin;
use SportExperiment\Controller\Researcher\Dashboard;
use SportExperiment\Controller\Researcher\Session;
use SportExperiment\Filter\AuthorizeResearcher;
use Illuminate\Support\Facades\Route;

use SportExperiment\Controller\Subject\Login as SubjectLogin;
use SportExperiment\Controller\Subject\Registration;
use SportExperiment\Filter\AuthorizeSubject;
use SportExperiment\Controller\Subject\Experiment;
use SportExperiment\Controller\Subject\PreGameHold;

Route::get('/', function(){});

/*
|--------------------------------------------------------------------------
| Researcher Routes
|--------------------------------------------------------------------------
 */
// Researcher
Route::get(ResearcherLogin::$URI, ResearcherLogin::getNamespace() . '@getLogin');
Route::post(ResearcherLogin::$URI, array('before'=>'csrf', 'uses'=>ResearcherLogin::getNamespace() .'@postLogin'));


Route::get(Dashboard::$URI, array(
    'before'=>AuthorizeResearcher::$FILTER_NAME, 'uses'=>Dashboard::getNamespace() . '@getDashboard'));

Route::get(Session::$URI, array(
    'before'=>AuthorizeResearcher::$FILTER_NAME, 'uses'=>Session::getNamespace() . '@getSession'));
Route::post(Session::$URI, array(
    'before'=>AuthorizeResearcher::$FILTER_NAME, 'uses'=>Session::getNamespace() . '@postSession'));

/*
|--------------------------------------------------------------------------
| Subject Routes
|--------------------------------------------------------------------------
 */
// Login
Route::get(SubjectLogin::$URI, SubjectLogin::getNamespace() . '@getLogin');
Route::post(SubjectLogin::$URI, array('before'=>'csrf', 'uses'=>SubjectLogin::getNamespace() .'@postLogin'));

// Registration
Route::get(Registration::$URI, array(
    'before'=>AuthorizeSubject::$FILTER_NAME, 'uses'=>Registration::getNamespace() . '@getRegistration'));
Route::post(Registration::$URI, array(
    'before'=>AuthorizeSubject::$FILTER_NAME, 'uses'=>Registration::getNamespace() . '@postRegistration'));

// Pre-Game Hold Screen
Route::get(PreGameHold::$URI, array(
    'before'=>AuthorizeSubject::$FILTER_NAME, 'uses'=>PreGameHold::getNamespace() . '@getHold'));

// Game
Route::get(Experiment::$URI, array(
    'before'=>AuthorizeSubject::$FILTER_NAME, 'uses'=>Experiment::getNamespace() . '@getExperiment'));
Route::post(Experiment::$URI, array(
    'before'=>AuthorizeSubject::$FILTER_NAME, 'uses'=>Experiment::getNamespace() . '@postExperiment'));

/*
|--------------------------------------------------------------------------
| Filters
|--------------------------------------------------------------------------
 */
Route::filter(AuthorizeResearcher::$FILTER_NAME, AuthorizeResearcher::getNamespace());
Route::filter(AuthorizeSubject::$FILTER_NAME, AuthorizeSubject::getNamespace());
