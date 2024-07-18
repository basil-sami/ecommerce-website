<!-- resources/views/order-items/edit.blade.php -->
@extends('layouts.app')

@section('content')
<h1>Edit Order Item</h1>
<form action="{{ route('order-items.update', $orderItem->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="order_id">Order:</label>
        <select name="order_id" id="order_id" class="form-control" required>
            @foreach($orders as $order)
            <option value="{{ $order->id }}" {{ $orderItem->order_id == $order->id ? 'selected' : '' }}>
                {{ $order->id }}
            </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="product_id">Product:</label>
        <select name="product_id" id="product_id" class="form-control" required>
            @foreach($products as $product)
            <option value="{{ $product->id }}" {{ $orderItem->product_id == $product->id ? 'selected' : '' }}>
                {{ $product->name }}
            </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" id="quantity" class="form-control" value="{{ $orderItem->quantity }}" required>
    </div>
    <div class="form-group">
        <label for="price">Price:</label>
        <input type="number" name="price" id="price" class="form-control" step="0.01" value="{{ $orderItem->price }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Update Order Item</button>
</form>
@endsection
