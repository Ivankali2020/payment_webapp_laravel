@extends('Backend.layout.app')
@section('title') Edit Admin  @endsection
@section('admin_index_active','mm-active')
@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-users icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div> Edit Admin User </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-7 m-auto">
            <div class="card card-body mt-3" >
                @if(session('status'))
                    {{ session('status') }}
                @endif
                <form action="{{ url('admin/adminUser/'.$user->id) }}" method="post" id="update">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text"  class="form-control " name="name" value="{{ $user->name }}" >

                    </div>

                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" class="form-control " name="email"  value="{{ $user->email }}" >

                    </div>

                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password"  class="form-control " name="password"  placeholder="**** Should Change ******">

                    </div>

                    <div class="form-group">
                        <label for="">Phone</label>
                        <input type="number"  class="form-control  " name="phone"  value="{{ $user->phone }}">

                    </div>

                    <div class="form-group text-right">
                        <button type="button" id="backBtn" class="btn btn-outline-secondary">Cancel</button>
                        <button type="submit" class="btn btn-info">Edit Admin</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('script')
    {!! JsValidator::formRequest('App\Http\Requests\AdminUpdateRequest', '#update'); !!}
    <script>



        $(document).ready(function() {

        } );
    </script>

@endsection

