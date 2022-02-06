@extends('Backend.layout.app')
@section('title') Dashboard @endsection
@section('admin_home_active','mm-active')
@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-display2 icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div> Dashboard</div>
                <input type="text" class="form-control dateCustom">
            </div>

        </div>
    </div>
@endsection

@section('script')
    <script>
        $(function() {
            $('.dateCustom').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 1901,
                maxYear: parseInt(moment().format('YYYY'),10)
            }, function(start, end, label) {
                var years = moment().diff(start, 'years');
                alert("You are " + years + " years old!");
            });
        });
    </script>
@endsection
