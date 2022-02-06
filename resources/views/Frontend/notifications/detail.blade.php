@extends('Frontend.layouts.app')
@section('title',' Detail')
@section('style')
    <style>

        .transfer img{
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 1px solid deepskyblue;
            padding: 8px;
        }
        table td:first-child{
            animation: fadeInLeft calc(0.8s * 5) ;
        }
        table td:last-child{
            animation: fadeInRight calc(0.8s * 3) ;
        }
    </style>
@endsection

@section('content')


    <div class="card-body card mt-2  ">

       <div class="text-right wow fadeInRight ">
           <p class="mb-1 " >Notification</p>
           <small class="text-muted mb-3  ">{{ $notification->created_at->format('d/m/Y H:i:s a') }}</small>
       </div>

        <div class=" font-weight-bolder text-center mt-4 wow fadeInDown">
            <p class="mb-1 ">Title </p>
            <p class="text-center"> {{ $notification->data['title'] }} </p>
        </div>
        <div class=" font-weight-bolder text-center mt-4  wow fadeInLeft">
            <p class="mb-1 ">Message</p>
            <p class=""> {{ $notification->data['message'] }} </p>
        </div>

        <div class="d-flex justify-content-between cborder wow  fadeInUp ">
            <p class="mb-1 text-muted ">Adidas</p>
            <a href=" {{ $notification->data['web_link'] }}" class="text-dark text-decoration-none ">Go Home</a>
        </div>


    </div>
@endsection


