<?php

namespace App\Http\Controllers;

use App\Mail\Messages;
use App\Mail\Order as MailOrder;
use App\Models\Order;
use App\Models\Quote;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

class PaypalController extends Controller
{
    public function execute_payment(Request $request)
    {
        //    $req = $request->all();
        //    dd($req);

        /*On récupère la variable Session*/
        $quote_id = $request->session()->get('quote_ready_payment');

        $quote = Quote::where('id', $quote_id)->first();
        $price = $quote->price / 100;


        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                'ATdLwCnmk4QOjLGuyaPvBVsdw7-4VZD550fppzEUzW7vvEta_qzDG8uAbC1euta2_KO_OSgyCzC0Axva',     // ClientID
                'EAaCbFvEvdO3chG5M8824QJ95J4-FKYXc5NvytBZ80uylqNjQCpg0fE8WUjJBRNxglBQaBcobX0WElDk'      // ClientSecret
            )
        );

        $paymentId = request('paymentId');
        $payment = Payment::get($paymentId, $apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId(request('PayerID'));

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

        $result = $payment->execute($execution, $apiContext);

        if (!($result->state == 'approved')) {
            return view('page_error')->with('message', 'The payment has not been approved by Paypal !');
        } else {

            if ($result->transactions[0]->amount->total == $price) {

                /* Destroy session variable */
                $request->session()->forget('quote_ready_payment');

                /*Destroy quote in table and create an order*/
                $this->destroy_quote_and_create_order($quote);

                return view('payment_success');
            } else {
                return view('page_error')->with('message', 'The payment has been approved, but there is a problem about the amount paid :( Please contact the administrator through the conversations section !');
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
        Mail::to($email_user)->send(new MailOrder($message,$user_name));

        return;
    }
}
