<?php

namespace App\Http\Controllers;

use App\Mail\OrderInvoiceMail;
use App\Mail\RegisterMail;
use App\Models\ColorModel;
use App\Models\DiscountCodeModel;
use App\Models\OrderItemModel;
use App\Models\OrderModel;
use App\Models\ProductModel;
use App\Models\ProductSizeModel;

use App\Models\ShippingChargeModel;
use App\Models\User;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Session;
use Stripe\Stripe;


class PaymentController extends Controller
{

    public function cart(Request $request)
    {
        $data['meta-title'] = 'Cart';
        $data['meta-description'] = '';
        $data['meta-keywords'] = '';
        return view('payment.cart', $data);

    }
    public function checkout(Request $request)
    {
        $data['meta-title'] = 'checkout';
        $data['meta-description'] = '';
        $data['meta-keywords'] = '';
        $data['getShipping'] = ShippingChargeModel::getRecordActive();
        return view('payment.checkout', $data);

    }
    public function add_to_cart(Request $request)
    {
        $getProduct = ProductModel::getSingle($request->product_id);

        $total = $getProduct->price;

        if (!empty($request->size_id)) {
            $size_id = $request->size_id;
            $getSize = ProductSizeModel::getSingle($size_id);

            $size_price = !empty($getSize->size_id) ? $getSize->size_id : 0;
            $total = $total + $size_price;
        } else {
            $size_id = 0;
        }

        $color_id = !empty($request->color_id) ? $request->color_id : 0;

        Cart::add([
            'id' => $getProduct->id,
            'name' => 'Product',
            'price' => $total,
            'quantity' => $request->qty,
            'attributes' => array('size_id' => $size_id, 'color_id' => $color_id),
        ]);

        return redirect()->back();


    }
    public function update_cart(Request $request)
    {

        foreach ($request->cart as $cart) {
            Cart::update($cart['id'], array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $cart['qty']
                ),
            ));
        }

        return redirect()->back();

    }
    public function apply_discount_code(Request $request)
    {

        $getDiscount = DiscountCodeModel::CheckDiscount($request->discount_code);
        if (!empty($getDiscount)) {

            $total = Cart::getSubTotal();
            if ($getDiscount->type == 'Amount') {
                $discount_amount = $getDiscount->percent_amount;
                $payable_total = $total - $getDiscount->percent_amount;

            } else {
                $discount_amount = ($total * $getDiscount->percent_amount) / 100;
                $payable_total = $total - $discount_amount;
            }

            $json['status'] = true;
            $json['discount_amount'] = number_format($discount_amount, 2);
            $json['payable_total'] = $payable_total;
            $json['message'] = 'success';

        } else {
            $json['status'] = false;
            $json['discount_amount'] = '0.00';
            $json['payable_total'] = Cart::getSubTotal();
            $json['message'] = 'Discount Code Invalid';
        }
        echo json_encode($json);

    }
    public function place_order(Request $request)
    {
        $validate = 0;
        $message = '';
        if (!empty(Auth::check())) {
            $user_id = Auth::user()->id;
        } else {
            if (!empty($request->is_create)) {
                $checkEmail = User::checkEmail($request->email);
                if (!empty($checkEmail)) {
                    $message = 'Your account exist please try another';
                    $validate = 1;
                } else {
                    $save = new User();
                    $save->name = trim($request->first_name);
                    $save->email = trim($request->email);
                    $save->password = Hash::make($request->password);
                    $save->save();
                    $user_id = $save->id;
                }
            } else {

                $user_id = '';
            }
        }


        if (empty($validate)) {

            $getShipping = ShippingChargeModel::getSingle($request->shipping);
            $payable_total = Cart::getSubTotal();
            $discount_amount = 0;
            $discount_code = '';
            if (!empty($request->discount_code)) {
                $getDiscount = DiscountCodeModel::CheckDiscount($request->discount_code);
                if (!empty($getDiscount)) {
                    $discount_code = $request->discount_code;
                    if ($getDiscount->type == 'Amount') {
                        $discount_amount = $getDiscount->percent_amount;
                        $payable_total = $payable_total - $getDiscount->percent_amount;

                    } else {
                        $discount_amount = ($payable_total * $getDiscount->percent_amount) / 100;
                        $payable_total = $payable_total - $discount_amount;
                    }
                }
            }
            $shipping_amount = !empty($getShipping->price) ? $getShipping->price : 0;
            $total_amount = $payable_total + $shipping_amount;

            $order = new OrderModel;
            if (!empty($user_id)) {
                $order->user_id = trim($user_id);
            }
            $order->order_number = mt_rand(10000000, 999999999);
            $order->first_name = trim($request->first_name);
            $order->last_name = trim($request->last_name);
            $order->company_name = trim($request->company_name);
            $order->country = trim($request->country);
            $order->address_one = trim($request->address_one);
            $order->address_two = trim($request->address_two);
            $order->city = trim($request->city);
            $order->state = trim($request->state);
            $order->postcode = trim($request->postcode);
            $order->phone = trim($request->phone);
            $order->email = trim($request->email);
            $order->note = trim($request->notes);
            $order->shipping_id = trim($request->shipping);
            $order->discount_code = trim($discount_code);
            $order->discount_amount = trim($discount_amount);
            $order->total_amount = trim($total_amount);
            $order->shipping_amount = trim($shipping_amount);
            $order->payment_method = trim($request->payment_method);
            $order->save();

            foreach (Cart::getContent() as $key => $cart) {
                $orderItem = new OrderItemModel;
                $orderItem->order_id = $order->id;
                $orderItem->product_id = $cart->id;
                $orderItem->quantity = $cart->quantity;
                $orderItem->price = $cart->price;
                $color_id = $cart->attributes->color_id;
                if (!empty($color_id)) {
                    $getColor = ColorModel::getSingle($color_id);
                    $orderItem->color_name = $getColor->name;
                }
                $size_id = $cart->attributes->size_id;
                if (!empty($size_id)) {
                    $getSize = ProductSizeModel::getSingle($size_id);
                    $orderItem->size_name = $getSize->name;
                    $orderItem->size_amount = $getSize->price;
                }
                $orderItem->total_price = $cart->price * $cart->quantity;
                $orderItem->save();
            }
            $json['status'] = true;
            $json['message'] = 'order success';
            $json['redirect'] = url('checkout/payment?order_id=' . base64_encode($order->id));
        } else {
            $json['status'] = false;
            $json['message'] = $message;
        }
        echo json_encode($json);




    }
    public function checkout_payment(Request $request)
    {
        if (!empty(Cart::getSubTotal()) && !empty($request->order_id)) {
            $order_id = base64_decode($request->order_id);
            $getOrder = OrderModel::getSingle($order_id);
            if (!empty($getOrder)) {
                if ($getOrder->payment_method == 'cash') {
                    $getOrder->is_payment = 1;
                    $getOrder->save();
                    Cart::clear();
                    return redirect('cart')->with('success', 'Order Placed');
                } else if ($getOrder->payment_method == 'stripe') {
                    Stripe::setApiKey(env('STRIPE_SECRET'));
                    $finalprice = $getOrder->total_amount * 100;
                    $session = \Stripe\Checkout\Session::create([
                        'customer_email' => $getOrder->email,
                        'payment_method_types' => ['card'],
                        'line_items' => [
                            [
                                'price_data' => [
                                    'currency' => 'usd',
                                    'product_data' => [
                                        'name' => 'E-Commerce',
                                    ],
                                    'unit_amount' => intval($finalprice),
                                ],
                                'quantity' => 1,
                            ]
                        ],
                        'mode' => 'payment',
                        'success_url' => url('stripe/payment-success'),
                        'cancel_url' => url('checkout'),
                    ]);

                    $getOrder->stripe_session_id = $session['id'];
                    $getOrder->save();

                    $data['session_id'] = $session['id'];
                    Session::put('stripe_session_id', $session['id']);
                    $data['setPublicKey'] = env('STRIPE_KEY');

                    return view('payment.stripe_charge', $data);
                }
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }

    public function stripe_payment_success(Request $request)
    {
        $trans_id = Session::get('stripe_session_id');
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $getdata = \Stripe\Checkout\Session::retrieve($trans_id);
        $getOrder = OrderModel::where('stripe_session_id', '=', $getdata->id)->first();

        if (!empty($getOrder) && !empty($getdata->id) && $getdata->id == $getOrder->stripe_session_id) {
            $getOrder->is_payment = 1;
            $getOrder->transaction_id = $getdata->id;
            $getOrder->payment_data = json_encode($getdata);
            $getOrder->save();
            Mail::to($getOrder->email)->send(new OrderInvoiceMail($getOrder));
            Cart::clear();
            return redirect('cart')->with('success', 'order successfully placed');
        } else {
            return redirect('cart')->with('error', 'Due to some error please try again');
        }
    }
}
