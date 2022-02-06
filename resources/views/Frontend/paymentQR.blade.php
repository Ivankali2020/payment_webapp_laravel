@extends('Frontend.layouts.app')
@section('title','PyamentQR')
@section('style')
    <style>

    #videoScanner{
        width: 100%;
    }
    </style>
@endsection

@section('content')


    <div class="card-body card mt-2 d-flex flex-column justify-content-center align-items-center  qr_box">
        <img src="{{ asset('img/payqr.jpg') }}" class="text-muted wow fadeInDown   " alt="">
        <p class="mt-3 wow fadeInLeft ">pay other with our super feather </p>
        <button class="btn btn-primary btn-sm wow fadeInUp  "  data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-qrcode "></i>
            Scan Qr
        </button>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <video id="videoScanner"></video>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary " data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection

@section('script')

{{--    <script src="{{ asset('Frontend/scanner/qr-scanner.umd.min.js') }}"></script>--}}
{{--    <script src="{{ asset('Frontend/scanner/qr-scanner-worker.min.js') }}"></script>--}}

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script>


         $(document).ready(function (){
             let scanner = new Instascan.Scanner({ video: document.getElementById('videoScanner')});
             scanner.addListener('scan',function(c){
                 if(c){
                     $('#exampleModal').modal('hide');
                     window.location.href = 'transferShow?phone='+c;
                     console.log(c);

                 }

             });

             $('#exampleModal').on('show.bs.modal', function (event) {
                 Instascan.Camera.getCameras().then(function(cameras){
                     if(cameras.length > 0 ){
                         scanner.start(cameras[0]);
                     }

                 });
             });

             $('#exampleModal').on('hidden.bs.modal', function (event) {
                 Instascan.Camera.getCameras().then(function(cameras){
                     if(cameras.length > 0 ){
                         scanner.stop(cameras[0]);
                     }

                 });
             });

         })
    </script>
    @endsection
