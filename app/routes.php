<?php

use SportExperiment\Controller\Researcher\Login as ResearcherLogin;
use SportExperiment\Controller\Researcher\Dashboard;
use SportExperiment\Controller\Researcher\Session;
use SportExperiment\Filter\ResearcherAuthFilter;
use Illuminate\Support\Facades\Route;

use SportExperiment\Controller\Subject\Login as SubjectLogin;
use SportExperiment\Controller\Subject\PreGame\Registration;
use SportExperiment\Filter\SubjectAuthFilter;
use SportExperiment\Controller\Subject\Experiment;
use SportExperiment\Controller\Subject\PreGameHold;
use SportExperiment\Filter\SubjectRouteFilter;
use SportExperiment\Controller\Subject\Payoff;
use SportExperiment\Controller\Subject\Questionnaire;
use SportExperiment\Controller\Subject\Completed;
use SportExperiment\Controller\Subject\PreGame\Questionnaire as PreGameQuestionnaire;
use SportExperiment\Controller\Researcher\SessionTable;

Route::get('/', function(){});

/*
|--------------------------------------------------------------------------
| Researcher Routes
|--------------------------------------------------------------------------
 */
    // Researcher Login
    Route::get(ResearcherLogin::getRoute(), ResearcherLogin::getNamespace() . '@getLogin');
    Route::post(ResearcherLogin::getRoute(), array('before'=>'csrf', 'uses'=>ResearcherLogin::getNamespace() .'@postLogin'));

// Researcher Auth Filter Routes
Route::group(array('before'=>ResearcherAuthFilter::getName()), function(){

    // Dashboard
    Route::get(Dashboard::getRoute(), Dashboard::getNamespace() . '@getDashboard');

    // Subjects Table
    Route::get(SessionTable::getRoute(), SessionTable::getNamespace() . '@getSessionTable');

    // Session
    Route::get(Session::getRoute(), Session::getNamespace() . '@getSession');
    Route::post(Session::getRoute(), Session::getNamespace() . '@postSession');
    Route::post(Session::getUpdateRoute(), Session::getNamespace() . '@updateSession');
});

/*
|--------------------------------------------------------------------------
| Subject Routes
|--------------------------------------------------------------------------
 */
// Subject Login
Route::get(SubjectLogin::getRoute(), SubjectLogin::getNamespace() . '@getLogin');
Route::post(SubjectLogin::getRoute(), SubjectLogin::getNamespace() .'@postLogin');

// Subject Auth Filter Routes
Route::group(array('before'=>array(SubjectAuthFilter::getName(), SubjectRouteFilter::getName())), function(){
    // Registration
    Route::get(Registration::getRoute(), Registration::getNamespace() . '@getRegistration');
    Route::post(Registration::getRoute(), Registration::getNamespace() . '@postRegistration');

    // Pre-Game Questionnaire
    Route::get(PreGameQuestionnaire::getRoute(), PreGameQuestionnaire::getNamespace() . '@getQuestionnaire');
    Route::post(PreGameQuestionnaire::getRoute(), PreGameQuestionnaire::getNamespace() . '@postQuestionnaire');

    // Pre-Game Hold Screen
    Route::get(PreGameHold::getRoute(), PreGameHold::getNamespace() . '@getHold');

    // Game
    Route::get(Experiment::getRoute(), Experiment::getNamespace() . '@getExperiment');
    Route::post(Experiment::getRoute(), Experiment::getNamespace() . '@postExperiment');

    // Payoff
    Route::get(Payoff::getRoute(), Payoff::getNamespace() . '@getPayoff');
    Route::post(Payoff::getRoute(), Payoff::getNamespace() . '@postPayoff');

    // Questionnaire
    Route::get(Questionnaire::getRoute(), Questionnaire::getNamespace() . '@getQuestionnaire');
    Route::post(Questionnaire::getRoute(), Questionnaire::getNamespace() . '@postQuestionnaire');

    // Completion Display
    Route::get(Completed::getRoute(), Completed::getNamespace() . '@getCompleted');
});

/*
|--------------------------------------------------------------------------
| Filters
|--------------------------------------------------------------------------
 */
Route::filter(ResearcherAuthFilter::getName(), ResearcherAuthFilter::getNamespace());
Route::filter(SubjectAuthFilter::getName(), SubjectAuthFilter::getNamespace());
Route::filter(SubjectRouteFilter::getName(), SubjectRouteFilter::getNamespace());
