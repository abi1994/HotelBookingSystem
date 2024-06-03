@extends('frontlayout')
@section('content')
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-radius: 1rem shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                        <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img src="{{asset('/img/register.webp')}}"
                 class="img-fluid"/>
            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
				    @if(Session::has('success'))
					<p class="text-success">{{session('success')}}</p>
					@endif
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                                    <form class="user" method="post" action="{{url('admin/customer')}}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" name="name" 
                                                class="form-control form-control-user" 
                                                id="name" placeholder="Full Name">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="email" 
                                                class="form-control form-control-user" 
                                                id="email" aria-describedby="emailHelp" placeholder="Email">
                                        </div>
                                        <div class="form-group">
                                            <input name="password" type="password" 
                                                class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <input type="number" name="phone_number" 
                                                class="form-control form-control-user" 
                                                id="mobile" placeholder="Mobile">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="address" 
                                                class="form-control form-control-user" 
                                                id="address" placeholder="Address">
                                        </div>
					                    <input type="hidden" name="ref" value="front" />
                                        <input type="submit" class="btn btn-primary btn-user btn-block"/>
                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/js/sb-admin-2.min.js"></script>
    @endsection