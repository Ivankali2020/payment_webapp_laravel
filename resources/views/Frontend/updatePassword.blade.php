@extends('Frontend.layouts.app')
@section('title','Change Password')

@section('content')

    <div class="card card-body shadow ">
        <div class="mb-3 text-center wow fadeInDownBig ">
            <img src="{{ asset('img/security.png') }}" class="img-thumbnail w-25 shadow " alt="">
        </div>
        @if($errors->any())
            @foreach($errors->all() as $error)
                <small class="text-danger alert-danger alert ">{{ $error }}</small>
            @endforeach
            @endif
        <form action="{{ route('newPassword') }}" class="wow fadeIn" method="post" id="update">
            @csrf

            <div class="form-group mb-3  ">
                <label for="">Old Password</label>
                <input type="text" class="form-control" name="oldPassword" >
            </div>

            <div class="form-group mb-3">
                <label for="">New Password</label>
                <input type="text" class="form-control" name="newPassword" >
            </div>

            <div class="form-group mb-3">
                <label for="">Confirm Password</label>
                <input type="text" class="form-control" value="{{ old('confirmPassword') }}" name="confirmPassword" >
            </div>

            <div class="form-group  wow fadeInUp ">
                <button type="submit" class="btn btn-block  btn-primary">Change New Password</button>
            </div>
        </form>

    </div>

@endsection

@section('script')
    {!! JsValidator::formRequest('App\Http\Requests\NewAccountRequest', '#update'); !!}
    <script>

    </script>

@endsection
