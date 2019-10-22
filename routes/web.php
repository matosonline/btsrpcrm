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
Auth::routes(['register' => false]);
Route::get('/dashboard','DashboardController@index')->name('dashboard');

Route::get('/agentLead', function () {
    return view('leads.agentLead');
})->name('agentLead');

Route::get('/getAutocompleteData','DashboardController@getAutocompleteData');
Route::get('/searchData','DashboardController@searchData')->name('search.data');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/users', 'UserController@index')->name('users');
Route::get('/user/add_new_user','UserController@add_new_user')->name('add_new_user');
Route::get('/user/edit/{id}','UserController@edit_user')->name('edit_user');
Route::post('/user/store_user_details','UserController@store_user_details')->name('store_user_details');
Route::delete('/user/delete','UserController@delete_user')->name('delete_user');

Route::get('/leads', 'LeadController@index')->name('leads.index');
Route::get('/get_agent','LeadController@get_agents')->name('edit_user');
Route::get('/editLead/{lead_id}','LeadController@edit')->name('editLead');
Route::delete('/attach/delete','LeadController@delete_attach')->name('delete_attach');
Route::match(['get','post'],'/newLead', 'LeadController@create')->name('lead.view');
Route::post('/newLead', 'LeadController@store')->name('lead.store');
Route::get('/view/logDetail','LogController@viewLogDetail');


Route::get('/viewprofile', 'UserController@profile')->name('user.profile');
Route::get('/changePassword', 'UserController@changePassword')->name('user.changePassword');
Route::post('/editPassword', 'UserController@editPassword')->name('user.editPassword');
Route::get('/centers', 'CenterController@index')->name('center.index');
Route::get('/newCenter', 'CenterController@create')->name('center.view');
Route::post('/newCenter', 'CenterController@store')->name('center.store');
Route::get('/editCenter/{center_id}','CenterController@edit')->name('editcenter');


Route::get('/newProvider', 'DoctorController@create')->name('newProvider');
Route::get('/providers', 'DoctorController@index')->name('providers');
Route::post('/newProvider', 'DoctorController@store')->name('provider.store');
Route::get('/editProvider/{provider_id}','DoctorController@edit')->name('editprovider');

Route::get('/viewAllLogs','LogController@viewAllLogs')->name('viewAllLogs');
Route::get('/viewProviderLog/{provider_id}','LogController@viewProviderLog')->name('viewProviderLog');
Route::get('/viewCenterLog/{center_id}','LogController@viewCenterLog')->name('viewCenterLog');
Route::get('/viewLeadLog/{lead_id}','LogController@viewLeadLog')->name('viewLeadLog');
Route::get('/viewUserLog/{user_id}','LogController@viewUserLog')->name('viewUserLog');

Route::get('/excelExport','DashboardController@excelExport')->name('excelExport');