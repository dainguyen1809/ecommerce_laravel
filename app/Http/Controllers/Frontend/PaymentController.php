<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CodSetting;
use App\Models\GeneralSetting;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\PaypalSetting;
use App\Models\Product;
use App\Models\Transaction;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaymentController extends Controller
{
    public function index()
    {
        if (! session()->has('address')) {
            return redirect()->route('user.checkout');
        }
        return view('frontend.pages.payment');
    }

    public function paymentSuccess()
    {
        return view('frontend.pages.payment-success');
    }

    public function storeOrder($paymentMethod, $paymentStatus, $transactionId, $paidAmount, $paidCurrencyName)
    {
        $setting = GeneralSetting::first();
        $order = new Order();
        $order->invoice_id = rand(1, 9999);
        $order->user_id = Auth::user()->id;
        $order->sub_total = getCartTotalAmount();
        $order->amount = totalAmount();
        $order->currency_name = $setting->currency_name;
        $order->currency_icon = $setting->currency_icon;
        $order->product_qty = Cart::content()->count();
        $order->payment_method = $paymentMethod;
        $order->payment_status = $paymentStatus;
        $order->order_address = json_encode(session()->get('address'));
        $order->shipping_method = json_encode(session()->get('shipping_method'));
        $order->coupon = json_encode(session()->get('coupon'));
        $order->order_status = 'pending';
        $order->save();


        // order_products
        foreach (Cart::content() as $item) {
            $product = Product::find($item->id);
            $orderProduct = new OrderProduct();
            $orderProduct->order_id = $order->id;
            $orderProduct->product_id = $product->id;
            $orderProduct->vendor_id = $product->vendor_id;
            $orderProduct->product_name = $product->name;
            $orderProduct->variants = json_encode($item->options->variants);
            $orderProduct->variant_total = $item->options->variants_total;
            $orderProduct->unit_price = $item->price;
            $orderProduct->quantity = $item->qty;
            $orderProduct->save();

            // update product
            $updatedQty = ($product->quantity - $item->qty);
            $product->quantity = $updatedQty;
            $product->save();
        }

        $transaction = new Transaction();
        $transaction->order_id = $order->id;
        $transaction->transaction_id = $transactionId;
        $transaction->payment_method = $paymentMethod;
        $transaction->amount = totalAmount();
        $transaction->amount_real_currency = $paidAmount;
        $transaction->amount_real_currency_name = $paidCurrencyName;
        $transaction->save();
    }


    public function clearSession()
    {
        Cart::destroy();
        session()->forget([
            'address',
            'shipping_method',
            'coupon',
        ]);
    }


    public function paypalConfig()
    {
        $paypalSetting = PaypalSetting::first();
        $config = [
            'mode' => $paypalSetting->mode === 1 ? 'live' : 'sandbox',
            'sandbox' => [
                'client_id' => $paypalSetting->client_id,
                'client_secret' => $paypalSetting->secret_key,
                'app_id' => 'APP-80W284485P519543T',
            ],
            'live' => [
                'client_id' => $paypalSetting->client_id,
                'client_secret' => $paypalSetting->secret_key,
                'app_id' => '',
            ],

            'payment_action' => 'Sale',
            'currency' => $paypalSetting->currency_name,
            'notify_url' => '',
            'locale' => 'en-US',
            'validate_ssl' => true,
        ];
        return $config;
    }

    public function payWithPaypal()
    {
        $config = $this->paypalConfig();
        $paypalSetting = PaypalSetting::first();

        $provider = new PayPalClient($config);
        $provider->getAccessToken();

        $total = round(totalAmount() * $paypalSetting->currency_rate, 2);

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('user.paypal.success'),
                "cancel_url" => route('user.paypal.cancel'),
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => $config['currency'],
                        "value" => $total,
                    ]
                ],
            ],
        ]);

        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    return redirect()->away($link['href']);
                }
            }
        } else {
            return redirect()->route('user.paypal.cancel');
        }
    }

    public function paypalSuccess(Request $request)
    {
        $config = $this->paypalConfig();
        $provider = new PayPalClient($config);
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->token);

        if (isset($response['status']) && $response['status'] === 'COMPLETED') {
            $paypalSetting = PaypalSetting::first();
            $paidAmount = round(totalAmount() * $paypalSetting->currency_rate, 2);
            $this->storeOrder('paypal', 1, $response['id'], $paidAmount, $paypalSetting->currency_name);
            $this->clearSession();
            return redirect()->route('user.payment-success');
        }

        return redirect()->route('user.paypal.cancel');
    }

    public function paypalCancel()
    {
        toastr('Something wrong. Please try again later', 'error', 'Error');
        return redirect()->route('user.payment');
    }

    public function payWithCod(Request $request)
    {
        $codSetting = CodSetting::first();
        $setting = GeneralSetting::first();
        if ($codSetting->status === 0) {
            return redirect()->back();
        }

        // amount calculation
        $total = round(totalAmount(), 2);
        $this->storeOrder('COD', 0, str()->random(32), $total, $setting->currency_name);
        $this->clearSession();

        return redirect()->route('user.payment-success');
    }
}
