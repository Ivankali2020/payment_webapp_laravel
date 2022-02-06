<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
{{--    <script src="{{ asset('js/app.js') }}" defer></script>--}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- datarangepicker -->
    <link rel="stylesheet" href="{{ asset('Backend/css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


{{--    animate.css   --}}
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('Backend/css/main.css ') }}" rel="stylesheet">
    <link href="{{ asset('Frontend/style.css ') }}" rel="stylesheet">
    @yield('style')
</head>
<body>

        <div class="container  header ">
            <div class="row justify-content-center  ">
                <div class="col-12 col-md-8 m-auto card border-0 shadow  py-3 " >
                    <div class="row align-items-center justify-content-between ">
                        <div class="col-9 ">
                            <a href="{{ route('home') }} " class="wow fadeIn  text-decoration-none text-dark w-100 font-size-xlg d-flex align-items-center ">
                                <span> @yield('title') </span>
                                <i class="metismenu-icon pe-7s-magic-wand ml-2   font-size-xlg "></i>

                            </a>
                        </div>
                        <div class="col-2 ">
                            <a href="{{ route('notification.index') }} " class="wow bounceInDown  text-decoration-none d-flex align-items-center text-dark  float-right  font-size-lg ">
                                <i class="metismenu-icon pe-7s-bell  font-size-xlg ">  </i>
                                <span><sup class="text-danger "> {{ \Illuminate\Support\Facades\Auth::user()->unreadNotifications->count() }} </sup></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container" id="app">
            <div class="row justify-content-center main">
                <div class="col-12 col-md-8 pt-2 ">
                    @yield('content')
                </div>
            </div>
        </div>
        <div class="container  footer">
            <div class="row justify-content-center  ">
                <div class="col-12 col-md-8 m-auto card border-0 shadow px-3 py-2 py-md-3 " >
                    <div class="row  text-center">
                        <div class="wow fadeInDownBig  scan-box">
                            <a href="{{ route('paymentQR') }}" class="text-decoration-none bg-white  ">
                                <div class="scan">
                                    <i class="metismenu-icon fa fa-qrcode font-size-lg "></i>
                                </div>
                            </a>
                        </div>
                        <div data-wow-delay=".2s" class="wow fadeInLeft  col-3">
                            <a href="{{ route('home') }} " class="w-100 text-decoration-none text-dark   d-flex justify-content-center flex-column flex-xl-row   align-items-center  font-size-lg  ">
                                <i class="metismenu-icon pe-7s-home mr-0 mr-xl-3  py-2 py-md-0    font-size-xlg "></i>
                                <span class="d-none d-xl-block ">Home</span>
                            </a>
                        </div>

                        <div data-wow-delay=".4s" class="wow fadeInLeft  col-3">
                            <a href="{{ route('transitionShow') }}" class="text-decoration-none w-100 d-flex text-dark justify-content-center flex-column flex-xl-row align-items-center  font-size-lg ">
                                <i class="metismenu-icon pe-7s-portfolio  mr-0 mr-xl-3 py-2 py-md-0     font-size-xlg "></i>
                                <span class="d-none d-xl-block ">  Transition</span>
                            </a>
                        </div>
                        <div data-wow-delay=".6s" class="wow fadeInLeft  col-3">
                            <a href="{{ route('wallet') }}" class="text-decoration-none w-100 d-flex     text-dark justify-content-center flex-column flex-xl-row align-items-center   font-size-lg ">
                                <i class="metismenu-icon pe-7s-camera mr-0 mr-xl-3 py-2 py-md-0  font-size-xlg "></i>
                                <span class="d-none d-xl-block "> Wallet</span>
                            </a>
                        </div>

                        <div data-wow-delay=".8s" class="wow fadeInLeft  col-3">
                            <a href="{{ route('profile') }}" class="text-decoration-none w-100 d-flex text-dark    justify-content-center flex-column flex-xl-row align-items-center  font-size-lg ">
                                <i class="metismenu-icon pe-7s-portfolio  mr-0 mr-xl-3  py-2 py-md-0  font-size-xlg "></i>
                                <span class="d-none d-xl-block ">Account</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script type="text/javascript" src="{{ asset('Frontend/scroll.min.js') }}"></script>

        {{--                <script src="https://code.jquery.com/jquery-3.5.1.js"></script>--}}
{{--        <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>--}}
{{--        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>--}}

        <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
{{--        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>--}}
        <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js" integrity="sha512-Eak/29OTpb36LLo2r47IpVzPBLXnAMPAVypbSZiZ4Qkf8p/7S/XRG5xp7OKWPPYfJT6metI+IORkR5G8F900+g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        @yield('script') @include('components.alert')
        <script>
            wow = new WOW(
                {
                    boxClass:     'wow',      // default
                    animateClass: 'animate__animated', // default
                    offset:       0,          // default
                    mobile:       true,       // default
                    live:         true        // default
                }
            )
            wow.init();
            // $(document).ready(function (){
            //     let token = document.head.querySelector('meta[name="csrf-token"]');
            //     if(token){
            //         $.ajaxSetup({
            //             headers : {
            //                 'X-CSRF_TOKEN' : token.content,
            //
            //             }
            //         })
            //     }
            //
            // })
        </script>



</body>
</html>
