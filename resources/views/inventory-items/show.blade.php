@extends('layout')
@section('content')
<!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">{{$data->name}}
                                <a href="{{url('admin/roomtype')}}" class="float-right btn btn-success btn-sm">View All</a>
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" >
                                    <tr>
                                        <th>Name</th>
                                        <td>{{$data->name}}</td>
                                    </tr>
                                    <tr>
                                        <th>Price</th>
                                        <td>{{$data->price}}</td>
                                    </tr>
                                    <tr>
                                        <th>Price</th>
                                        <td>{{$data->capacity}}</td>
                                    </tr>
                                    <tr>
                                        <th>Detail</th>
                                        <td>{{$data->description}}</td>
                                    </tr>
                                    <tr>
                                        <th>Gallery Images</th>
                                        <td>
                                            <table class="table table-bordered mt-3">
                                                <tr>
                                                    @foreach($data->images as $img)
                                                    <td class="imgcol{{$img->id}}">
                                                        <img width="150" src="{{Storage::url($img->filename)}}" />
                                                    </td>
                                                    @endforeach
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

@endsection