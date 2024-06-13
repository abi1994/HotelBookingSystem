@extends('frontlayout')
@section('content')
	<!-- Slider Section Start -->
	<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
	  <div class="carousel-inner">

	  	@foreach($banners as $index => $banner)
	    <div class="carousel-item @if($index==0) active @endif">
	      <img src="{{Storage::url($banner?->image?->filename)}}" class="d-block w-100" alt="{{$banner->alt_text}}">
	    </div>
	    @endforeach
	  </div>
	<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
	<span class="carousel-control-prev-icon" aria-hidden="true"></span>
	<span class="visually-hidden">Previous</span>
	</button>
	<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
	<span class="carousel-control-next-icon" aria-hidden="true"></span>
	<span class="visually-hidden">Next</span>
	</button>
	</div>

	<!-- Slider Section End -->
	<div class="container my-4">
		<h1 class="text-center border-bottom" id="services">Services</h1>
		@foreach($services as $service)
    
		<div class="row my-4">
			<div class="col-md-3">
				<a href="{{url('service/'.$service->id)}}"><img class="img-thumbnail" style="width:100%;" src="{{Storage::url($service?->image?->filename)}}" /></a>
			</div>
			<div class="col-md-8">
				<h3>{{$service->title}}</h3>
				<p>{{$service->small_desc}}</p>
				<p>
					<a href="{{url('service/'.$service->id)}}" class="btn btn-primary">Read More</a>
				</p>
			</div>
		</div>
		@endforeach
	</div>
	<!-- Service Section End -->
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
                <img 
                style="width: 200px; height: 150px;" 
                src="{{Storage::url($img->filename)}}"  alt="Image for {{ $roomType->name }}"  />


				      @endforeach
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>


	<!-- Gallery Section End -->
     <!-- Modal -->
    <div>

 <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Fancy Popup Modal</title>
        <style>
/* Button styles */
        .button {
        background-color: #008CBA; /* Blue background */
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 8px; /* Rounded corners */
        }

/* Popup container */
        .popup {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 9999; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

/* Popup content */
        .popup-content {
        background-color: #fefefe;
        margin: 5% auto; /* 5% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 80%; /* Could be more or less, depending on screen size */
        border-radius: 10px; /* Rounded corners */
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2); /* Box shadow */
        }

/* Close button */
        .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        }

        .close:hover,
        .close:focus
        {
        color: black;
        text-decoration: none;
        cursor: pointer;
        }
</style>
</head>



<body>

<!-- Button to trigger the popup -->
<div class="card-header text-white d-flex justify-content-center align-items-center">
<button onclick="openPopup()" class="btn btn-primary">Open Popup</button>
</div>
<!-- Popup container -->
<div id="popup" class="popup">
  <!-- Popup content -->
  <div class="popup-content">
    <!-- Close button -->
    <span class="close" onclick="closePopup()">&times;</span>
    <!-- Content inside the popup -->
	  <div class="card-header bg-primary text-white d-flex justify-content-center align-items-center">
		  <div class="text-center">
			  <h4>{{ __('Tickets') }}</h4>
			  <div class="profile-image-wrapper mt-2 mb-2">

			  </div>
		  </div>

	  </div>
	  <form action="{{ url('/create-ticket') }}" method="POST">
		  @csrf
		  <div class="form-group">
			  <label for="subject">Subject:</label>
			  <input type="text" name="subject" id="subject" class="form-control" required>
		  </div>
		  <div class="form-group">
			  <label for="description">Description:</label>
			  <textarea name="description" id="description" class="form-control" required></textarea>
		  </div>
		  <button type="submit" class="btn btn-primary">Create Ticket</button>

	  </form>

  </div>
</div>

<script>
// Function to open the popup
function openPopup() {
  document.getElementById("popup").style.display = "block";
}

// Function to close the popup
function closePopup() {
  document.getElementById("popup").style.display = "none";
}

// Close the popup if the user clicks outside of it
window.onclick = function(event) {
  if (event.target == document.getElementById("popup")) {
    closePopup();
  }
}
</script>
    </div>
  </div>

    </div>
<!-- LightBox css -->
<link rel="stylesheet" type="text/css" href="{{asset('/vendor')}}/lightbox2-2.11.3/dist/css/lightbox.min.css" />
<!-- LightBox Js -->
<script type="text/javascript" src="{{asset('/vendor')}}/lightbox2-2.11.3/dist/js/lightbox.min.js"></script>
<style type="text/css">
	.hide{
		display: none;
	}
</style>
@endsection
</body>
</html>
