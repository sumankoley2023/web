<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Package;

class Master_controller extends Controller
{
    
    
    function package_master()
    {
      $package_master= Package::orderBy('id', 'DESC')->get();
       return view('package_master',['package_master'=>$package_master]);
    }
    function insert_package_master(Request $req)
    {
        $record_exist=Package::where('p_type',$req->p_type)->where('status','yes')->count();
        if($record_exist != 0)
        {
            $req->session()->flash('err','Package type already register');
            return redirect('package_master');
        }
        
       $resp= Package::insert([
           'p_type' => $req->p_type,
           'p_price' => $req->p_price,
           'product_value' => $req->product_value,
           'direct_com' => $req->direct_com,
           'coverage' => $req->coverage,
           'wallet_amount' => $req->wallet_amount,
           'discount' => $req->discount
           
           
         ]);
       if($resp){
         $req->session()->flash('succ','Data saved successfully');
      }else{
          $req->session()->flash('err','Data not saved');
      }
        
           return redirect('package_master');
    }
    function del_package_master(Request $req)
    {
      //dd($req->id);
     $resp= Package::where('id', $req->id)->delete();
       if($resp){
         $req->session()->flash('succ','Data deleted successfully');
      }else{
          $req->session()->flash('err','Data not deleted');
      }
        
           return redirect('package_master');
    }
    function status_package_master(Request $req)
    {
      //dd($req->id);
     $resp= DB::table('owner_master')->where('id', $req->id)->update([
           'status' => $req->status
        ]);
       if($resp){
         $req->session()->flash('succ','Status changed successfully');
      }else{
          $req->session()->flash('err','Status not changed');
      }
        
           return redirect('owner_master');
    }
     

}
