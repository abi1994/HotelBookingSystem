@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>FAQs</h1>
        @foreach($faqs as $faq)
            <div class="faq">
                <h3>{{ $faq->question }}</h3>
                <p>{{ $faq->answer }}</p>
            </div>
        @endforeach

        @auth
            <form action="{{ url('/faq') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="question">Question:</label>
                    <input type="text" name="question" id="question" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="answer">Answer:</label>
                    <textarea name="answer" id="answer" class="form-control" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Add FAQ</button>
            </form>
        @endauth
    </div>
@endsection
