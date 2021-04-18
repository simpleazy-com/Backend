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


Route::get('/home', function(){
    return redirect('/dashboard');
});
//Socialite
Route::get('/redirect', 'Auth\LoginController@redirectToProvider');
Route::get('/callback', 'Auth\LoginController@handleProviderCallback');

Route::middleware(['auth'])->group(function(){

    Route::get('/logout', function(){
        Auth::logout();
        return redirect('/dashboard');
    });

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('/profile', 'ProfileController@profile');
    Route::get('/profile/edit', 'ProfileController@editProfileView');
    Route::post('/profile/edit', 'ProfileController@editProfile');

    Route::get('/mail', 'MailController@mailer'); //Kosong keneh gan

    Route::get('/group', 'GroupController@groupList');
    Route::get('/group/create', 'GroupController@createView');
    Route::post('/group/create', 'GroupController@create');
    Route::get('/group/{id}', 'GroupController@groupDetail')->where('id', '[0-9999999]+'); 
    Route::get('/group/{id}/member', 'GroupController@memberList');

    Route::get('/group/join', 'GroupController@joinView');

    Route::post('/group/join', 'GroupController@join')->middleware(['isValidCode','groupMode']);

    Route::get('/group/{id}/info', 'GroupController@infoView');
    Route::post('/group/{group_id}/member/kick', 'AdminController@kickMember');
    Route::get('/group/{id}/payment/list', 'PaymentController@index');

    Route::post('/group/leave','GroupController@leaveGroup');

    Route::middleware(['isAdmin'])->group(function(){
        // Owner and admin can change this route
        Route::get('/group/{id}/settings', 'AdminController@settingsView');
        Route::post('/group/{id}/settings', 'AdminController@settings');

        // User request to join group with 'invite_only' mode 
        Route::post('/group/{id}/pending', 'AdminController@changePendingStatus');
        
        // Payment routes
        Route::get('/group/{id}/payment/add','PaymentController@addPaymentView');
        Route::post('/group/{id}/payment/add','PaymentController@addPayment');
        // Route::post('/group/{id}/payment/{user_id}', 'PaymentController@userDetailPayment');

        Route::get('/group/{id}/payment/{payment_id}', 'PaymentController@checkUserPaymentStatus')->where('payment_id', '[0-9999999]+');
        Route::post('/group/{id}/payment/{payment_id}', 'PaymentController@changeAsPaidPayment');

        Route::get('/group/{id}/payment/list/report', 'PaymentController@paymentList');
        Route::post('/group/{id}/payment/{payment_id}/report/export', 'PaymentController@exportReportPayment');


        Route::get('/group/{id}/paymentadmin','PaymentController@paymentAdminView');
        Route::post('/group/{id}/paymentadmin/delete','PaymentController@deletePayment');
        
        // Statistic
        Route::get('/group/{id}/payment/status', 'PaymentController@graph');
        
        Route::middleware(['isOwner'])->group(function(){
            Route::get('/group/{id}/adminship', 'AdminController@adminship');
            Route::get('/group/{id}/adminship/add', 'AdminController@addAdminshipView');
            Route::post('/group/{id}/adminship/add', 'AdminController@addAdminship')->middleware('checkAdmin');
            Route::post('/group/{id}/adminship/demote', 'AdminController@demoteAdminshipStatus');
        });
    });
});