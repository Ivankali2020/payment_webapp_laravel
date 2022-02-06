@extends('Frontend.layouts.app')
@section('title','Magic_Pay')
@section('style')
    <style>
        .wallet{

            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 40px;

        }
        .home{
            width: 70px;
            height: 70px;
            position: fixed;
            top:71px;

        }
        .home .inner{
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background-color: #add8e6;
            margin-right: 0 !important ;
        }
        .homeImg{
            width: 100%;
            height: 100%;
            border-radius: 100%;
            animation: glow 5s infinite ;
        }
        .qr{
            width: 30px;
            height: 30px;
            cursor: pointer;
        }
        .cusor img{
            width: 30px;
            height: 30px;
        }
    </style>
@endsection
@section('content')

    <div class="card card-body wallet  ">
        <div class="home d-inline-block wow fadeInDown ">
            <div class="inner m-0  p-2 ">
                <img src="{{ asset('hello/'.$user->photo) }}" class="homeImg  " alt="">
            </div>
        </div>
        <div class="mt-3 text-center  ">
            <p class="mb-2 text-uppercase text-muted wow bounceInLeft ">{{ $user->name  }}</p>
            <span class="text-capitalize d-flex  wow bounceInRight ">
                    <span class="">{{ $user->getWallet ? number_format($user->getWallet->amount,2 ) : '-'  }} MMK</span>
            </span>
        </div>
    </div>

    <div class="form-row mt-3 ">
        <div class="col-6 wow fadeIn " data-wow-duration="2s">
            <a href="{{ route('paymentQR') }}" class="d-flex  align-items-center justify-content-between font-weight-bold text-decoration-none text-dark ">
                <div class="card card-body p-2   d-flex flex-row  align-items-center justify-content-around ">
                    <img src="{{ asset('img/pay-qr2.png') }}" class="qr" alt="">
                    <span>Pay and Scan</span>
                </div>
            </a>
        </div>
        <div class="col-6 wow fadeIn" data-wow-duration="2s">
            <a href="{{ route('receiveQR') }}" class="d-flex  align-items-center justify-content-between font-weight-bold text-decoration-none text-dark ">
                <div class="card card-body p-2  d-flex flex-row  align-items-center justify-content-around ">
                    <img src="{{ asset('img/pay-qr.png') }}" class="qr" alt="">
                    <span>Recive QR</span>
                </div>
            </a>
        </div>
    </div>
    <div class="card card-body mt-3 " >
        <div class="cusor wow fadeInLeft">

                <a href="{{ route('transferShow') }}" class="d-flex  align-items-center justify-content-between font-weight-bold text-decoration-none text-dark ">
                    <span class="">
                        <img src="https://image.flaticon.com/icons/png/128/3398/3398063.png" alt="" class="">
                        Transfer Money
                    </span>
                    <span class=""> <i class="pe-7s-angle-right font-size-xlg font-weight-bolder "></i></span>
                </a>

        </div>
        <hr>
        <div class="cusor wow fadeInLeft">

            <a href="{{route('wallet')}}" class="d-flex align-items-center  justify-content-between font-weight-bold text-decoration-none text-dark ">
                    <span class="">
                        <img src="{{ asset('img/wallet.png') }}" alt="" class="">
                        Wallet
                    </span>
                <span class=""> <i class="pe-7s-angle-right font-size-xlg font-weight-bolder "></i></span>
            </a>

        </div>
        <hr>
        <div class="cusor wow fadeInLeft">

            <a href="{{ route('transitionShow') }}" class="d-flex align-items-center  justify-content-between font-weight-bold text-decoration-none text-dark ">
                    <span class="">
                        <img src="https://image.flaticon.com/icons/png/128/2510/2510695.png" alt="" class="">
                        Transition
                    </span>
                <span class=""> <i class="pe-7s-angle-right font-size-xlg font-weight-bolder "></i></span>
            </a>

        </div>

    </div>
@endsection
