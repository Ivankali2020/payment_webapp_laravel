@extends('Frontend.layouts.app')
@section('title','Transition')
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


    <div class="card-body card mt-2 ">

        <div class="mt-3 transfer text-center wow fadeIn   " data-wow-delay=".5s" data-wow-duration="2s">
            <img src="https://image.flaticon.com/icons/png/128/1055/1055183.png" alt="">
           @if($transition->type == 1)
                <h6 class="mt-2 font-weight-bold "> Recived Money </h6>
            @else
                <h6 class="mt-2 font-weight-bold "> Transfer Money </h6>
            @endif
        </div>

        <div class="px-0 py-0 px-xl-5 mx-xl-5 ">
            <table class="table  px-lg-4 table-borderless   mt-3  ">
                <tbody>
                @if($transition->type == 1)
                    <tr>
                        <td>From</td>
                        <td class="text-right ">{{ $transition->fromOtherUser->name }}</td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td class="text-right ">{{ $transition->fromOtherUser->phone }}</td>
                    </tr>
                    <tr>
                        <td>Amount</td>
                        <td class="text-right ">+{{ number_format($transition->amount,2) }}Ks</td>
                    </tr>

                @elseif($transition->type == 2)
                    <tr>
                        <td>To</td>
                        <td class="text-right ">{{ $transition->fromOtherUser->name }}</td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td class="text-right ">{{ $transition->fromOtherUser->phone }}</td>
                    </tr>
                    <tr>
                        <td>Amount</td>
                        <td class="text-right "> -{{ number_format($transition->amount,2) }}Ks</td>
                    </tr>

                @endif

                <tr>
                    <td>Account Number</td>
                    <td class="text-right "> {{ $transition->owner->getWallet->acc_number  }} </td>
                </tr>
                <tr>
                    <td>Ref_id</td>
                    <td class="text-right ">{{ $transition->ref_id }}</td>
                </tr>
                <tr class="text-wrap ">
                    <td>Description</td>
                    <td class="text-right ">{{$transition->description? $transition->description : '-'}}</td>
                </tr>

                </tbody>
            </table>
        </div>

{{--        <div class="text-center ">--}}
{{--            <button class="btn btn-primary " onclick="askTransfer()">Transfer</button>--}}
{{--        </div>--}}

    </div>
@endsection


