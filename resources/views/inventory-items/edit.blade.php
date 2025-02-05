@extends('layout')

@section('content')
    <div class="container mt-4">
        <div class="card shadow">
            <div class="card-header">
                <h5>Edit Inventory Item</h5>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/inventory-items/update', $item->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="item_name">Item Name</label>
                        <input type="text" name="item_name" id="item_name" class="form-control" value="{{ $item->item_name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" value="{{ $item->quantity }}" required>
                    </div>
                    <div class="form-group">
                        <label for="room_id">Room</label>
                        <select name="room_id" id="room_id" class="form-control" required>
                            <option value="" disabled>Select Room</option>
                            @foreach ($rooms as $room)
                                <option value="{{ $room->id }}" {{ $item->room_id == $room->id ? 'selected' : '' }}>
                                    {{ $room->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control">{{ $item->description }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Update Item</button>
                    <a href="{{ url('admin/inventory-items') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
