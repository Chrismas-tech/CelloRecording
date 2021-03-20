<?php

namespace App\Http\Controllers;

use App\Mail\Order as MailOrder;
use App\Models\Order;
use App\Models\Quote;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

class PaypalController extends Controller
{
    private $apiContext;

    public function __construct()
    {
        $api_Context = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                env('SANDBOX_CLIENT_ID'),   // ClientID
                env('SANDBOX_SECRET')      // ClientSecret
            )
        );

        /*
        .env change paypal_mode to live
        $api_Context = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                env('PAYPAL_CLIENT_ID'),   // ClientID
                env('PAYPAL_SECRET')      // ClientSecret
            )
        );

 
        $api_Context->setConfig(
            array(
                'log.LogEnabled' => true,
                'log.FileName' => 'PayPal.log',
                'log.LogLevel' => 'DEBUG',
                'mode' => env('PAYPAL_MODE')
            )
        );
        */

        $this->apiContext = $api_Context;
    }

    public function page_new_paypal_payment()
    {
        return view('page_new_paypal_payment');
    }

    public function create_order_paypal(Request $request)
    {

        /* On récupère la variable de Session qui contient l'id du devis, donc son prix initial */
        $quote_id = $request->session()->get('quote_ready_payment');
        $quote = Quote::where('id', $quote_id)->first();
        $price = $quote->price / 100;
 

        /* PHP PAYPAL SDK SAMPLE CODE https://paypal.github.io/PayPal-PHP-SDK/sample/doc/payments/CreatePaymentUsingPayPal.html*/

        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        $item1 = new Item();
        $item1->setName($quote->title)
            ->setCurrency('EUR')
            ->setQuantity(1)
            ->setSku("123123") // Similar to `item_number` in Classic API
            ->setPrice($price);

        $itemList = new ItemList();
        $itemList->setItems(array($item1));

        $details = new Details();
        $details->setShipping(0)
            ->setTax(0)
            ->setSubtotal($price);

        $amount = new Amount();
        $amount->setCurrency('EUR')
            ->setTotal($price)
            ->setDetails($details);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription($quote->title)
            ->setInvoiceNumber(uniqid());

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl("https://cellorecording.test/execute_payment")
            ->setCancelUrl("https://cellorecording.test/page-error");

        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));

        $payment->create($this->apiContext);

        return redirect($payment->getApprovalLink());
    }

    public function execute_payment(Request $request)
    {
        /* On récupère la variable de Session qui contient l'id du devis, donc son prix initial */
        $quote_id = $request->session()->get('quote_ready_payment');
        $quote = Quote::where('id', $quote_id)->first();
        $price = $quote->price / 100;

        /* PHP PAYPAL SDK SAMPLE CODE https://paypal.github.io/PayPal-PHP-SDK/sample/doc/payments/ExecutePayment.html*/

        $paymentId = $request['paymentId'];
        $payment = Payment::get($paymentId, $this->apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($request['PayerID']);

        $transaction = new Transaction();
        $amount = new Amount();
        $details = new Details();

        $details->setShipping(0)
            ->setTax(0)
            ->setSubtotal($price);

        $amount->setCurrency('EUR');
        $amount->setTotal($price);
        $amount->setDetails($details);
        $transaction->setAmount($amount);

        $execution->addTransaction($transaction);
        $result = $payment->execute($execution, $this->apiContext);
        $response = $result->state;
        //dd($result->transactions[0]->amount->total);

        if ($response !== 'approved') {
            return view('page_error')->with('message', 'The payment has not been approved by Paypal !');
        } else {

            if ($result->transactions[0]->amount->total == $price) {
                /* Destroy session variable */
                $request->session()->forget('quote_ready_payment');

                /*Destroy quote in table and create an order*/
                $this->destroy_quote_and_create_order($quote);

                return view('payment-success');
            } else {
                return view('page-error')->with('message', 'The payment has been approved, but there is a problem about the amount paid :( Please contact the administrator through the conversation section !');
            }
        }
    }

    private function destroy_quote_and_create_order($quote)
    {
        $datas = [
            'user_id' => $quote->user_id,
            'title' =>  $quote->title,
            'description' =>  $quote->description,
            'price' =>  $quote->price,
            'nb_days' =>  $quote->nb_days,
            'status' => 3,
        ];

        Order::create($datas);

        /* On supprime la custom offer puisqu'elle est acceptée */
        Quote::destroy($quote->id);

        /*On envoie un mail à l'utilisateur*/
        $user = User::find($quote->user_id);
        $email_user = $user->email;
        $user_name = $user->name;

        $message = "Your order has been confirmed !";
        Mail::to($email_user)->send(new MailOrder($message, $user_name));

        return;
    }
}
