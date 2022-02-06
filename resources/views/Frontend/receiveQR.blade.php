@extends('Frontend.layouts.app')
@section('title','ReceiveQR')
@section('style')
<style>

    .qr_box p{
       margin-bottom: -10px;
        z-index: 3;
    }
</style>
@endsection

@section('content')


<div class="card-body card mt-2 d-flex flex-column justify-content-center align-items-center  qr_box">
    <p class="font-weight-bolder ">QR scan to pay {{ $Auth_user->name }}</p>
    <img class="w-50 h-50 "  src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(300)->generate($Auth_user->phone)) !!} ">
    <span class="font-weight-bolder "> {{$Auth_user->phone}} </span>
</div>
@endsection


