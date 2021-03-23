<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\DateChangeController;
use App\Http\Controllers\FileServeAdmin;
use App\Http\Controllers\FileServeUser;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\UploadfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\File;
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

require __DIR__ . '/auth.php';
 
/* WELCOME PAGE */

Route::get('/', [UserController::class, 'page_welcome']);

/* PAGE ERROR */
Route::get('/not_authorized', function () {
    return view('not_authorized');
});

/*CONTACT-FORM */
Route::get('/contact', [UserController::class, 'page_contact'])->name('contact');
Route::post('/send_contact_email', [UserController::class, 'page_send_contact_email'])->name('send_contact_email');

/*USER*/
/*USER*/
/*USER*/
/*USER*/

Route::get('/dashboard', [UserController::class, 'page_dashboard'])->name('dashboard');

/*CONVERSATIONS */
Route::get('/conversation', [UserController::class, 'page_conversation'])->name('conversation');
Route::post('/new_conversation', [UserController::class, 'new_conversation'])->name('new_conversation');

/* PROFILE */
Route::get('/profile', [UserController::class, 'page_profile'])->name('profile');
Route::post('/update_profile', [UserController::class, 'update_profile'])->name('update_profile');
Route::delete('/delete_account', [UserController::class, 'delete_account'])->name('delete_account');

/* QUOTES */
Route::get('/quotes-received', [UserController::class, 'page_quotes_received'])->name('quotes-received');
Route::delete('/quotes_decline/{quote_id}', [UserController::class, 'quotes_decline'])->name('quotes_decline');

/* ORDERS */
Route::get('/orders', [UserController::class, 'page_orders'])->name('orders');
Route::get('/order_view/{order_id}', [UserController::class, 'page_order_view'])->name('order_view');

/* DELIVERY */
Route::get('/deliveries', [UserController::class, 'page_deliveries'])->name('deliveries');
Route::post('/delivery-view/{delivery_id}', [UserController::class, 'page_delivery_view'])->name('delivery-view');

Route::patch('/update_delivery', [UserController::class, 'update_delivery'])->name('update_delivery');

/* CHANGE PASSWORD */
Route::post('/change_password', [ChangePasswordController::class, 'change_password'])->name('change_password');

/* UPLOAD PHOTO */
Route::post('/uploadphoto', [UploadfileController::class, 'uploadphoto'])->name('uploadphoto');

/* UPLOAD MUSIC */
Route::post('/upload_music_user', [UploadfileController::class, 'upload_music_user'])->name('upload_music_user');

Route::post('/upload_music_admin/{user_id}', [UploadfileController::class, 'upload_music_admin'])->name('upload_music_admin');
Route::post('/upload_delivery', [UploadfileController::class, 'upload_delivery'])->name('upload_delivery');

/* PAGE ERROR */
Route::get('/page-error', function() {
return view('page_error');
});

/*ADMIN*/
/*ADMIN*/
/*ADMIN*/
/*ADMIN*/

/* CONNECTION ADMIN*/

Route::get('/admin', [AdminController::class, 'page_admin'])->name('admin');
Route::get('/admin_logout', [AdminController::class, 'page_admin_logout'])->name('admin_logout');
Route::get('/dashboard-admin', [AdminController::class, 'page_dashboard'])->name('dashboard-admin');

/* fausse route pour retourner sur le Middleware et valider le mot de passe et le name */
Route::post('/connection_admin', [AdminController::class, 'connection_already_verified'])->name('connection_admin');

/* SIDE ADMIN */

Route::get('/quotes-sent', [AdminController::class, 'page_quotes_sent'])->name('quotes-sent');
Route::get('/list-conversation-admin', [AdminController::class, 'page_list_conversation_admin'])->name('list-conversation-admin');
Route::get('/quote-form/{user_id}', [AdminController::class, 'page_quote_form'])->name('quote-form');
Route::post('/send_quote_client', [AdminController::class, 'send_quote_client'])->name('send_quote_client');
Route::get('/orders-admin', [AdminController::class, 'page_orders_admin'])->name('orders-admin');
Route::get('/order-view-admin/{order_id}', [AdminController::class, 'page_order_view_admin'])->name('order-view-admin');
Route::post('/new_conversation_admin/{user_id}', [AdminController::class, 'new_conversation_admin'])->name('new_conversation_admin');
Route::get('/conversation-with-user/{user_id}', [AdminController::class, 'conversation_with_user'])->name('conversation-with-user');

/* ADMIN-MINUTEUR */
Route::get('/date_minuteur', [DateChangeController::class, 'date_minuteur'])->name('date_minuteur');

/*GET MUSIC-FILE CONVERSATION*/
/*GET MUSIC-FILE CONVERSATION*/
/*GET MUSIC-FILE CONVERSATION*/
/*GET MUSIC-FILE CONVERSATION*/

Route::get('/download_music_file_user/{message_id}/{message_type}', [FileServeUser::class, 'download_music_file_user'])->name('download_music_file_user');
Route::get('/download_music_file_admin/{message_id}/{user_id}/{message_type}', [FileServeAdmin::class, 'download_music_file_admin'])->name('download_music_file_admin');

/*GET MUSIC-FILE DELIVERY*/
/*GET MUSIC-FILE DELIVERY*/
/*GET MUSIC-FILE DELIVERY*/
/*GET MUSIC-FILE DELIVERY*/

/* USER */
Route::get('/download_delivery_file_user/{delivery_id}', [FileServeUser::class, 'download_delivery_file_user'])->name('download_delivery_file_user');

/* ADMIN */
Route::get('/download_delivery_file_admin/{user_id}/{delivery_id}', [FileServeAdmin::class, 'download_delivery_file_admin'])->name('download_delivery_file_admin');

/* AUDIO FILE SERVE DELIVERY */
/* AUDIO FILE SERVE DELIVERY */
/* AUDIO FILE SERVE DELIVERY */
/* AUDIO FILE SERVE DELIVERY */

/* USER */
Route::get('/audio_delivery_user/{delivery_id}', [FileServeUser::class, 'audio_delivery_user'])->name('audio_delivery_user');

/* ADMIN */
Route::get('/audio_delivery_admin/{user_id}/{delivery_id}', [FileServeAdmin::class, 'audio_delivery_admin'])->name('audio_delivery_admin');


/*PAYPAL-PAGE*/
Route::post('/paypal-payment/{quote_id}', [UserController::class, 'page_paypal_payment'])->name('paypal-payment');
Route::get('/create_order_paypal', [PaypalController::class, 'create_order_paypal'])->name('create_order_paypal');
Route::get('/execute_payment', [PaypalController::class, 'execute_payment'])->name('execute_payment');


/* FILE IMAGE PROFILE SERVE */
/* USER */
Route::get('/profile_image/{user_id}', [FileServeUser::class, 'profile_image_serve'])->name('profile_image');
Route::get('/download_demo_cello', [FileServeUser::class, 'download_demo_cello'])->name('download_demo_cello');

