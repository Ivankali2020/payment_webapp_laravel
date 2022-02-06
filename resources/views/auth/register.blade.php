
@extends('Frontend.layouts.app_plain')
@section('title','Register')
@section('content')


<div class="container">
    <div class="row align-items-center justify-content-center min-vh-100">
        <div class="col-12 col-md-7">
            <div class="card border-0 shadow ">
                <div class="card-body">
                    <form action="{{ route('register') }}" method="post">
                        @csrf
                        <h4 class="text-uppercase text-center" >Sign Up</h4>
                        <p class="text-muted text-center" > Fill out the form to register </p>


                        <div class="form-group mb-3">
                            <label for="">Name</label>
                            <input type="text" value="{{ old('name') }}" class="form-control mt-2 @error('name') is-invalid @enderror" name='name'>
                        </div>

                        <div class="form-group mb-3">
                            <label for="">Email</label>
                            <input type="email" value="{{ old('email') }}" class="form-control mt-2  @error('email') is-invalid @enderror" name='email'>
                        </div>

                        <div class="form-group mb-3">
                            <label for="phone">Phone</label>
                            <input type="number" value="{{ old('phone') }}" class="form-control mt-2 @error('phone') is-invalid @enderror" name='phone'>
                        </div>

                        <div class="form-group mb-3 position-relative">
                            <label for="">Password</label>
                            <input type="password" class="form-control mt-2" name='password' id="password">
                            <i class="fa fa-eye position-absolute mt-1  top-50 " style="right: 10px; cursor: pointer;" id="eye"></i>
                        </div>

                        <div class="form-group mb-3 position-relative">
                            <label for="password_confirmation">Comfirm Password</label>
                            <input type="password" class="form-control mt-2" name='password_confirmation' id="password_confirmation">
                            <i class="fa fa-eye position-absolute mt-1  top-50 " style="right: 10px; cursor: pointer;" id="eye2"></i>
                        </div>

                        <div class="form-group mb-3 d-flex align-items-center justify-content-between">
                            <button class="btn btn-dark w-75">Sing Up</button>
                            <a href="{{ route('login') }}" class="text-decoration-none">Login Now?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
