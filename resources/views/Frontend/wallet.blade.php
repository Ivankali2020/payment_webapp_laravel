@extends('Frontend.layouts.app')
@section('title','Wallet')
@section('style')
    <style>
    .wallet{
        cursor:pointer;
    }
    .wallet span{
        transition: .3s all ease ;
    }
    .wallet span:hover{
        color: skyblue;
    }
    </style>
@endsection
@section('content')

    <div class="card card-body wallet">

        <div class="d-flex justify-content-between flex-column  font-weight-bold  ">
            <div class="mb-3 wow fadeInDown ">
                <p  class="mb-2 text-uppercase text-muted ">Name</p>
                <span class="text-capitalize d-flex ">
                    <i class='pe-7s-angle-right align-self-center'></i>
                    <span>{{ $user->name  }}</span>
                </span>
            </div>
            <div class="mb-3 wow fadeInLeft">
                <p class="mb-2 text-uppercase text-muted ">Account Number</p>
                <span class="text-capitalize d-flex ">
                    <i class='pe-7s-angle-right align-self-center'></i>
                    <span class="">{{ $user->getWallet ? $user->getWallet->acc_number: '-'  }}</span>

                </span>
            </div>
            <div class="mb-3 wow fadeInUp ">
                <p class="mb-2 text-uppercase text-muted ">Amount</p>
                <span class="text-capitalize d-flex ">
                    <i class='pe-7s-angle-right align-self-center'></i>

                    <span class="text-uppercase "> {{ $user->getWallet ? number_format($user->getWallet->amount,2) : '-'  }} mmk</span>
                </span>
            </div>

        </div>


    </div>

@endsection

@section('script')

    <script>
        function askConfirm(){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, LogOut!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#click').click();

                }
            })
        }
    </script>

@endsection
