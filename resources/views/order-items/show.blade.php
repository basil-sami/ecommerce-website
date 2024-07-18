<!-- resources/views/order-items/show.blade.php -->
@extends('layouts.app')

@section('content')
<h1>Order Item Details</h1>
<p><strong>ID:</strong> {{ $orderItem->id }}</p>
<p><strong>Order ID:</strong> {{ $orderItem->order_id }}</p>
<p><strong>Product ID:</strong> {{ $orderItem->product_id }}</p>
<p><strong>Quantity:</strong> {{ $orderItem->quantity }}</p>
<p><strong>Price:</strong> {{ $orderItem->price }}</p>
<a href="{{ route('order-items.edit', $orderItem->id) }}" class="btn btn-warning">Edit</a>
<a href="{{ route('order-items.index') }}" class="btn btn-secondary">Back to List</a>
@endsection
