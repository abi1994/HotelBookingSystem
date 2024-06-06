@extends('frontlayout')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white d-flex justify-content-center align-items-center">
                        <div class="text-center">
                            <h4>{{ __('Profile') }}</h4>
                            <div class="profile-image-wrapper mt-2 mb-2">

                            </div>
                        </div>

                    </div>
                    <div class="profile-image-wrapper text-center mt-4 mb-4">
                        <div class="profile-image-container mb-3">
                            @if(Auth::user()->photo)
                                <img src="{{ Storage::url('profile_images/' . Auth::user()->photo) }}" alt="Profile Image" class="rounded-circle border border-primary" width="150" height="150">
                            @else
                                <img src="{{ asset('images/default-profile.png') }}" alt="Default Profile Image" class="rounded-circle border border-secondary" width="150" height="150">
                            @endif
                        </div>
                        <form method="POST" action="{{ url('/profile') }}" enctype="multipart/form-data" id="profile-image-form" class="d-inline-block">
                            @csrf
                            <div class="form-group">
                                <label for="profile_image" class="btn btn-primary">
                                    Change Profile Image
                                    <input id="profile_image" type="file" class="d-none" name="profile_image" onchange="document.getElementById('profile-image-form').submit();">
                                </label>
                            </div>
                        </form>
                    </div>

                    <div class="card-body text-center">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ url('/profile') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3 justify-content-center">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control-plaintext" value="{{ Auth::user()->name }}" >
                                </div>
                            </div>

                            <div class="row mb-3 justify-content-center">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control-plaintext" value="{{ Auth::user()->email }}" >
                                </div>
                            </div>
                            <div class="row mb-3 justify-content-center">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Address') }}</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control-plaintext" value="{{ Auth::user()->address }}" >
                                </div>
                            </div>
                            <div class="row mb-3 justify-content-center">
                                <label for="created_at" class="col-md-4 col-form-label text-md-end">{{ __('Member Since') }}</label>
                                <div class="col-md-6">
                                    <input id="created_at" type="text" class="form-control-plaintext" value="{{ Auth::user()->created_at->format('M d, Y') }}" >
                                </div>
                            </div>

                            <div class="row mb-3 justify-content-center">
                                <label for="updated_at" class="col-md-4 col-form-label text-md-end">{{ __('Last Updated') }}</label>
                                <div class="col-md-6">
                                    <input id="updated_at" type="text" class="form-control-plaintext" value="{{ Auth::user()->updated_at->format('M d, Y') }}" >
                                </div>
                            </div>

                            <div class="row mb-3 justify-content-center">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary">{{ __('Update Profile') }}</button>
                                </div>
                            </div>
                        </form>


                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-header bg-primary text-white">
                        <h6 class="m-0">{{ __('My Bookings') }}</h6>
                    </div>
                    <div class="card-body">
                        @if ($bookings->isEmpty())
                            <p class="text-center">{{ __('No bookings found.') }}</p>
                        @else
                            <div class="table-responsive">
                                <table class="table table-bordered">

                                    <tr>
                                        <th>Room No.</th>
                                        <th>Room Type</th>
                                        <th>CheckIn Date</th>
                                        <th>CheckOut Date</th>
                                    </tr>
                                    <tbody>
                                    @foreach($bookings as $booking)
                                        <tr>
                                            <td>{{ $booking->room->title }}</td>
                                            <td>{{ $booking->room->roomType?->name }}</td>
                                            <td>{{ $booking->check_in_date }}</td>
                                            <td>{{ $booking->check_out_date }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
