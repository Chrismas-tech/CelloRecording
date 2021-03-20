<?php

namespace App\Http\Controllers;

use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;

class SEOController extends Controller
{
    public static function metaTag($name_route)
    {
        SEOMeta::setCanonical('https://cellorecording.com/' . $name_route);

        switch ($name_route) {
                /* ROUTE LOGIN */
            case $name_route == 'login':
                SEOMeta::setTitle('Login into your account');
                SEOMeta::setDescription('Login into your account on Cellorecording.com, fill the following formular');
                SEOMeta::addKeyword([
                    'cellorecording.com',
                    'Cello recording',
                    'Login into your account',
                ]);
                break;

                /* ROUTE REGISTER */
            case $name_route == 'register':
                SEOMeta::setTitle('Create your account');
                SEOMeta::setDescription('Create your account on Cellorecording.com, fill the following formular');
                SEOMeta::addKeyword([
                    'cellorecording.com',
                    'Cello recording',
                    'Register a new account',
                    'Create your account',
                ]);
                break;

                /* ROUTES USER */
            case $name_route == '/':
                SEOMeta::setTitle('Professional Cello Recording Services Online | 7/7 days');
                SEOMeta::setDescription('In need of a Professional Cellist for your next musical project ? On Cellorecording.com, get a quote and order your professional cello recording today !');
                SEOMeta::addKeyword([
                    'cellorecording.com',
                    'cello recording studio',
                    'cello recording online',
                    'cello recording app',
                    'cello recordings best',
                    'cello recording techniques',
                    'recording cello at home',
                    'cello audio recording',
                    'cello recording studios los angeles',
                    'recording a cello',
                    'best cello recording',
                    'recording for cello',
                    'cello home recording',
                    'cello in recording ',
                    'remote cello recording',
                    'recording cello solo',
                    'recording setup cello',
                    'how to record cello at home',
                    'how to recording cello sound',
                    'cello customer service',
                    'cello wrapping services',
                    'cello customer service number',
                    'cello customer care',
                    'cello tv customer service',
                    'cello connection',
                    '2 cello',
                    '2cellos',
                    'recording cello',
                    'cello session player',
                    'remote cello recording online',
                ]);
                break;

            case $name_route == 'contact':
                SEOMeta::setTitle('Contact page');
                SEOMeta::setDescription('On this page you can send an email to cellorecording.com');
                SEOMeta::addKeyword([
                    'cellorecording.com',
                    'Dashboard',
                    'Proceed for a cello recording',
                    'Guide',
                ]);
                break;

            case $name_route == 'dashboard':
                SEOMeta::setTitle('Dashboard');
                SEOMeta::setDescription('Here is your dashboard, follow the guide below to proceed for a cello recording');
                SEOMeta::addKeyword(['Dashboard', 'cellorecording.com', 'Follow the guide', 'Home page']);
                break;

            case $name_route == 'conversation':
                SEOMeta::setTitle('Conversation');
                SEOMeta::setDescription('Start a conversation with me and describe your project in a few words');
                SEOMeta::addKeyword(['Conversation', 'cellorecording.com', 'Start a conversation', 'Conversation page Page']);
                break;

            case $name_route == 'quotes-received':
                SEOMeta::setTitle('Quotes');
                SEOMeta::setDescription('Here you can access to your personal quotes list, once you agree about the charge by mutual agreement');
                SEOMeta::addKeyword(['Quotes', 'cellorecording.com', 'Your Quotes list', 'Quotes page']);
                break;

            case $name_route == 'paypal-payment/{quote_id}':
                SEOMeta::setTitle('Paypal Payment');
                SEOMeta::setDescription('Order your custom-made cello recording safely via Paypal');
                SEOMeta::addKeyword(['Paypal Payment', 'cellorecording.com', 'Proceed for payment via Paypal', 'Payment page']);
                break;

            case $name_route == 'orders':
                SEOMeta::setTitle('Orders');
                SEOMeta::setDescription('Here you can check your current orders and access to them by clicking on the delivery link when your cello recording is ready');
                SEOMeta::addKeyword(['Orders', 'cellorecording.com', 'Your Orders list', 'Orders page']);
                break;

            case $name_route == 'delivery-view/{delivery_id}':
                SEOMeta::setTitle('Delivery');
                SEOMeta::setDescription('Here you can listen and download your delivery, then you can confirm or ask a revision for free');
                SEOMeta::addKeyword(['Delivery', 'cellorecording.com', 'Your Delivery', 'Delivery page']);
                break;

            case $name_route == 'deliveries':
                SEOMeta::setTitle('Deliveries');
                SEOMeta::setDescription('Here you can check all of your deliveries completed or in waiting for your approval');
                SEOMeta::addKeyword(['Deliveries', 'cellorecording.com', 'Your Deliveries', 'Deliveries page']);
                break;

            case $name_route == 'profile':
                SEOMeta::setTitle('Profile');
                SEOMeta::setDescription('Here you can change your profile\'s photo, your email, your username and your password');
                SEOMeta::addKeyword(['Profile', 'cellorecording.com', 'Your Profile', 'Deliveries page', 'Your account', 'Change password', 'Change username', 'Change email']);
                break;

                /* ROUTES ADMIN */
            case $name_route == 'admin':
                SEOMeta::setTitle('Admin - Connection');
                SEOMeta::setDescription('Here is the page reserved to the administrator connection');
                SEOMeta::addKeyword(['Admin', 'cellorecording.com', 'Admin connection page']);
                break;

            case $name_route == 'dashboard-admin':
                SEOMeta::setTitle('Admin - Dashboard');
                SEOMeta::setDescription('Here is the dashboard page reserved to the administrator');
                SEOMeta::addKeyword(['Admin', 'cellorecording.com', 'Admin dashboard page']);
                break;

            case $name_route == 'list-conversation-admin':
                SEOMeta::setTitle('Admin - List of Conversation');
                SEOMeta::setDescription('Here is the list conversation page reserved to the administrator');
                SEOMeta::addKeyword(['Admin', 'cellorecording.com', 'Admin - list of conversation page']);
                break;

            case $name_route == 'conversation-with-user/{user_id}':
                SEOMeta::setTitle('Admin - Conversation with user');
                SEOMeta::setDescription('Here is the current conversation with the client, a page reserved to the administrator');
                SEOMeta::addKeyword(['Admin', 'cellorecording.com', 'Admin - current conversation witth the client']);
                break;

            case $name_route == 'quotes-sent':
                SEOMeta::setTitle('Admin - Quotes sent to clients');
                SEOMeta::setDescription('Here is the list of quotes sent to clients, a page reserved to the administrator');
                SEOMeta::addKeyword(['Admin', 'cellorecording.com', 'Admin - page of quotes sent to clients']);
                break;

            case $name_route == 'quote-form/{user_id}':
                SEOMeta::setTitle('Admin - Create the quote and send it to the client');
                SEOMeta::setDescription('Here is a page dedicated to the creation of a quote for the clients,reserved to the administrator');
                SEOMeta::addKeyword(['Admin', 'cellorecording.com', 'Admin - Creation of a quote']);
                break;

            case $name_route == 'orders-admin':
                SEOMeta::setTitle('Admin - Current Orders');
                SEOMeta::setDescription('Here is the list of current orders of clients, a page reserved to the administrator');
                SEOMeta::addKeyword(['Admin', 'cellorecording.com', 'Admin - list of current orders']);
                break;

            case $name_route == 'order-view-admin/{order_id}':
                SEOMeta::setTitle('Admin - View current order');
                SEOMeta::setDescription('Here is a page dedicated to the upload delivery, reserved to the administrator');
                SEOMeta::addKeyword(['Admin', 'cellorecording.com', 'Admin - View current order']);
                break;
        }
    }
}
