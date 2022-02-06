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

    <div class="card card-body sticky-top topBarSticky wow fadeInUp">
        <div class="form-row">
            <div class="col-6">
                <div class="input-group ">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01"><i class="pe-7s-date  font-weight-bolder font-size-lg"></i></label>
                    </div>
                    <input type="text" value="{{request()->date ?? date('Y-m-d')}} @" class="form-control date">
                </div>
            </div>
            <div class="col-6">
                <div class="input-group ">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01"><i class="pe-7s-search font-weight-bolder font-size-lg"></i></label>
                    </div>
                    <select class="custom-select selectByType" name="select" id="inputGroupSelect01 selectByType ">
                        <option value="">All</option>
                        <option value="1" @if(request()->type == 1 ) selected @endif>Income</option>
                        <option value="2" @if(request()->type == 2 ) selected @endif>Outcome</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

   <div class="infinite-scroll">
     @foreach($transitions as $transition)
           <div class="card card-body my-2 wow fadeInRightBig " >
               <p class="mb-1 " >Payment Bouncher</p>
               <samll class="text-muted mb-3  ">{{ $transition->created_at->format('d/m/Y H:i:s a') }}</samll>

               <div class="text-center font-weight-bolder ">
                   @if($transition->type == 1)
                       <p class="mb-1 " >Incoming</p>
                       <p>+ {{ number_format($transition->amount,2) }} Ks</p>
                   @else
                       <p class="mb-1 ">Outcome </p>
                       <p>- {{ number_format($transition->amount,2) }} Ks</p>
                   @endif
               </div>

               <div class="d-flex justify-content-between cborder ">
                   <p class="mb-1 text-muted ">Payment Bouncher</p>
                   <p class="mb-1 text-muted ">Adidas</p>
               </div>

               <div class=" ">
                   <a href="{{ url('transitionDetail'.'/'.$transition->trx_id) }}" class="mt-3 d-flex w-100  justify-content-between align-items-center  text-decoration-none text-dark ">
                       <span >Detail </span>
                       <span ><i class="pe-7s-angle-right mb-0  font-weight-bolder font-size-xlg"></i></span>
                   </a>
               </div>
           </div>
       @endforeach

         {{ $transitions->appends(\Illuminate\Support\Facades\Request::all())->links() }}

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

        $(document).ready(function (){

            $('.date').daterangepicker({
                "singleDatePicker": true,
                "autoApply": true,
                "locale" : {
                  "format" : "YYYY-MM-DD",
                },
            });

            $('.date').on('apply.daterangepicker', function(ev, picker) {
                let Cdate = $('.date').val();
                // let type = $('.selectByType').val();
                history.pushState(null,'',`?date=${Cdate}`);
                window.location.reload();
            });

            $('.selectByType').change(function (){
                let Cdate = $('.date').val();
                let type = $('.selectByType').val();
                history.pushState(null,'',`?date=${Cdate}&type=${type}`);
                window.location.reload();
            })
        })

        // $(function() {
        //     $('.infinite-scroll').jscroll({
        //         autoTrigger: true,
        //         padding: 0,
        //         nextSelector: '.pagination li.active + li a',
        //         contentSelector: 'div.scrolling-pagination',
        //         callback: function() {
        //             $('ul.pagination').remove();
        //         }
        //     });
        // });

    </script>
@endsection
