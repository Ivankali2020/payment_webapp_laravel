<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Wallet;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use Yajra\DataTables\Facades\DataTables;

class WalletController extends Controller
{
    public function index()
    {
        return view('Backend.wallet.index');
    }

    public function show(){
        $data = Wallet::with('getUser');
        return DataTables::of($data)
            ->addColumn('wallet_person',function ($each){
                $user = $each->getUser;
                return '<p class="d-flex justify-content-between  ">Name: <span class="text-weigth-bold text-success ">'.$user->name.'</span></p>
                        <p class=" d-flex justify-content-between ">Email: <span class="text-weigth-bold text-success ">'.$user->email.'</span></p>
                        <p class="d-flex justify-content-between  ">Phone: <span class="text-weigth-bold text-success ">'.$user->phone.'</span></p>' ;
            })
            ->editColumn('amount',function ($each){
                $amount = number_format($each->amount,2);
                return '<p class="text-success d-flex justify-content-between  font-size-lg font-weight-bold " style="letter-spacing: 0.3rem" >'.$amount.' <span class="font-size-xlg text-primary  pe-7s-cash"></span> </p>';
            })
            ->editColumn('acc_number',function ($each){
                $amount = $each->acc_number;
                return '<p class="text-success font-size-lg font-weight-bold "style="letter-spacing: 0.5rem">'.$amount.' </p>';
            })
            ->editColumn('updated_at',function ($each){
                $date = $each->updated_at->format('d M Y');
                $time = $each->updated_at->diffForHumans();
                return '<div>
                             <p class=" d-flex justify-content-between"><i class="font-size-xlg  pe-7s-wristwatch mr-2"></i>'.$date.' </p>
                             <p class=" d-flex justify-content-between"><i class="font-size-xlg pe-7s-clock mr-2"></i>'.$time.' </p>
                          </div>';
            })
            ->rawColumns(['updated_at','wallet_person','amount','acc_number'])
            ->make(true);
    }
}
