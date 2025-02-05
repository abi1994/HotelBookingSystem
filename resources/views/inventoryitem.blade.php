@extends('layout')

@section('content')
    <h1>Inventory for {{ $room->title }}</h1>

    <ul>
        @foreach ($room->inventoryItems as $item)
            <li>{{ $item->item_name }} - Quantity: {{ $item->quantity }}</li>
        @endforeach
    </ul>
@endsection
