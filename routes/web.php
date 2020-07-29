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

    Route::get('/group', 'GroupController@groupList');
    Route::get('/group/create', 'GroupController@createView');
    Route::post('/group/create', 'GroupController@create');
    Route::get('/group/{id}', 'GroupController@groupDetail')->where('id', '[0-9999999]+'); //Kemungkinan aya bug konyol

    Route::get('/group/join', 'GroupController@joinView');

    Route::post('/group/join', 'GroupController@join')->middleware(['isValidCode','groupMode']);

    Route::middleware(['isOwner'])->group(function(){
        Route::get('/group/{id}/edit', function(){
            return 'Horay youre an administrator';
        });
    });
});

