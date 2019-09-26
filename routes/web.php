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
Auth::routes();

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard','DashboardController@index')->name('dashboard');

Route::get('/newLead', 'LeadController@create')->name('lead.view');

Route::post('/newLead', 'LeadController@store')->name('lead.store');

Route::get('/leads', 'LeadController@index')->name('leads.index');

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

Route::get('/agentLead', function () {
    return view('leads.agentLead');
})->name('agentLead');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/users', 'UserController@index')->name('users');
Route::get('/user/add_new_user','UserController@add_new_user')->name('add_new_user');
Route::get('/user/edit/{id}','UserController@edit_user')->name('edit_user');
Route::post('/user/store_user_details','UserController@store_user_details')->name('store_user_details');
Route::delete('/user/delete','UserController@delete_user')->name('delete_user');
Route::get('/get_agent','LeadController@get_agents')->name('edit_user');
Route::get('/editLead/{lead_id}','LeadController@edit')->name('editLead');




