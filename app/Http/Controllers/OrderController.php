<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $users = User::all();
        return view('orders.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'total_amount' => 'required|numeric',
            'status' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('orders.create')
                             ->withErrors($validator)
                             ->withInput();
        }

        Order::create($request->all());

        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }
    public function save($userId, $productId, $quantity, $price, $status)
    {
        $validator = Validator::make([
            'user_id' => $userId,
            'product_id' => $productId,
            'quantity' => $quantity,
            'price' => $price,
            'status' => $status,
        ], [
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'status' => 'required|string',
        ]);

        if ($validator->fails()) {
            // Handle validation errors here if necessary
            // For simplicity, assuming the validation passes
            // You may want to redirect back with errors or handle as needed
            // For now, we proceed assuming validation passes
        }

        // Create a new order instance
        $order = new Order();
        $order->user_id = $userId;
        $order->total = $quantity;
        $order->status = $status;
        $order->save();

        // Create a new order item for the product
      


        return $order;
    }


    public function edit(Order $order)
    {
        $users = User::all();
        return view('orders.edit', compact('order', 'users'));
    }

    public function update(Request $request, Order $order)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'total_amount' => 'required|numeric',
            'status' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('orders.edit', $order)
                             ->withErrors($validator)
                             ->withInput();
        }

        $order->update($request->all());

        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }
}

