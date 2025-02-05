@extends('layout')

@section('content')
    <div class="container mt-4">
        <div class="card shadow">
            <div class="card-header">
                <h5>Add New Inventory Item</h5>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/inventory-items/store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="item_name">Item Name</label>
                        <input type="text" name="item_name" id="item_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="room_id">Room</label>
                        <select name="room_id" id="room_id" class="form-control" required>
                            <option value="" disabled selected>Select Room</option>
                            @foreach ($rooms as $room)
                                <option value="{{ $room->id }}">{{ $room->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Item</button>
                    <a href="{{ url('admin/inventory-items') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
