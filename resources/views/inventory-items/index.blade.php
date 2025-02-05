@extends('layout')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid mt-4">
        <!-- Inventory Items Header -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Inventory Items
                    <a href="{{ url('admin/inventory-items/create') }}" class="float-right btn btn-success btn-sm">
                        Add Inventory Item
                    </a>

                </h6>
            </div>
            <div class="card-body">
                <!-- Inventory Items Table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead >
                        <tr>
                            <th>ID</th>
                            <th>Location</th>
                            <th>Item Name</th>
                            <th>Quantity</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($inventoryItems as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->room->title }}</td>
                                <td>{{ $item->item_name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{$item->description}}</td>
                                <td>
                                    <!-- Edit Button -->
                                    <a href="{{ url('admin/inventory-items/edit', $item->id) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <a onclick="return confirm('Are you sure to delete this data?')"
                                       href="{{ url('admin/inventory/delete', $item->id) }}"
                                       class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No inventory items found.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
