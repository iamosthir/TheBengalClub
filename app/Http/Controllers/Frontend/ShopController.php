<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentMethod;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::active()->latest()->get();
        return view('frontend.pages.shop', compact('products'));
    }

    public function orderForm(Product $product)
    {
        if (! $product->is_active) {
            abort(404);
        }

        $paymentMethods = PaymentMethod::where('status', 'active')->get();
        $user           = Auth::guard('web')->user();

        return view('frontend.pages.order-form', compact('product', 'paymentMethods', 'user'));
    }

    public function placeOrder(Request $request, Product $product)
    {
        if (! $product->is_active) {
            abort(404);
        }

        $data = $request->validate([
            'full_name'        => 'required|string|max:255',
            'email'            => 'required|email|max:255',
            'phone'            => 'required|string|max:30',
            'billing_address'  => 'required|string|max:1000',
            'shipping_address' => 'required|string|max:1000',
            'payment_method_id'=> 'required|exists:payment_methods,id',
            'transaction_id'   => 'required|string|max:255',
            'payment_proof'    => 'nullable|image|max:5120',
        ]);

        $proofPath = null;
        if ($request->hasFile('payment_proof')) {
            $proofPath = $request->file('payment_proof')->store('order-proofs', 'public');
        }

        $subtotal       = $product->price;
        $deliveryCharge = $product->delivery_charge;
        $total          = $subtotal + $deliveryCharge;

        $order = Order::create([
            'user_id'           => Auth::guard('web')->id(),
            'full_name'         => $data['full_name'],
            'email'             => $data['email'],
            'phone'             => $data['phone'],
            'billing_address'   => $data['billing_address'],
            'shipping_address'  => $data['shipping_address'],
            'payment_method_id' => $data['payment_method_id'],
            'transaction_id'    => $data['transaction_id'],
            'payment_proof_path'=> $proofPath,
            'subtotal'          => $subtotal,
            'delivery_charge'   => $deliveryCharge,
            'total_amount'      => $total,
            'status'            => 'pending',
        ]);

        OrderItem::create([
            'order_id'   => $order->id,
            'product_id' => $product->id,
            'quantity'   => 1,
            'unit_price' => $product->price,
        ]);

        return redirect()->route('shop.order.success', $order->id);
    }

    public function orderSuccess(Order $order)
    {
        return view('frontend.pages.order-success', compact('order'));
    }

    public function myOrders()
    {
        $orders = Order::with(['items.product', 'paymentMethod'])
            ->where('user_id', Auth::guard('web')->id())
            ->latest()
            ->paginate(10);

        return view('frontend.pages.member-orders', compact('orders'));
    }
}
