<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Members;

class Dashboard extends Controller
{
    function index(Request $req)
    {
         $member_data=Members::where('id',session('members_id'))->get();
         //direct_member
         $direct_member=Members::where('refer_id',session('members_id'))->count();
         //total member
         $member_id_cal=session('members_id');
         $total_count=$this->get_tree($member_id_cal,'',0);
         //dd($total_member);
         //power side
           $max_amount_array=Members::where('status','yes')->where('refer_id',$member_id_cal)->select('id','binary_b_amount')->orderBy('binary_b_amount','desc')->first();
                DB::connection()->enableQueryLog();
                //dd($max_amount_array);
                if($max_amount_array==null){
                  $ex_id='';
                  $max_amount=0;
                }
                else{
                    $max_amount=$max_amount_array->binary_b_amount;
                     $ex_id=$max_amount_array->id ;
                }
         $other_tot_sum_amount=Members::where('status','yes')->where('refer_id',$member_id_cal)->where('id','!=',$ex_id)->sum('binary_b_amount');

        
          
          
          $total_count_arr=explode('/',$total_count);
          $total_count_num=count($total_count_arr);
          //rewards
          $refer_id=Members::where('id',$member_id_cal)->select('refer_id')->get();
          $this_month_start=date('Y-m-d',strtotime('first day of this month')) ;
          $this_month_end=date('Y-m-d',strtotime('last day of this month')) ;
          $tot_amm_month=DB::table('team_business_total_amm')->where('member_id',session('members_id'))->whereBetween('date',[$this_month_start, $this_month_end])->sum("business_amount");
           $ratio_min=(round($tot_amm_month,2)*40)/100;
          $tot_amm_month=DB::table('team_business_total_amm')->where('member_id',$refer_id[0]->refer_id)->whereBetween('date',[$this_month_start, $this_month_end])->sum("business_amount");
        if($tot_amm_month>$ratio_min){
            
        }else{
            $tot_amm_month=0;
        }
          $cur_month=DB::table('rewards_monthly_master')->where('start_amm','<=',$tot_amm_month)->where('end_amm','>=',$tot_amm_month)->get();

          //dd($max_amount);
        return view('dashboard',['member_data'=>$member_data,'direct_member'=>$direct_member,'total_count'=>$total_count_num-1,'max_amount'=>$max_amount,'other_tot_sum_amount'=>$other_tot_sum_amount,'rewards'=>$cur_month[0]->reward]);
    }
     function get_tree($id,$str,$count_val){
        
         $name_dtl=Members::where('refer_id','=',$id)->select('id','display_name')->get();
         foreach ($name_dtl as $value){
            $member_id=$value->id;
            $count=Members::where('status','yes')->whereIn('id',function($query)use ($member_id)
            {
                $query->select(DB::raw('refer_id'))
                      ->from('members')
                      ->where('refer_id',$member_id);
            })->count();
            if($count>0){
               $count_val++;
                $str=$str.'/'.$value->display_name;
               
                $str=$str.$this->get_tree($value->id,'',$count_val);
                
                // 
            }else{
              $str=$str.'/'.$value->display_name;  
              $count_val++;
            }
            
        }
        return  $str;
       }
    function get_total_team($id,$str,$level,$count_val){
              $level++;
         $name_dtl=Members::where('refer_id','=',$id)->select('id','display_name','reg_date','user_name','phone','amount','level_eligibility','complete_profile','status')->get();
         foreach ($name_dtl as $value){
            $member_id=$value->id;
            $count=Members::where('status','yes')->whereIn('id',function($query)use ($member_id)
            {
                $query->select(DB::raw('refer_id'))
                      ->from('members')
                      ->where('refer_id',$member_id);
            })->count();
            
            if($count>0){
                
             
                
                 $count_val=$count_val+$this->get_total_team($value->id,'',$level,$count_val);
                
                 
                 
                // 
            }else{
                $str=$str.' <tr>';
                $count_val++;
                $str=$str.'</tr>';

            }
            // $count_val++;
        }
        return  $count_val;
       }
}
