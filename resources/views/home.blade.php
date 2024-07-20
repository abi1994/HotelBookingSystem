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
								<a href="#" data-toggle="modal" data-target="#imageModal{{$img->id}}">
									<img style="width: 200px; height: 150px;" src="{{Storage::url($img->filename)}}" alt="Image for {{ $roomType->name }}">
								</a>


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
			.popup {
				display: none;
				position: fixed;
				z-index: 1;
				left: 0;
				top: 0;
				width: 100%;
				height: 100%;
				overflow: auto;
				background-color: rgb(0,0,0);
				background-color: rgba(0,0,0,0.4);
				padding-top: 60px;
			}

			.popup-content {
				background-color: #fefefe;
				margin: 5% auto;
				padding: 20px;
				border: 1px solid #888;
				width: 80%;
			}

			.close {
				color: #aaa;
				float: right;
				font-size: 28px;
				font-weight: bold;
			}

			.close:hover,
			.close:focus {
				color: black;
				text-decoration: none;
				cursor: pointer;
			}
		</style>

		</head>



<body>

<!-- Button to trigger the popup -->
<div class="card-header text-white d-flex justify-content-center align-items-center icon-search">
	<button onclick="openPopup()" class="btn btn-primary" >
		<i class="fa-sharp-duotone fa-solid fa-magnifying-glass" style="--fa-primary-color: #4676c8; --fa-secondary-color: #4676c8;"></i>
		Search
	</button>

</div>



<!-- Popup Modal -->
<div id="popup" class="popup">
	<div class="popup-content">
		<span class="close" onclick="closePopup()">&times;</span>
		<h2>Search Room</h2>
		<form id="searchForm">
			<div class="form-group">
{{--				<label for="searchQuery">Search by Room Type or Description:</label>--}}
				<input type="text" id="searchQuery" class="form-control" placeholder="Enter Room Type or Description" required>
			</div>
			<button type="submit" class="btn btn-primary ">Search</button>
		</form>
		<div id="searchResults"></div>
	</div>
</div>

<script>
	function openPopup() {
		document.getElementById("popup").style.display = "block";
	}

	function closePopup() {
		document.getElementById("popup").style.display = "none";
	}

	document.getElementById("searchForm").addEventListener("submit", function(event) {
		event.preventDefault();
		const query = document.getElementById("searchQuery").value;
		searchRooms(query);
	});

	function searchRooms(query) {
		// Placeholder for search functionality
		// Implement your search logic here, for example, make an AJAX request to your server

		// Example search result
		const results = [
			{ number: '101', description: 'Single room with sea view' },
			{ number: '102', description: 'Double room with garden view' }
		];

		// Filter results based on query
		const filteredResults = results.filter(room =>
				room.number.includes(query) || room.description.toLowerCase().includes(query.toLowerCase())
		);

		// Display results
		const resultsContainer = document.getElementById("searchResults");
		resultsContainer.innerHTML = '';
		if (filteredResults.length > 0) {
			filteredResults.forEach(room => {
				const roomElement = document.createElement('div');
				roomElement.innerHTML = `<strong>Room Number:</strong> ${room.number}<br><strong>Description:</strong> ${room.description}`;
				resultsContainer.appendChild(roomElement);
			});
		} else {
			resultsContainer.innerHTML = 'No results found.';
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
