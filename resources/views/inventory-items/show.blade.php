@extends('layout')

@section('content')
    <h1>Inventory Item Details</h1>

    <p><strong>Room:</strong> {{ $inventoryItem->room->title }}</p>
    <p><strong>Item Name:</strong> {{ $inventoryItem->item_name }}</p>
    <p><strong>Quantity:</strong> {{ $inventoryItem->quantity }}</p>

    <a href="{{ url('admin/inventory-items.index') }}" class="btn btn-secondary">Back</a>
@endsection
