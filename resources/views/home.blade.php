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
		<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
										<img style="width: 200px; height: 150px;" src="{{ Storage::url($img->filename) }}" alt="Image for {{ $roomType->name }}">
									</a>

									<!-- Modal -->
									<div class="modal fade" id="imageModal{{$img->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog modal-dialog-centered" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">{{ $roomType->name }}</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body text-center">
													<img src="{{ Storage::url($img->filename) }}" class="img-fluid" alt="Image for {{ $roomType->name }}">
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
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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
		const results = [
			{ name: 'Standard Room', description: 'Our Standard Room offers a comfortable stay with essential amenities. Equipped with a cozy bed, a work desk, and a private bathroom, its perfect for travelers seeking simplicity and convenience' },
			{ name: 'Deluxe Room', description: 'Indulge in luxury with our Deluxe Suite. Featuring spacious accommodation, a plush king-sized bed, a separate living area, and an elegant en-suite bathroom, this suite offers the ultimate in comfort and relaxation.' },
			{ name:'Honeymoon Suite',description: 'Celebrate love and romance in our luxurious Honeymoon Suite. Featuring a romantic ambiance, a luxurious king-sized bed, a private balcony with scenic views, and a lavish spa bath, its the perfect setting for a memorable honeymoon or romantic escape.'}
		];

		// Filter results based on query
		const filteredResults = results.filter(room =>
				room.name.includes(query) || room.description.toLowerCase().includes(query.toLowerCase())
		);

		// Display results
		const resultsContainer = document.getElementById("searchResults");
		resultsContainer.innerHTML = '';
		if (filteredResults.length > 0) {
			filteredResults.forEach(room => {
				const roomElement = document.createElement('div');
				roomElement.innerHTML = `<strong>Room Name:</strong> ${room.name}<br><strong>Description:</strong> ${room.description}`;
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
