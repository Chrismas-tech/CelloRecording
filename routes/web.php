<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\DateChangeController;
use App\Http\Controllers\MonController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\UploadfileController;
use App\Http\Controllers\UserController;
use App\Mail\ContactMail;
use App\Models\User;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Mail;
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

/* WELCOME PAGE */

Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';

/* PAGE ERROR*/
Route::get('/not_authorized', function () {
    return view('not_authorized');
});

/*CONTACT-FORM*/
Route::get('/contact', [UserController::class, 'page_contact'])->name('contact');
Route::post('/send_contact_email', [UserController::class, 'page_send_contact_email'])->name('send_contact_email');

/*USER*/ 
/*USER*/ 
/*USER*/ 
/*USER*/ 

Route::get('/dashboard', [UserController::class, 'page_dashboard'])->name('dashboard');

/*CONVERSATIONS*/
Route::get('/conversation', [UserController::class, 'page_conversation'])->name('conversation');
Route::post('/new_conversation', [UserController::class, 'new_conversation'])->name('new_conversation');

/*PROFILE*/
Route::get('/profile', [UserController::class, 'page_profile'])->name('profile');
Route::post('/update_profile', [UserController::class, 'update_profile'])->name('update_profile');
Route::delete('/delete_account', [UserController::class, 'delete_account'])->name('delete_account');

/*QUOTES*/ 
Route::get('/quotes_received', [UserController::class, 'page_quotes_received'])->name('quotes_received');
Route::delete('/quotes_decline/{quote_id}', [UserController::class, 'quotes_decline'])->name('quotes_decline');

/*ORDERS*/
Route::get('/orders', [UserController::class, 'page_orders'])->name('orders');
Route::get('/order_view/{order_id}', [UserController::class, 'page_order_view'])->name('order_view');

/*DELIVERY*/
Route::get('/deliveries', [UserController::class, 'page_deliveries'])->name('deliveries');
Route::post('/delivery_view/{delivery_id}', [UserController::class, 'page_delivery_view'])->name('delivery_view');

Route::patch('/update_delivery', [UserController::class, 'update_delivery'])->name('update_delivery');

/*CHANGE PASSWORD*/
Route::post('/change_password', [ChangePasswordController::class, 'change_password'])->name('change_password');

/* UPLOAD PHOTO*/
Route::post('/uploadphoto', [UploadfileController::class, 'uploadphoto'])->name('uploadphoto');

/*UPLOAD MUSIC*/ 
Route::post('/upload_music_user', [UploadfileController::class, 'upload_music_user'])->name('upload_music_user');

Route::post('/upload_music_admin/{user_id}', [UploadfileController::class, 'upload_music_admin'])->name('upload_music_admin');
Route::post('/upload_delivery', [UploadfileController::class, 'upload_delivery'])->name('upload_delivery');

/*ADMIN*/
/*ADMIN*/
/*ADMIN*/
/*ADMIN*/

/* CONNECTION ADMIN*/

Route::get('/admin', [AdminController::class, 'page_admin'])->name('admin');
Route::get('/admin_logout', [AdminController::class, 'page_admin_logout'])->name('admin_logout');
Route::get('/dashboard_admin', [AdminController::class, 'page_dashboard'])->name('dashboard_admin');

/* fausse route pour retourner sur le Middleware et valider le mot de passe et le name */ 
Route::post('/connection_admin', [AdminController::class, 'connection_admin'])->name('connection_admin');

/* SIDE ADMIN */


Route::get('/quotes_sent', [AdminController::class, 'page_quotes_sent'])->name('quotes_sent');
Route::get('/list_conversation_admin', [AdminController::class, 'page_list_conversation_admin'])->name('list_conversation_admin');
Route::get('/quote_form/{user_id}', [AdminController::class, 'page_quote_form'])->name('quote_form');
Route::post('/send_quote_client', [AdminController::class, 'send_quote_client'])->name('send_quote_client');
Route::get('/orders_admin', [AdminController::class, 'page_orders_admin'])->name('orders_admin');
Route::get('/order_view_admin/{order_id}', [AdminController::class, 'page_order_view_admin'])->name('order_view_admin');
Route::post('/new_conversation_admin/{user_id}', [AdminController::class, 'new_conversation_admin'])->name('new_conversation_admin');
Route::get('/conversation_with_user/{user_id}', [AdminController::class, 'conversation_with_user'])->name('conversation_with_user');

/* ADMIN-MINUTEUR */ 
Route::get('/date_minuteur', [DateChangeController::class, 'date_minuteur'])->name('date_minuteur');

/*GET MUSIC-FILE CONVERSATION*/
Route::get('/download_music_file_user/{message_id}', [UserController::class, 'download_music_file_user'])->name('download_music_file_user');
Route::get('/download_music_file_admin/{message_id}/{user_id}', [AdminController::class, 'download_music_file_admin'])->name('download_music_file_admin');

/*GET MUSIC-FILE DELIVERY*/
Route::get('/download_delivery_file/{file_id}', [AdminController::class, 'download_delivery_file'])->name('download_delivery_file');

/*PAYPAL-PAGE*/ 
Route::post('/page_paypal_payment/{quote_id}/{price}', [UserController::class, 'page_paypal_payment'])->name('page_paypal_payment');

Route::get('/execute_payment', [PaypalController::class, 'execute_payment'])->name('execute_payment');

/* BAC A SABLE */

Route::get('/bac-a-sable', function () {
    return view('bac-a-sable.bac-a-sable' , [
        'info' => 'Very cool information',
    ]);
});

Route::get('/bac-a-sable-2', function () {
    return view('bac-a-sable.bac-a-sable-2');
});



