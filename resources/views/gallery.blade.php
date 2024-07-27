@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Gallery Section Start -->
        <div class="container my-4">
            <h1 class="text-center border-bottom" id="gallery">Gallery</h1>
            <div class="row my-4">
                @foreach($roomTypes as $roomType)
                    <div class="col-md-3">
                        <div class="card">
                            <h5 class="card-header">{{$roomType->name}}</h5>
                            <div class="card-body">
                                @foreach($roomType->images as $img)
                                    <a href="#" data-toggle="modal" data-target="#imageModal{{$img->id}}">
                                        <img style="width: 200px; height: 150px;" src="{{Storage::url($img->filename)}}" alt="Image for {{ $roomType->name }}">
                                    </a>

                                    <!-- Modal -->
                                    <div class="modal fade" id="imageModal{{$img->id}}" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel{{$img->id}}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="imageModalLabel{{$img->id}}">Image for {{$roomType->name}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <img src="{{Storage::url($img->filename)}}" style="max-width: 100%; max-height: 400px;" alt="Image for {{ $roomType->name }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
@endsection
