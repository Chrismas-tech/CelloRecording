<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentPaypalController extends Controller
{
    public function page_new_paypal_payment()
    {
        return view('page_new_paypal_payment');
    }
}
