<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::redirect('home','dashboard'); //Kudu teang auth route

Route::middleware(['auth'])->group(function(){
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('/profile', 'ProfileController@profile');

    Route::get('/mail', 'MailController@mailer'); //Kosong keneh gan

    Route::get('/group', 'GroupController@groupList');
    Route::get('/group/create', 'GroupController@createView');
    Route::post('/group/create', 'GroupController@create');
    Route::get('/group/{id}', 'GroupController@groupDetail')->where('id', '[0-9999999]+'); //Kemungkinan aya bug konyol
    Route::get('/group/{id}/member', 'GroupController@memberList');

    Route::get('/group/join', 'GroupController@joinView');

    Route::post('/group/join', 'GroupController@join')->middleware(['isValidCode','groupMode']);

    Route::middleware(['isAdmin'])->group(function(){
        // Owner and admin can change this route
        Route::get('/group/{id}/settings', 'AdminController@settingsView');
        Route::post('/group/{id}/settings', 'AdminController@settings');

        // User request to join group with mode 'invite_only'
        Route::get('/group/{id}/pending', 'AdminController@userInPending');
        Route::post('/group/{id}/pending', 'AdminController@userChangeStatus');

        Route::middleware(['isOwner'])->group(function(){
             // Role management
            Route::get('/group/{id}/adminship', 'AdminController@adminship'); //List admin
            
            Route::get('/group/{id}/adminship/add', 'AdminController@addAdminshipView'); //Show list member
            Route::post('/group/{id}/adminship/add', 'AdminController@addAdminship')->middleware('checkAdmin');
        });

    });
});  //HOHOHIHE