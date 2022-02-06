@extends('Frontend.layouts.app')
@section('title','Confirm')
@section('style')
    <style>
        .swal2-confirm,.swal2-cancel{
            border-radius: 8px !important;
        }
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
           text-align: right ;
        }
    </style>
@endsection

@section('content')


    <div class="card card-body mt-2 " >


        <div class="mt-3 transfer text-center ">
            <img src="https://image.flaticon.com/icons/png/128/1055/1055183.png" alt="">
            <h6 class="mt-2 font-weight-bold "> Confirm Transfer Box </h6>
        </div>
        <input type="hidden" value="{{ $hashValue }}" name="hashValue">
        <div class="text-center">
            <table class="table table-borderless text-left mt-3  ">
                <tbody>
                <tr>
                    <td>TO</td>
                    <td>{{ $to_phone  }}</td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td>{{ $to_user_name }}</td>
                </tr>
                </tr>
                <tr>
                    <td>Amount</td>
                    <td>{{ $amount  }} MMK</td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td>{{ $description ? $description : '-' }}</td>
                </tr>

                </tbody>
            </table>
        </div>

        <div class="text-center ">
            <button class="btn btn-primary " onclick="askTransfer()">Transfer</button>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function askTransfer(){
            Swal.fire({
                title: 'Type Your Password!',
                html : '<input type="password" name="password" autofocus  class="form-control p text-center"/>',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    let password = $('.p').val();
                    // console.log(password);
                    $.ajax({
                        url : '/checkPassword/?password='+password,
                        method : 'GET',
                        data : {
                            amount : {{ $amount }},
                            to_phone : '{{ $to_phone }}',
                            description : '{{ $description ? $description : '-' }}',
                            hashValue : '{{ $hashValue }}'
                        },
                        success : function (data){
                            console.log(data);
                            if(data.status == 'success'){
                                Swal.fire(
                                    {
                                        icon : 'success',
                                        html : `<div class="">

                                                <div class="card card-body my-2 " >
                                                    <small class="mb-1 " >Payment Bouncher</small>
                                                    <samll class="mb-3  ">{{ date('d/m/Y H:m a') }}</samll>

                                                    <div class="text-center font-weight-bolder ">
                                                            <p class="mb-1 " >Transfer</p>
                                                            <p class="text-danger">- {{ $amount}}  Ks</p>
                                                    </div>

                                                </div>
                                        </div>`,
                                    }
                                )
                                setTimeout(()=>{
                                    location.href = 'transitionDetail/'+data.trx_id;
                                },20000)
                            }else {
                                Swal.fire(
                                    data.message,
                                    '',
                                    'error'
                                )
                            }
                        }
                    })

                }
            })
        }
    </script>
    @endsection
