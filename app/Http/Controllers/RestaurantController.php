<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Dish;
use App\Order;
use Braintree;

use App\Mail\RestaurantMail;
use Illuminate\Support\Facades\Mail;


class RestaurantController extends Controller
{
    private $formValidation = [
        'customer_name' => 'required | max: 60',
        'customer_address' => 'required | max: 80',
        'customer_phone' => 'required | max: 15',
    ];

    public function index() {

        return view('welcome');
    }

    public function show($slug) {
        $restaurant = User::where('slug',$slug)->firstOrFail();
        return view('restaurant', compact('restaurant'));
    }

    public function checkout($slug) {
        $gateway = new \Braintree\Gateway([
            'environment' => 'sandbox',
            'merchantId' => 'fdwwwgk9c98rpnmx',
            'publicKey' => 'rjq46pcqt9hnsxk7',
            'privateKey' => '3268625269af69822cf891dd65c46fef'
        ]);
    
        $token = $gateway->ClientToken()->generate();
        $restaurant = User::where('slug',$slug)->firstOrFail();
        return view('checkout', compact('restaurant', 'token'));
    }

    public function store(Request $request) {
        $data = $request->all();
        $request->validate($this->formValidation);
   
        $newOrder = new Order();
        $newOrder->fill($data);
        $newOrder['order_status'] = 'accepted';
        
        //Braintree
        $gateway = new \Braintree\Gateway([
            'environment' => 'sandbox',
            'merchantId' => 'fdwwwgk9c98rpnmx',
            'publicKey' => 'rjq46pcqt9hnsxk7',
            'privateKey' => '3268625269af69822cf891dd65c46fef'
        ]);
        
        
        $newOrder->save();
        $count = 0;
        for ($j=0; $j < count($data['quantity']) ; $j++) { 
            $quantity = $data['quantity'][$j];
            for ($i=0; $i < $quantity ; $i++) { 
                $newOrder->dishes()->attach($data['dishes'][$count]);
            }
            $count++;
        }

        $amount = $request->total_price;
        $nonce = $request->payment_method_nonce;

        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'customer' => [
                'firstName' => 'Mario',
                'lastName' => 'Rossi',
                'email' => 'mariorossi@mail.com',
            ],
            'options' => [
                'submitForSettlement' => true
            ]
        ]);
            
        if ($result->success) {
            $transaction = $result->transaction;
            Mail::to('customer@mail.it')->send(new RestaurantMail($newOrder));
            return view('success');
        } else {
            $errorString = "";

            foreach ($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }

            return back()->withErrors('An error occurred with the message: '.$result->message);
        }
            
    }
}
