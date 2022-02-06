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
        .cborder{
            border-bottom: 1px dotted !important;
            border-color: black ;
        }
        .topBarSticky{
            top: 65px;
        }
    </style>
@endsection

@section('content')


    <div class="infinite-scroll ">
        @foreach($notifications as $notification)
            <div class="card card-body my-2 wow fadeInRightBig  " >
                <p class="mb-1 " >Notification</p>
                <samll class="text-muted mb-3  ">{{ $notification->created_at->format('d/m/Y H:i:s a') }}</samll>

                <div class="text-center font-weight-bolder @if(is_null($notification->read_at)) text-warning  @endif">
                        <p class="mb-1 ">Title </p>
                        <p>{{ \Illuminate\Support\Str::limit($notification->data['title'],20)  }} </p>
                </div>

                <div class="d-flex justify-content-between cborder ">
                    <p class="mb-1 text-muted ">Notification</p>
                    <p class="mb-1 text-muted ">Adidas</p>
                </div>

                <div class=" ">
                    <a href="{{ url('notification/detail'.'/'.$notification->id) }}" class="mt-3 d-flex w-100  justify-content-between align-items-center  text-decoration-none text-dark ">
                        <span >Detail </span>
                        <span ><i class="pe-7s-angle-right mb-0  font-weight-bolder font-size-xlg"></i></span>
                    </a>
                </div>
            </div>
        @endforeach

        {{ $notifications->links() }}
{{--            ->appends(\Illuminate\Support\Facades\Request::all())      --}}
    </div>
@endsection

@section('script')
    <script >
        $('ul.pagination').hide();
        $(document).ready(function (){
            $(function() {
                $('.infinite-scroll').jscroll({
                    autoTrigger: true,
                    padding: 20,
                    loadingHtml: '<div class="text-center mb-5 pb-5 " ><img class="center-block w-25 " src="{{ asset('img/loading.gif') }}" alt="Loading..." /></div>', // MAKE SURE THAT YOU PUT THE CORRECT IMG PAT
                    nextSelector: '.pagination li.active + li a',
                    contentSelector: 'div.infinite-scroll',
                    callback: function() {
                        $('ul.pagination').remove();
                    }
                });
            });
        })


    </script>
@endsection
