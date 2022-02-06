<?php

namespace App\Http\Controllers\Backend;

use App\AdminUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminCreateRequest;
use App\Http\Requests\AdminUpdateRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Jenssegers\Agent\Agent;
class AdminUserController extends Controller
{
    public function index(){
        $name = 'ivan';
        return view('Backend.adminCRUD.index',compact('name'));
    }

    public function show(){
        $data = AdminUser::query();
        return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('client_ip',function ($each){
                    if($each->client_ip){
                        return $each->client_ip;
                    }
                })
                ->editColumn('updated_at',function ($each){
                    $date = $each->updated_at->format('d M Y');
                    $time = $each->updated_at->diffForHumans();
                    return '<div>
                             <small class="d-block"><i class="fa fa-calendar mr-2"></i>'.$date.' </small>
                             <small><i class="fa fa-calendar mr-2"></i>'.$time.' </small>
                             </div>';
                })
                ->editColumn('client_user_agent',function ($each){
                    if($each->client_user_agent){
                       $agent = new Agent();
                       $agent->setUserAgent($each->client_user_agent);
                       $device = $agent->device();
                       $platform = $agent->platform();
                       $browser = $agent->browser();
                       return
                           '<div class="text-center w-100"  >
                            <span class="badge badge-pill badge-info me-2">'.$platform.'</span>
                            <span class="badge badge-pill badge-info me-2">'.$browser.'</span>
                            </div>';
                    }
                })
                ->addColumn('action',function ($each){
                    $editBtn = '<a href="'. url('admin/adminUser/'.$each->id.'/edit') .'"  class="btn btn-sm mr-3 btn-outline-warning"><i class="fa fa-fw fa-edit"></i>  </a>';
                    $deleteBtn = '<a href="#" class="btn btn-sm btn-outline-danger delete" data="'.$each->id.'"><i class="fa fa-trash-alt fa-fw"></i></a>';

                    return $editBtn.$deleteBtn;
                })
                ->rawColumns(['client_user_agent','action','updated_at'])
                ->make(true);
    }


    public function create(){

        return view('Backend.adminCRUD.create');
    }

    public function store(AdminCreateRequest $request){

        $user = new AdminUser();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->save();
        return redirect()->route('admin.adminUser.index')->with('toast',['icon'=>'success' , 'title'=>'successfully Created Admin'.$request->name]);
    }


    public function edit($id){
        $user = AdminUser::find($id);
        return view('Backend.adminCRUD.edit',compact('user'));
    }

    public function update($id,AdminUpdateRequest $request){

        $user = AdminUser::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password ? Hash::make($request->password) : $user->password;
        $user->phone = $request->phone;
        $user->save();
        return redirect()->route('admin.adminUser.index')->with('toast',['icon'=>'success' , 'title'=>'Successfully updated '.$request->name]);
    }

    public function destroy($id){
        $user = AdminUser::find($id);
        $user->delete();
        return 'success';

    }
//    public function index(Request $request)
//    {
//        if ($request->ajax()) {
//            $data = AdminUser::all();
//            return Datatables::of($data)
//                ->addIndexColumn()
//                ->addColumn('action', function($row){
//
//                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
//
//                    return $btn;
//                })
//                ->rawColumns(['action'])
//                ->make(true);
//        }
//
//        return view('Backend.adminCRUD.index');
//    }
}
