<?php

namespace App\Http\Livewire\FrontEnd;

use App\Mail\OrderCreated;
use App\Models\Order;
use App\Models\ShippingAddress;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Exception;

class Checkout extends Component
{
    protected $shippingAddress;
    public $userShippingAddressId;

    public $accountForm = [
        'email' => ''
    ];
    
    public $shippingForm = [
        'address' => '',
        'city' => '',
        'postcode' => '',
    ];

    public $paymentForm = [
        'nameOnCard' => '',
        'cardNumber' => '',
        'expiryMonth' => '',
        'expiryYear' => '',
        'cvc' => '',
    ];

    protected $validationAttributes = [
        'accountForm.email' => 'email address', 
        'shippingForm.address' => 'shipping address', 
        'shippingForm.city' => 'shipping city', 
        'shippingForm.postcode' => 'shipping post code', 
        'paymentForm.nameOnCard' => 'name on card',
        'paymentForm.cardNumber' => 'card number',
        'paymentForm.expiryMonth' => 'expiry month',
        'paymentForm.expiryYear' => 'expiry year',
        'paymentForm.cvc' => 'cvc', 
    ];
    
    protected $messages = [
        'accountForm.email.unique' => 'Seems you already have an account. Please sign in to place an order.',
        'shippingForm.address.required' => 'Your :attribute is required',
        'shippingForm.city.required' => 'Your :attribute is required',
        'shippingForm.postcode.required' => 'Your :attribute is required',
        'paymentForm.nameOnCard.required' => 'Your :attribute is required',
        'paymentForm.cardNumber.required' => 'Your :attribute is required',
        'paymentForm.expiryMonth.required' => 'Your :attribute is required',
        'paymentForm.expiryYear.required' => 'Your :attribute is required',
        'paymentForm.cvc.required' => 'Your :attribute is required',
    ];

    public function rules()
    {
        return [
            'accountForm.email' => 'required|email|max:255|unique:users,email' . (auth()->user() ? ',' . auth()->id() : ''),
            'shippingForm.address' => 'required|max:255',
            'shippingForm.city' => 'required|max:255',
            'shippingForm.postcode' => 'required|max:255',
            'paymentForm.nameOnCard' => 'required',
            'paymentForm.cardNumber' => 'required|numeric',
            'paymentForm.expiryMonth' => 'required|numeric',
            'paymentForm.expiryYear' => 'required|numeric',
            'paymentForm.cvc' => 'required|numeric',
        ];
    }

    public function mount()
    {
        if($user = auth()->user()){
            $this->accountForm['email'] = $user->email;
        }
    }

    public function updatedUserShippingAddressId($id)
    {
        if(!$id){
            return;
        }

        $this->shippingForm = $this->userShippingAddresses->find($id)
            ->only('address', 'city', 'postcode');
    }

    public function getUserShippingAddressesProperty()
    {
        return auth()->user()?->shippingAddresses;
    }

    public function checkout()
    {
        $this->validate();

        $this->shippingAddress = ShippingAddress::query();

        if(auth()->user()){
            $this->shippingAddress = $this->shippingAddress->whereBelongsTo(auth()->user());
        }

        ($this->shippingAddress = $this->shippingAddress->firstOrCreate($this->shippingForm))
            ?->user()
            ->associate(auth()->user())
            ->save();

        $order = Order::make(array_merge($this->accountForm, [
            'subtotal' => Cart::subtotal()/100
        ]));

        $order->user()->associate(auth()->user());
        $order->shippingAddress()->associate($this->shippingAddress);
        
        $order->save();

        $cart = Cart::content();
        foreach($cart as $item)
        {
            $order->attributes()->attach($item->model->id, ['quantity' => $item->qty]);

            $item->model->stocks()->create([
                'amount' => 0 - $item->qty
            ]);
        }

        $stripe = Stripe::make(env('STRIPE_SECRET'));

        try{
            $token = $stripe->tokens()->create([
                'card' => [
                    'number' => $this->paymentForm['cardNumber'],
                    'exp_month' => $this->paymentForm['expiryMonth'],
                    'exp_year' => $this->paymentForm['expiryYear'],
                    'cvc' => $this->paymentForm['cvc'],
                ]
            ]);

            if(!isset($token['id'])){
                session()->flash('stripe_error', 'The stripe token was not generated!');
            }

            $customer = $stripe->customers()->create([
                'name' => $this->paymentForm['nameOnCard'],
                'source' => $token['id'],
            ]);

            $charge = $stripe->charges()->create([
                'customer' => $customer['id'],
                'currency' => 'GBP',
                'amount' => Cart::subtotal(),
                'description' => 'Payment for order no' . $order->id
            ]);

            if($charge['status'] != 'succeeded'){
                session()->flash('stripe_error', 'Error in transaction!');
            }

        } catch(Exception $e){
            session()->flash('stripe_error', $e->getMessage());
        }

        Cart::destroy();

        Mail::to($order->email)->send(new OrderCreated($order));

        if(!auth()->user()){
            return redirect()->route('orders.confirmation', $order);
        }

        return redirect()->route('orders');
    }

    public function render()
    {
        return view('livewire.front-end.checkout', [
            'cart' => Cart::content(),
        ]);
    }
}
