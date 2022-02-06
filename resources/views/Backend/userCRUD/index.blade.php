@extends('Backend.layout.app')
@section('title') User  @endsection
@section('user_index_active','mm-active')
@section('content')
    <div class="app-page-title mb-3 ">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-users icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>  User Management </div>
            </div>

        </div>
    </div>

            <a href="{{ route('admin.user.create') }}" class="btn btn-outline-primary">Create User</a>
            <div class="card card-body mt-3 ">

                <table class="table table-bordered table-responsive-sm w-100" id="dataTable">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td >Name</td>
                            <td>Email</td>
                            <td>Phone</td>
                            <td>IP</td>
                            <td class="no-sort" >Device/ Platform/ Browser</td>
                            <td>Login At</td>
                            <td class="no-sort text-nowrap" >Update Time</td>
                            <td class="no-sort text-nowrap" >Control</td>
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
                ajax: "{!!route('admin.user.dataTable')!!}",
                columns: [
                    {data:'id',name: 'id'}, //DT_RowIndex is 1.2.3.4. can't sort
                    {data: 'name', name: 'name'  },
                    {data: 'email', name: 'email'},
                    {data: 'phone', name: 'phone'},
                    {data: 'user_ip' , name:'user_ip'},
                    {data: 'user_agent' , name:'user_agent'},
                    {data: 'login_at' , name:'login_at'},
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
                        let url = 'user/'+id;

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

