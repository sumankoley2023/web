<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Members;
use Illuminate\Support\Facades\DB;

class Sign_in extends Controller
{
     function index()
    {
        return view('auth-login');
    }
    function valid_check(Request $req)
    {
        //$req->mobile;
       $password = md5($req->password); 
       $Members=Members::where('user_name',$req->mobile)->where('password',$password)->where('status','yes')->get();
       $admin=DB::table('admin')->where('user_name',$req->mobile)->where('password',$password)->where('status','yes')->get();
      if (count($Members)>0)
        {
            
            $req->session()->put('mobile',$req->mobile);
            $req->session()->put('login',true);
            $req->session()->put('display_name',$Members[0]->display_name);
            $req->session()->put('members_id',$Members[0]->id);
            $req->session()->put('user_type','members');
            $req->session()->put('complete_profile',$Members[0]->complete_profile);
            // DB::table('user_admin_log')->insert(
            //  array(
            //         'login_user_id'     =>   $Members[0]->id, 
            //         'user_roll'   =>   $Members[0]->u_displayname,
            //         'activity'     =>   'login', 
            //         'date_time'     =>   date('Y-m-d H:i') 

            //      )
            //  );
            if($Members[0]->complete_profile=='yes'){
                 return redirect()->intended('dashboard');
            }else{
                return redirect()->intended('member_profile');
            }
            
        }elseif(count($admin)>0){
            $req->session()->put('mobile',$req->mobile);
            $req->session()->put('login',true);
            $req->session()->put('user_type','manager');
            $req->session()->put('display_name',$data_manager[0]->name);
            $req->session()->put('id',$data_manager[0]->id);
             // DB::table('user_admin_log')->insert(
             // array(
             //        'login_user_id'     =>   $data_manager[0]->id, 
             //        'user_roll'   =>   $data_manager[0]->name,
             //        'activity'     =>   'login', 
             //        'date_time'     =>   date('Y-m-d H:i') 

             //     )
             // );
            return redirect()->intended('dashboard');
        }else{
            $req->session()->flash('err','Invalid mobile no or password');
            return redirect()->intended('index');
        }
        
    }
    function forgot_password()
    {
        return view('forgot_password');
    }
    function valid_reg_mobile(Request $req){
        $record_exist=User::where('login_user_name',$req->mobile)->count();
        if($record_exist==null){
            $req->session()->flash('err','Mobile number not register');
            return redirect()->intended('forgot_password');
        }else{
             $mobile_otp=rand(1111,9999);
             $req->session()->put('mobile_otp',$mobile_otp);
             $req->session()->put('user_mobile',$req->mobile);
             return redirect()->intended('forgot_password_otp');
        }
    }
    function forgot_password_otp()
    {
         return view('forgot_password_otp');
       
    }
    function resend_mobile_forgot(Request $req)
    {
        $mobile_otp=rand(1111,9999);
        $req->session()->put('mobile_otp',$mobile_otp);
        $req->session()->flash('succ','Otp resend successfully');
        return redirect('forgot_password_otp');
    }
    function verify_otp_forgot(Request $req)
    {
        $m1=$req->m1;
        $m2=$req->m2;
        $m3=$req->m3;
        $m4=$req->m4;

        $user_mobile_otp=$m1.$m2.$m3.$m4;
        if(session('mobile_otp')==$user_mobile_otp){
        
        return redirect('update_password');
       }else{
        $req->session()->flash('err','Otp not matched');
        return view('forgot_password_otp');
       }
    }
    function update_password()
    {
        return view('update_password');
    }
    function update_password_forgot(Request $req)
    {
        User::where('mobile', session('user_mobile'))
       ->update([
           'password' => Hash::make($req->password)
        ]);
       $req->session()->flash('succ','Password reset successfully');
       return redirect('sign_in');
    }
    function user_profile(){
        $user= User::where('status','yes')->where('id',session('id'))->get();
        //dd($user);
        return view('user_profile',['users'=>$user]);
    }
     function update_password_user_profile(Request $req)
    {
        User::where('id', session('id'))
       ->update([
           'password' => Hash::make($req->password)
        ]);
       $req->session()->flash('succ','Password update successfully');
       return redirect('dashboard');
    }
    function logout(Request $req){
        Auth::logout();
        $req->session()->put('mobile','');
            $req->session()->put('login',false);
            $req->session()->put('display_name','');
            $req->session()->put('admin_id','');
        return redirect('/index');
    }
}
