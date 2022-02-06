@extends('Frontend.layouts.app')
@section('title','Transfer')
@section('style')
    <style>
        .cusor img{
            width: 30px;
            height: 30px;
        }
    </style>
@endsection

@section('content')


    <div class="card card-body mt-2 " >
        <div class="cusor d-flex  align-items-center justify-content-between  font-weight-bold text-decoration-none text-dark">
            <div class="wow fadeInDownBig ">
                <img src="https://image.flaticon.com/icons/png/128/3398/3398063.png" alt="" class="">
                <span class="ml-2">Your Money</span>
            </div>
            <span class="font-weight-bold font-size-lg text-primary  wow fadeInRightBig   ">{{ number_format($user->getWallet->amount,2) }} MMK</span>
        </div>

        <form action="{{ route('transferConfirm') }}" class="mt-3" method="post" id="transfer" >
            @csrf
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <small class="text-danger d-block ">{{ $error }}</small>
                @endforeach
                @endif
            <span for="">To <span class=" wow fadeInLeft  verify_acc"> </span></span>
            <div class="input-group mb-4 wow fadeInLeft ">
                <input type="text" name="to_phone" class="form-control to_phone " value="{{ $to_phone ?? old('phone') }}">
                <div class="input-group-append">
                    <span class="input-group-text btn verify_btn" id="basic-addon2">
                        Verify <i class="pe-7s-check font-size-xlg text-success ml-2 "></i>
                    </span>
                </div>
            </div>
            <div class="form-group mb-4 wow bounceInDown ">
                <span>Amount</span>
                <input type="text" name="amount" class="form-control" value="{{ old('amount') }}">
            </div>
            <div class="form-group mb-4 wow fadeInLeft">
                <span>Description</span>
                <textarea name="description" id="" class="form-control " cols="" rows=""></textarea>
            </div>
            <div class="form-group mt-3 wow flipInX ">
                <button class="btn btn-primary btn-block">Continue</button>
            </div>

        </form>

    </div>
@endsection

@section('script')
            <script>
            $(document).ready(function (){
                $('.verify_btn').click(function (){
                let phone = $('.to_phone').val();
                    $.ajax({
                        url:'{{ url('verify') }}/'+phone,
                        method : 'GET',
                        success : function (data){
                            if(data.status == 'success'){
                                $('.verify_acc').text('('+data.user.name+')');
                                $('.verify_acc').removeClass('text-danger ');
                                $('.verify_acc').addClass('text-success ');
                            }else {
                                $('.verify_acc').text('( No User ) ');
                                $('.verify_acc').removeClass('text-success ');
                                $('.verify_acc').addClass('text-danger ');

                                $('.verify_btn').parents().siblings().val('');
                            }

                        }
                    })
                })
            })
        </script>
@endsection
