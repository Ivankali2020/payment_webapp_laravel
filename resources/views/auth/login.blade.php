@extends('Frontend.layouts.app_plain')

@section('content')

<div class="container">
    <div class="row align-items-center justify-content-center  min-vh-100  ">
        <div class="col-12 col-md-6 col-xl-5  mt-5">
            <div class="card border-0 shadow ">
                <div class="card-body  ">
                    <h4 class="text-uppercase text-center" >LogIn </h4>
                    <p class="text-center text-muted">Fill the form to login</p>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
{{--                    <div class="form-group mb-3">--}}
{{--                        <label for="">Email</label>--}}
{{--                        <input type="email" class="form-control mt-2" value="{{ old('email') }}" name='email'>--}}
{{--                        @error('email')--}}
{{--                        <span >--}}
{{--                            <strong class="text-danger ">{{ $message }}</strong>--}}
{{--                        </span>--}}
{{--                        @enderror--}}
                        <div>
                            <label for="">Phone</label>
                            <input type="text" class="form-control mt-2" value="{{ old('phone') }}" name='phone'>
                            @error('phone')
                            <span >
                            <strong class="text-danger ">{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                    <div class="form-group mb-3 position-relative">
                        <label for="">Password</label>
                        <input type="password" class="form-control mt-2" name='password'  value="{{ old('password') }}" id="password">
                        <i class="fa fa-eye position-absolute mt-1  top-50 " style="right: 10px; cursor: pointer;" id="eye"></i>
                        @error('password')
                        <span >
                            <strong class="text-danger phone">{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3 d-flex align-items-center justify-content-between">
                        <button class="btn btn-dark ">Login Now</button>
                        <a href="{{ route('register') }}" class="text-decoration-none">Not register yet?</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
