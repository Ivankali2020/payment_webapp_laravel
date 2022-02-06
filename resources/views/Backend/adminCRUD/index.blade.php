@extends('Backend.layout.app')
@section('title') Admin  @endsection
@section('admin_index_active','mm-active')
@section('content')
    <div class="app-page-title mb-3 ">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-users icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div> Admin User Management </div>
            </div>

        </div>
    </div>

            <a href="{{ route('admin.adminUser.create') }}" class="btn btn-outline-primary">Create Admin User</a>
            <div class="card card-body mt-3 ">
                @if(session('status'))
                    <small class="alert-success alert my-3 ">{{ session('status') }}</small>
                    @endif
                   @isset($name)
                        {!! $name !!}
                    @endisset
                <table class="table table-bordered table-responsive-sm w-100" id="dataTable">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td >Name</td>
                            <td>Email</td>
                            <td>Phone</td>
                            <td>IP</td>
                            <td class="no-sort" >Device/ Platform/ Browser</td>
                            <td class="no-sort" >Update Time</td>
                            <td class="no-sort" >Control</td>
                        </tr>
                    </thead>
                    <tbody>      </tbody>
                </table>
            </div>

@endsection

@section('script')

    <script>
        $(document).ready(function() {
           var table = $('#dataTable').DataTable( {
                processing: true,
                serverSide: true,
                ajax: "{!!route('admin.adminUser.dataTable')!!}",
                columns: [
                    {data:'id',name: 'id'}, //DT_RowIndex is 1.2.3.4. can't sort
                    {data: 'name', name: 'name'  },
                    {data: 'email', name: 'email'},
                    {data: 'phone', name: 'phone'},
                    {data: 'client_ip' , name:'client_ip'},
                    {data: 'client_user_agent' , name:'client_user_agent'},
                    {data: 'updated_at',name:'updated_at'},
                    {data: 'action', name: 'action'},

                ],
               columnDefs : [
                   { targets : 'no-sort' , sortable  : false } //fucking s is so noisy
               ],
               order: [
                   [ 6,'desc'],
               ]
            } );
            $(document).on('click','.delete',function (e){
                let token = document.head.querySelector('meta[name="csrf-token"]');
                if(token){
                    $.ajaxSetup({
                        headers : {
                            'X-CSRF_TOKEN' : token.content
                        }
                    })
                }
                e.preventDefault();
                let id = $(this).attr('data');


                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        let url = 'adminUser/'+id;

                        // simple ajax method
                      // $.ajax({
                      //     url : url,
                      //     type : 'DELETE',
                      //     success : function (data){
                      //         table.ajax.reload();
                      //         console.log(data);
                      //     }
                      // })
                        $.ajax({
                            url : url,
                            type : 'DELETE',
                            success:function (data){

                                if(data == 'success'){
                                    swalWithBootstrapButtons.fire(
                                        'Deleted!',
                                        'Your file has been deleted.',
                                        'success'
                                    );
                                    table.ajax.reload();
                                }
                            }

                        })


                    }
                })
            })
        } );
    </script>

@endsection

