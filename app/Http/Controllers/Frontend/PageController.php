<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\UUIDGenerate;
use App\Http\Controllers\Controller;
use App\Http\Requests\NewAccountRequest;
use App\Http\Requests\TransferValidateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Notifications\GeneralNotification;
use App\Rules\MatchOldPassword;
use App\Transition;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PageController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function home(){
        $user = Auth::user();
        return view('Frontend.home',compact('user'));
    }

    public function profile(){
        $user = Auth::user();
        return view('Frontend.profile',compact('user'));
    }

    public function updatePassword(){

        return view('Frontend.updatePassword');
    }

    public function newPassword(NewAccountRequest $request){

        $user = User::find(Auth::id());
        $user->password = Hash::make($request->newPassword);
        $user->update();
        //this is notinication section
        $title = 'Changing Password??';
        $message = 'Your Account Password is Successfully Changed';
        $sourceable_id = $user->id;
        $sourceable_type = User::class;
        $web_link = url('notification');
        Notification::send([$user], new GeneralNotification($title,$message,$sourceable_id,$sourceable_type,$web_link));
        //notiend
        return redirect()->route('home')->with('toast',['icon'=>'success','title'=>$user->name.' password is Changed!']);
    }

    public function walletShow(){
        $user = Auth::user();
        return view('Frontend.wallet',compact('user'));
    }

    public function transferShow(Request $request){
        $user = Auth::user();
        $to_phone = $request->phone;
        return view('Frontend.transferShow',compact('user','to_phone'));
    }
    public function transferConfirm(TransferValidateRequest $request){
        $user = Auth::user();
        $to_phone = $request->to_phone;
        $amount = $request->amount;
        $description = $request->description;
        $Auth_user = Auth::user();
        $str = $to_phone.$amount;
        $hashValue = hash_hmac("sha256",$str,"magicPay");
        //check amount is lower than own//
        if($amount > $Auth_user->getWallet->amount){
            return redirect()->route('transferShow')->with('toast',['icon'=>'error','title' => 'Your Balance is not enough']);
        }
        //check if customer transfer yourself//
        if($Auth_user->phone != $to_phone){
            //search phone number//
            if(User::where('phone',$to_phone)->exists()){
                $to_user_name = User::where('phone',$to_phone)->first()->name;
                return view('Frontend.transferConfirm',compact('hashValue','user','to_user_name','to_phone','amount','description'));
            }
        }
        return redirect()->route('transferShow')->with('toast',['icon'=>'error','title' => 'You Can not transfer yourself']);

    }
    public function verifyAcc($phone='false'){
        $Auth_user = Auth::user();
        if($Auth_user->phone != $phone){
          $user = User::where('phone',$phone)->first();
          if($user){
              return response()->json(['status'=>'success','user'=>$user]);
          }
        }
        return response()->json(['status'=>'fail']);
;
    }

    public function checkPassword(Request $request){
        $password = $request->password;
        $to_phone = $request->to_phone;
        $amount = $request->amount;
        $description = $request->description;

        $receiveHashValue = $request->hashValue;
        $str = $to_phone.$amount;
        $hashValue = hash_hmac("sha256",$str,"magicPay");

        //check hashvalue true or false
        if($receiveHashValue !== $hashValue){
            return response()->json(['status'=>'fail','message'=>$receiveHashValue.'/',$hashValue]);
        }

        //receive user//
        $receive_user = User::where('phone',$to_phone)->first();

        //owner user//
        $Auth_user = Auth::user();

        //wallet both//
        $owner_wallet = $Auth_user->getWallet;
        $receive_user_wallet = $receive_user->getWallet;

        //check if wallet exists or not
        if(empty($owner_wallet) || empty($receive_user_wallet)){
            return response()->json(['status'=>'fail','message'=>'Receiver Wallet does not exit']);
        }
            //password has or not
            if(!empty($password)){
                if(Hash::check($password,$Auth_user->password)){
                    //start work
                    DB::beginTransaction();
                    try{


                        $owner_wallet->decrement('amount',$amount);
                        $receive_user_wallet->increment('amount',$amount);

                        $ref_id = UUIDGenerate::refId();
                        $owner_transition = new Transition();
                        $owner_transition->ref_id = $ref_id;
                        $owner_transition->trx_id= UUIDGenerate::transitionId();
                        $owner_transition->user_id= $owner_wallet->user_id;
                        $owner_transition->type = 2;
                        $owner_transition->amount = $amount;
                        $owner_transition->source_id = $receive_user_wallet->user_id;
                        $owner_transition->description = $description;
                        $owner_transition->save();

                        $receiver_transition = new Transition();
                        $receiver_transition->ref_id = $ref_id;
                        $receiver_transition->trx_id= UUIDGenerate::transitionId();
                        $receiver_transition->user_id= $receive_user_wallet->user_id;
                        $receiver_transition->type = 1;
                        $receiver_transition->amount = $amount;
                        $receiver_transition->source_id = $owner_wallet->user_id;
                        $receiver_transition->description = $description;
                        $receiver_transition->save();
                        
                        //this is notinication section transfer
                        $title = 'Payment Notification';
                        $message = 'Your are transfered '.number_format($amount,2).'Ks to '.$receive_user->name.'->'.$receive_user->phone;
                        $sourceable_id = $owner_transition->user_id;
                        $sourceable_type = Transition::class;
                        $web_link = url('transitionDetail'.'/'.$owner_transition->trx_id);
                        Notification::send([$Auth_user], new GeneralNotification($title,$message,$sourceable_id,$sourceable_type,$web_link));
                        //notiend

                        //this is notinication section receive
                        $title = 'Received Notification';
                        $message = 'Your are received '.number_format($amount,2).'Ks from '.$Auth_user->name.'->'.$Auth_user->phone;
                        $sourceable_id = $receiver_transition->user_id;
                        $sourceable_type = Transition::class;
                        $web_link = url('transitionDetail'.'/'.$receiver_transition->trx_id);
                        Notification::send([$receive_user], new GeneralNotification($title,$message,$sourceable_id,$sourceable_type,$web_link));
                        //notiend
                        DB::commit();
                        return response()->json(['status'=>'success','message'=>'Successfully Transfer','trx_id'=>$owner_transition->trx_id]);

                    }catch (\Exception $e){
                        DB::rollBack();
                        return response()->json(['status'=>'fail','message'=>$e->getMessage()]);
                    }
                }
            }



        return response()->json(['status'=>'fail','message'=>'password is incorrect']);
    }

    public function transitionShow(Request $request){
        $Auth_user = Auth::user();
        $transitions = Transition::where('user_id',$Auth_user->id)->orderBy('created_at','desc')->with('owner','fromOtherUser');
        if($request->date){

            $transitions = $transitions->whereDate('created_at',$request->date);
        }
        if($request->type ){
            $transitions = $transitions->where('type',$request->type);

        }
        $transitions=$transitions->paginate(2);
        return view('Frontend.transitionShow',compact('transitions'));
    }

    public function transitionDetail($trx_id){
        $Auth_user = Auth::user();
        $transition = Transition::where('trx_id',$trx_id)->where('user_id',$Auth_user->id)->with('owner','fromOtherUser')->first();

        return view('Frontend.transitionDetail',compact('transition'));
    }

    public function receiveQR(){
        $Auth_user = Auth::user();
        return view('Frontend.receiveQR',compact('Auth_user'));

    }

    public function paymentQR(){
        $Auth_user = Auth::user();
        return view('Frontend.paymentQR',compact('Auth_user'));

    }

    public function changeImg(Request $request){
        $request->validate([
           'photo' =>'mimes:jpeg,jpg,gif,png'
        ]);
        $photo = $request->file('photo');
        $newName = uniqid().$photo->getClientOriginalName();
        Image::make($photo)->fit(200)->save('hello/'.$newName); //that is main
        //u can u also $newImg = Imag.... , $newImg->save('path.../'.name.jpeg or png );

        Image::make($photo)->crop(500,200)->save('coverImg/'.$newName);
        //u can save multiple size like that good job!!!
        $user = Auth::user();
        $user->photo = $newName;
        $user->update();
                                                        //        $dir = "/public/profile/";
                                                    //        $newImg->save($dir.$newName);
                                                    //        Storage::putFileAs($dir,$newImg,$newName);
        $files = scandir(public_path('hello/'));
        foreach ($files as $file){
            if($file != '.' && $file != '..' && $file != $newName && $file != 'user.png'){
                File::delete(public_path('hello/'.$file));
            }
        }
        return redirect()->back()->with('toast',['icon'=>'success','title'=>'Photo Changed Success ']);
    }
}
