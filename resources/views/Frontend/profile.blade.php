@extends('Frontend.layouts.app')
@section('title','Profile')
@section('style')
    <style>
        .cusor{
            cursor: pointer;
        }
        .profileImg{
            width: 20%;
            /* height: 20%; */
            border: 3px dotted ;
            border-radius: 100% ;
            overflow: hidden;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

        .swal2-container.swal2-center>.swal2-popup{
            border-radius: 16px !important;
        }
        .swal2-cancel,.swal2-confirm{
            border-radius: 8px !important;
        }
    </style>
    @endsection
@section('content')

    <div class="card card-body ">
        <div class="text-center mt-2 wow bounceInDown ">
            <form action="{{ route('changeImg') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="file" class="d-none photoHidden"  onchange="form.submit()" name="photo">
            </form>
            <img src="{{ asset('hello/'.$user->photo) }}" class="profileImg shadow border-secondary p-1  " alt="">
        </div>
        <div class=" ">
            <div class="d-flex justify-content-between font-weight-bold  ">
                <span class="wow flipInX ">Name</span>
                <span class="wow flipInY ">{{ $user->name }}</span>
            </div>
        </div>
        <hr>
        <div class=" ">
            <div class="d-flex justify-content-between font-weight-bold  ">
                <span class="wow flipInX ">Phone</span>
                <span class="wow flipInY ">{{ $user->phone }}</span>
            </div>
        </div>
        <hr>
        <div class="">
            <div class="d-flex justify-content-between font-weight-bold  ">
                <span class="wow flipInX ">Email</span>
                <span class="wow flipInY ">{{ $user->email  }}</span>
            </div>
        </div>

    </div>
    <div class="card card-body mt-2 " >
        <div class="cusor   wow fadeInLeft ">
            <div class="">
                <a href="{{ route('updatePassword') }}" class="d-flex justify-content-between font-weight-bold text-decoration-none text-dark ">
                    <span class="">Change Password</span>
                    <span class=""> <i class="pe-7s-angle-right font-size-xlg font-weight-bolder "></i></span>
                </a>
            </div>
        </div>
        <hr>
        <div class="cusor wow fadeInLeft " >
            <div class="d-flex justify-content-between font-weight-bold " onclick="askConfirm()" >
                <span class="text-left ">Logout</span>
                <span class=""><i class="pe-7s-angle-right font-size-xlg font-weight-bolder " ></i></span>
            </div>
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="d-none" id="click">Logout</button>
            </form>
        </div>
    </div>
@endsection

@section('script')

    <script>
        $(document).ready(function (){
            $('.profileImg').click(function (){
                $('.photoHidden').click();
            })
        })
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
