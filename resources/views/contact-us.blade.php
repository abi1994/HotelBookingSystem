@extends('frontlayout')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <h2>Find us here.</h2>
                <div class="mb-4">
                    <p><strong><i class="fas fa-map-marker-alt"></i> Address:</strong></p>
                    <p><strong>Head office</strong></p>
                    <p>Kasthuriyar Rd, Jaffna, Sri Lanka.</p>
                </div>
                <div class="mb-4">
                    <p><strong><i class="fas fa-envelope"></i> Email:</strong></p>
                    <p>example@gmail.com</p>
                </div>
                <div class="mb-4">
                    <p><strong><i class="fas fa-phone"></i> Phone Number:</strong></p>
                    <p>+94 77 123 4567</p>
                </div>
            </div>
            <div class="col-md-6">
                <h2>Contact Us.</h2>
                <form action="{{ url('/contact-us') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter your name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
                    </div>

                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea name="message" id="message" class="form-control" placeholder="Enter your message" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>

{{--                @foreach($contacts as $contact)--}}
{{--                    <div class="contact mt-4">--}}
{{--                        <h3>{{ $contact->name }}</h3>--}}
{{--                        <p>{{ $contact->email }}</p>--}}
{{--                        <p>{{ $contact->message }}</p>--}}
{{--                        <p>Status: {{ $contact->status }}</p>--}}

{{--                        @foreach($contact->responses as $response)--}}
{{--                            <div class="response">--}}
{{--                                <p>{{ $response->response }}</p>--}}
{{--                                <p>By: {{ $response->user->name }}</p>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}

{{--                        @if($contact->status == 'open')--}}
{{--                            <form action="{{ url('/respond-contact/' . $contact->id) }}" method="POST">--}}
{{--                                @csrf--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="response">Response:</label>--}}
{{--                                    <textarea name="response" id="response" class="form-control" required></textarea>--}}
{{--                                </div>--}}
{{--                                <button type="submit" class="btn btn-primary">Submit Response</button>--}}
{{--                            </form>--}}

{{--                            <form action="{{ url('/close-contact/' . $contact->id) }}" method="POST">--}}
{{--                                @csrf--}}
{{--                                <button type="submit" class="btn btn-danger mt-2">Close Message</button>--}}
{{--                            </form>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                @endforeach--}}
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        .container {
            margin-top: 50px;
        }

        h2 {
            font-weight: 700;
            margin-bottom: 20px;
        }

        .mb-4 {
            margin-bottom: 1.5rem !important;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            font-weight: 500;
            display: block;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc; /* Border color for inputs and textareas */
            border-radius: 5px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #007bff; /* Updated border color on focus */
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
            outline: none;
        }

        .form-group input::placeholder,
        .form-group textarea::placeholder {
            color: #bbb;
        }

        .text-danger {
            color: #dc3545 !important;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s, border-color 0.3s;
            font-weight: 500;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .contact {
            border: 1px solid #ccc; /* Border for each contact section */
            border-radius: 5px;
            padding: 20px;
            margin-top: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .response {
            background-color: #f9f9f9;
            border-left: 4px solid #007bff;
            padding: 10px;
            margin-top: 10px;
            border-radius: 3px;
        }
    </style>
@endsection
