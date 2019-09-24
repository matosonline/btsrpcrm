<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
   return view('dashboard');
})->name('dashboard');

Route::get('/newLead', 'LeadController@create')->name('lead.view');

Route::post('/newLead', 'LeadController@store')->name('lead.store');

Route::get('/leads', 'LeadController@index')->name('leads.index');


Route::get('/agentLead', function () {
    return view('leads.agentLead');
})->name('agentLead');


Route::get('/newCenter', function () {
    return view('centers.newCenter');
})->name('newCenter');

Route::get('/centers', function () {
    return view('centers.index');
})->name('centers');

Route::get('/newProvider', function () {
    return view('providers.newProvider');
})->name('newProvider');

Route::get('/providers', function () {
    return view('providers.index');
})->name('providers');
