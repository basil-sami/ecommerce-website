<!-- resources/views/order-items/index.blade.php -->
@extends('layouts.app')

@section('content')
<h1>Order Items List</h1>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Order ID</th>
            <th>Product ID</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orderItems as $orderItem)
        <tr>
            <td>{{ $orderItem->id }}</td>
            <td>{{ $orderItem->order_id }}</td>
            <td>{{ $orderItem->product_id }}</td>
            <td>{{ $orderItem->quantity }}</td>
            <td>{{ $orderItem->price }}</td>
            <td>
                <a href="{{ route('order-items.show', $orderItem->id) }}" class="btn btn-info">View</a>
                <a href="{{ route('order-items.edit', $orderItem->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('order-items.destroy', $orderItem->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
