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

/*USER*/

require __DIR__.'/auth.php';

/*CONTACT-FORM*/
Route::get('/contact', [UserController::class, 'page_contact'])->name('contact');
Route::post('/send_contact_email', [UserController::class, 'page_send_contact_email'])->name('send_contact_email');

/*USER*/ 
/*USER*/ 
/*USER*/ 
/*USER*/ 

Route::get('/dashboard', [UserController::class, 'page_dashboard'])->middleware(['auth'])->name('dashboard');

/*CONVERSATIONS*/
Route::get('/conversation', [UserController::class, 'page_conversation'])->middleware(['auth'])->name('conversation');
Route::post('/new_conversation', [UserController::class, 'new_conversation'])->name('new_conversation');

/*PROFILE*/
Route::get('/profile', [UserController::class, 'page_profile'])->middleware(['auth'])->name('profile');
Route::post('/update_profile', [UserController::class, 'update_profile'])->middleware(['auth'])->name('update_profile');
Route::delete('/delete_account', [UserController::class, 'delete_account'])->middleware(['auth'])->name('delete_account');

/*QUOTES*/ 
Route::get('/quotes_received', [UserController::class, 'page_quotes_received'])->middleware(['auth'])->name('quotes_received');
Route::delete('/quotes_decline/{quote_id}', [UserController::class, 'quotes_decline'])->middleware(['auth'])->name('quotes_decline');

/*ORDERS*/
Route::get('/orders', [UserController::class, 'page_orders'])->middleware(['auth'])->name('orders');
Route::get('/order_view/{order_id}', [UserController::class, 'page_order_view'])->middleware(['auth'])->name('order_view');

/*DELIVERY*/
Route::get('/deliveries', [UserController::class, 'page_deliveries'])->middleware(['auth'])->name('deliveries');
Route::post('/delivery_view/{delivery_id}', [UserController::class, 'page_delivery_view'])->middleware(['auth'])->name('delivery_view');

Route::patch('/update_delivery', [UserController::class, 'update_delivery'])->middleware(['auth'])->name('update_delivery');


/*CHANGE PASSWORD*/
Route::post('/change_password', [ChangePasswordController::class, 'change_password'])->middleware(['auth'])->name('change_password');


/*ADMIN*/
/*ADMIN*/
/*ADMIN*/
/*ADMIN*/

Route::get('/dashboard_admin', [AdminController::class, 'page_dashboard'])->name('dashboard_admin');
Route::get('/quotes_sent', [AdminController::class, 'page_quotes_sent'])->name('quotes_sent');
Route::get('/list_conversation_admin', [AdminController::class, 'page_list_conversation_admin'])->name('list_conversation_admin');
Route::get('/quote_form/{user_id}', [AdminController::class, 'page_quote_form'])->name('quote_form');
Route::post('/send_quote_client', [AdminController::class, 'send_quote_client'])->name('send_quote_client');
Route::get('/orders_admin', [AdminController::class, 'page_orders_admin'])->name('orders_admin');
Route::get('/order_view_admin/{order_id}', [AdminController::class, 'page_order_view_admin'])->name('order_view_admin');
;

/*UPLOAD MUSIC*/ 
Route::post('/upload_music_user', [UploadfileController::class, 'upload_music_user'])->middleware(['auth'])->name('upload_music_user');
Route::post('/upload_music_admin/{user_id}', [UploadfileController::class, 'upload_music_admin'])->name('upload_music_admin');
Route::post('/upload_delivery', [UploadfileController::class, 'upload_delivery'])->name('upload_delivery');


/* ADMIN-MINUTEUR */ 
Route::get('/date_minuteur', [DateChangeController::class, 'date_minuteur'])->name('date_minuteur');


Route::post('/new_conversation_admin/{user_id}', [AdminController::class, 'new_conversation_admin'])->name('new_conversation_admin');
Route::get('/conversation_with_user/{user_id}', [AdminController::class, 'conversation_with_user'])->name('conversation_with_user');
Route::post('/uploadphoto', [UploadfileController::class, 'uploadphoto'])->name('uploadphoto');



/*GET MUSIC-FILE CONVERSATION*/
Route::get('/download_music_file_user/{message_id}', [UserController::class, 'download_music_file_user'])->name('download_music_file_user');

Route::get('/download_music_file_admin/{message_id}/{user_id}', [AdminController::class, 'download_music_file_admin'])->name('download_music_file_admin');


/*GET MUSIC-FILE DELIVERY*/
Route::get('/download_delivery_file/{file_id}', [AdminController::class, 'download_delivery_file'])->name('download_delivery_file');

/* BAC A SABLE */

Route::get('/bac-a-sable', function () {
    return view('bac-a-sable.bac-a-sable' , [
        'info' => 'Very cool information',
    ]);
});

Route::get('/bac-a-sable-2', function () {
    return view('bac-a-sable.bac-a-sable-2');
});

Route::get('/msg_to_user', function () {
    return view('emails.msg_to_user');
});




/*PAYPAL-PAGE*/ 
Route::post('/page_paypal_payment/{quote_id}/{price}', [AdminController::class, 'page_paypal_payment'])->middleware(['auth'])->name('page_paypal_payment');

Route::get('/execute_payment', [PaypalController::class, 'execute_payment'])->name('execute_payment');

