<?php

namespace App\Http\Controllers\Backend;

use App\AdminUser;
use App\Helpers\UUIDGenerate;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminCreateRequest;
use App\Http\Requests\AdminUpdateRequest;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\User;
use App\Wallet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Jenssegers\Agent\Agent;
class userController extends Controller
{

    public function index(){
        $name = 'ivan';
        return view('Backend.userCRUD.index',compact('name'));
    }

    public function show(){
        $data = User::query();
        return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('user_ip',function ($each){
                    if($each->user_ip){
                        return $each->user_ip;
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
                ->editColumn('login_at',function ($each){
                    $date = Carbon::parse($each->login_at)->format('Y-m-d');
                    $time = Carbon::parse($each->login_at)->diffForHumans($each->login_at);
                    return '<div>
                                 <small class="d-block"><i class="fa fa-calendar mr-2"></i>'.$date.' </small>
                                 <small><i class="fa fa-calendar mr-2"></i>'.$time.' </small>
                                 </div>';
                })

                ->editColumn('user_agent',function ($each){
                    if($each->user_agent){
                       $agent = new Agent();
                       $agent->setUserAgent($each->user_agent);
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
                    $editBtn = '<a href="'. url('admin/user/'.$each->id.'/edit') .'"  class="btn btn-sm mr-3 btn-outline-warning"><i class="fa fa-fw fa-edit"></i>  </a>';
                    $deleteBtn = '<a href="#" class="btn btn-sm btn-outline-danger delete" data="'.$each->id.'"><i class="fa fa-trash-alt fa-fw"></i></a>';

                    return '<div class="d-block text-nowrap">'.$editBtn.$deleteBtn.'</div>';
                })
                ->rawColumns(['user_agent','action','updated_at','login_at'])
                ->make(true);
    }


    public function create(){

        return view('Backend.userCRUD.create');
    }

    public function store(UserCreateRequest $request){
        DB::beginTransaction();
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->phone = $request->phone;
            $user->save();

            Wallet::firstOrcreate(
                [
                    'user_id' => $user->id
                ],
                [
                    'user_id' => $user->id,
                    'acc_number' => UUIDGenerate::accGenerate(),
                    'amount' => 0,
                ]
            );
            DB::commit();
            return redirect()->route('admin.user.index')->with('toast',['icon'=>'success' , 'title'=>'successfully Created User '.$request->name]);

        }catch (\Exception $e){
            return redirect()->back()->with('toast',['icon'=>'error','title'=>$e->getMessage()]);
        }

    }


    public function edit($id){
        $user = User::find($id);
        return view('Backend.userCRUD.edit',compact('user'));
    }

    public function update($id,UserUpdateRequest $request){

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password ? Hash::make($request->password) : $user->password;
        $user->phone = $request->phone;
        $user->save();
        return redirect()->route('admin.user.index')->with('toast',['icon'=>'success' , 'title'=>'Successfully updated '.$request->name]);
    }

    public function destroy($id){
        $user = User::find($id);
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
