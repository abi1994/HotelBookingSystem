<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Home Page</title>
	<link href="{{asset('/bs5/bootstrap.min.css')}}" rel="stylesheet">

      <!-- Custom fonts for this template-->
      <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/css/sb-admin-2.min.css" rel="stylesheet">

	<script type="text/javascript" src="{{asset('/vendor/jquery/jquery.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('/bs5/bootstrap.bundle.min.js')}}"></script>
  {{-- <script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script> --}}
    <!-- Other head elements -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="{{url('/')}}">Hotel Booking</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    

      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ms-auto">
        <a class="nav-link" aria-current="page" href="/#services">Services</a>
	        <a class="nav-link" href="/#gallery">Gallery</a>
	        @if(Session::has('customerlogin'))
	        <a class="nav-link" href="{{url('logout')}}">Logout</a>
	        <a class="nav-link btn btn-sm btn-danger" href="{{url('booking')}}">Booking</a>
                <a class="nav-link" href="{{url('profile')}}">Profile</a>
                <a class="nav-link" href="{{url('contact-us')}}">Contact Us</a>
	        @else
	        <a class="nav-link" href="{{url('login')}}">Login</a>
	        <a class="nav-link" href="{{url('register')}}">Register</a>
	        <a class="nav-link btn btn-sm btn-danger" href="{{url('register')}}">Booking</a>
                <a class="nav-link" href="{{url('contact-us')}}">Contact Us</a>

            @endif
        </div>
      </div>
    </div>
  </nav>
  <main>
    @yield('content')
  </main>
  <!-- Initialize BotMan Widget -->
  <script>
  var botmanWidget = {
    frameEndpoint: "{{url('/botman/chat')}}", // Endpoint for BotMan chat
    chatServer: "{{url('/botman')}}", // BotMan server endpoint
    title: 'Chatbot', // Title for the chatbot window
    mainColor: '#0084ff', // Color theme for the chatbot
    bubbleBackground: '#0084ff', // Chat bubble background color
    aboutText: '', // Information about the chatbot
    introMessage: 'Hi! How can I help you today?', // Initial message in the chat window
    placeholderText: 'Type a message...', // Placeholder text in the input field
    desktopHeight: 450, // Height of the chatbot window on desktop
    mobileHeight: '100%', // Height of the chatbot window on mobile devices
  };
</script>
<script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>

</body>
</html>

