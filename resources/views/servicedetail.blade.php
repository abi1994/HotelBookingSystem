@extends('frontlayout')
@section('content')
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<div class="container my-4">
	<h3 class="text-center mb-3">{{$service->title}}</h3>
	<div class="col-md-6 ">
		<a href="{{url('service/'.$service->id)}}">
			<img class="img-thumbnail" style="width:100%;" src="{{Storage::url($service?->image?->filename)}}" />
		</a>
	</div>
	<p>{{$service->detail_desc}}</p>
</div>
@endsection