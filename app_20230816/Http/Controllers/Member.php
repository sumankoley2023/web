<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Members;
use App\Models\Tranjaction_master;
use App\Models\Members_tranjaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class Member extends Controller
{
    function index()
    {
     
       return view('add_member');
    }
    function create_profile(Request $req){
        if($req->f_name=='')
        {
            $req->session()->flash('err','Please enter valid pan');
            return redirect('add_member');
        }
         $record_exist=Members::where('user_name',$req->mobile)->where('status','yes')->count();
        if($record_exist != 0)
        {
            $req->session()->flash('err','Phone number type already register');
            return redirect('add_member');
        }
         $record_exist_pan=Members::where('pan_no',$req->pan)->where('status','yes')->count();
        if($record_exist_pan != 0)
        {
            $req->session()->flash('err','PAN number already register');
            return redirect('add_member');
        }
         $record_exist_email=Members::where('email',$req->pan)->where('status','yes')->count();
        if($record_exist_pan != 0)
        {
            $req->session()->flash('err','Email already register');
            return redirect('add_member');
        }
        if ($req->email!=$req->c_email) {
            $req->session()->flash('err','Email and confirm email not matched');
            return redirect('add_member');
        }
        
        $user_name=date('ymdHi');
        $pass=md5('hx1234');
        $new_member_id= Members::insertGetId(
             array(
                    'user_name'     =>  $user_name, 
                    'password'     =>   $pass, 
                    'refer_id'     =>   session('members_id'), 
                    'display_name'     => $req->f_name, 
                    'phone'     =>    $req->mobile, 
                    'email'     =>   $req->email, 
                    'pan_no'     =>   $req->pan
                  )
             );
        $req->session()->put('new_member_id',$new_member_id);
        $req->session()->flash('succ','Member added successfully. User Name:'.$user_name.' and password hx1234');
        $subject="Healthx Registration Process";
        $full_email="Hello ".$req->f_name."</br> Your Account has been created Please login using credentials </br>
        User Name:$user_name </br> Password: hx1234 </br> Select the link below or copy and paste it into your browser <br>".url('');
        $this->send_email($req->email,$subject,$full_email);
        return redirect('add_member');

    }
    function valid_pan(Request $req)
    {
     $pan_no=$req->pan;
     $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://kyc-api.surepass.io/api/v1/pan/pan',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{
        "id_number": "'.$pan_no.'"
    }',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'X-Customer-Id: {{customer_id}}',
        'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJmcmVzaCI6ZmFsc2UsImlhdCI6MTY4Nzc3Mzk1NiwianRpIjoiMTdhZmYyZjItOWNhOS00YzNmLTk5ZTEtMzc1YzQyMTk2Nzk0IiwidHlwZSI6ImFjY2VzcyIsImlkZW50aXR5IjoiZGV2LmV2YXRvYXBwQHN1cmVwYXNzLmlvIiwibmJmIjoxNjg3NzczOTU2LCJleHAiOjIwMDMxMzM5NTYsInVzZXJfY2xhaW1zIjp7InNjb3BlcyI6WyJ3YWxsZXQiXX19.hl5RFDgRgNT-4ip7sC8nyjpupaVUC6OrGnVofhW3Phs'
      ),
    ));

    $response_url = curl_exec($curl);
    $response=json_decode($response_url);
    curl_close($curl);
    if($response->data->full_name!=''){
        $data['name']=$response->data->full_name;
    }else{
      $data['name']='';  
    }
     
       echo json_encode($data);
    }
    
    function insert_member(Request $req)
    {
        $record_exist=Members::where('user_name',$req->mobile)->where('status','yes')->count();
        if($record_exist != 0)
        {
            $req->session()->flash('err','Phone number type already register');
            return redirect('add_member');
        }
         $record_exist_aadhar=Members::where('gov_id_no',$req->aadhar)->where('status','yes')->count();
        if($record_exist_aadhar != 0)
        {
            $req->session()->flash('err','Aadhar number type already register');
            return redirect('add_member');
        }
        $req->session()->put('mobile',$req->mobile);
        $req->session()->put('aadhar',$req->aadhar);
        $req->session()->put('email',$req->email);
        $req->session()->put('sponsor_id',$req->sponsor_id);
        return redirect('send_otp');
    }

    function member_profile(){
        $member_data=Members::where('id',session('members_id'))->get();
        $package=Package::where('status','yes')->get();
        $address_prove=DB::table('gov_id_card')->where('status','yes')->get();
        return view('member_profile',['member_data'=>$member_data,'package'=>$package,'address_prove'=>$address_prove]);
    }
    function insert_profile_1(Request $req)
    {
        $email_otp='no';$aadhar_otp="no"; 
        $data_of_package=Package::where('id',$req->package_id)->get();
        $amount=$data_of_package[0]->p_price;
        $req->session()->put('p_price',$amount);
        $req->session()->put('package_id',$req->package_id);

        $image_name= $req->file('document')->store('document');
        $image_name_profile= $req->file('profile')->store('profile');
         $new_member_id= Members::where('id', session('members_id'))->
            Update(
             array(
                    'package_id'     =>  $req->package_id, 
                    'amount'     =>   $amount, 
                    'gov_id_card_id'     =>   $req->gov_id_card_id, 
                    'gov_id_no'     => $req->gov_id_no, 
                    'gov_upload_image_name'     =>    $image_name, 
                    'reg_date'     =>    date('Y-m-d'),
                    'upload_profile_pic_name' =>$image_name_profile
                    
                  )
             );//dd(session('members_id'));
            if(($req->email!=$req->old_email)||($req->mobile!=$req->old_mobile)){
                $email_otp=rand(1111,9999);
                $req->session()->put('email',$req->email);
                 $req->session()->put('mobile',$req->mobile);
                 $req->session()->put('email_otp',$email_otp);
                 $subject="healthx Confirmation Email";
                 $full_email="Your Email id:".$req->email." and Your Mobile no".$req->mobile."confirm to OTP Number ".$email_otp;
                 $this->send_email($req->email,$subject,$full_email);
                 $email_otp='yes';
            }

            if($req->gov_id_card_id=='1'){
                //aadhar api
                $curl = curl_init();
                curl_setopt_array($curl, array(
                  CURLOPT_URL => 'https://kyc-api.surepass.io/api/v1/aadhaar-v2/generate-otp',
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'POST',
                  CURLOPT_POSTFIELDS =>'{
                    "id_number": "'.$req->gov_id_no.'"
                }',
                  CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJmcmVzaCI6ZmFsc2UsImlhdCI6MTY4Nzc3Mzk1NiwianRpIjoiMTdhZmYyZjItOWNhOS00YzNmLTk5ZTEtMzc1YzQyMTk2Nzk0IiwidHlwZSI6ImFjY2VzcyIsImlkZW50aXR5IjoiZGV2LmV2YXRvYXBwQHN1cmVwYXNzLmlvIiwibmJmIjoxNjg3NzczOTU2LCJleHAiOjIwMDMxMzM5NTYsInVzZXJfY2xhaW1zIjp7InNjb3BlcyI6WyJ3YWxsZXQiXX19.hl5RFDgRgNT-4ip7sC8nyjpupaVUC6OrGnVofhW3Phs'
                  ),
                ));

                $response_url = curl_exec($curl);
                 $response=json_decode($response_url);
                curl_close($curl);
                if($response->data->status=='generate_otp_success'){
                $req->session()->put('client_id',$response->data->client_id);
                $aadhar_otp="yes";
             }
             else{
               $aadhar_otp="no"; 
             }
         }
            $req->session()->put('email_otp_view',$email_otp);
            $req->session()->put('aadhar_otp_view',$aadhar_otp);

             
                return redirect('enter_otp');
            

    }


    function send_otp(Request $req){
        $mobile_otp=rand(1111,9999);
        $email_otp=rand(1111,9999);
        $req->session()->put('mobile_otp',$mobile_otp);
        $req->session()->put('email_otp',$email_otp);
        //aadhar api
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://kyc-api.surepass.io/api/v1/aadhaar-v2/generate-otp',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{
            "id_number": "'.session('aadhar').'"
        }',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJmcmVzaCI6ZmFsc2UsImlhdCI6MTY4Nzc3Mzk1NiwianRpIjoiMTdhZmYyZjItOWNhOS00YzNmLTk5ZTEtMzc1YzQyMTk2Nzk0IiwidHlwZSI6ImFjY2VzcyIsImlkZW50aXR5IjoiZGV2LmV2YXRvYXBwQHN1cmVwYXNzLmlvIiwibmJmIjoxNjg3NzczOTU2LCJleHAiOjIwMDMxMzM5NTYsInVzZXJfY2xhaW1zIjp7InNjb3BlcyI6WyJ3YWxsZXQiXX19.hl5RFDgRgNT-4ip7sC8nyjpupaVUC6OrGnVofhW3Phs'
          ),
        ));

        $response_url = curl_exec($curl);
         $response=json_decode($response_url);
        curl_close($curl);
        if($response->data->status=='generate_otp_success'){
        $req->session()->put('client_id',$response->data->client_id);
        }else{
             $req->session()->flash('err','Aadhaar Number Not Linked in any Mobile Number');
             return redirect('add_member');
        }
        return redirect('enter_otp');
    }
    function enter_otp()
    {
      
       return view('otp_verified');
    }
     function verify_otp(Request $req)
    {

       if(session('email_otp_view')=='yes'){
       if(session('email_otp')!=$req->email_otp){
        
             $req->session()->flash('err','Email Otp not matched');
            return redirect('enter_otp');
           }else{
            Members::where('id', session('members_id'))->
            update(
             array(
                    'phone'     =>   session('mobile'), 
                    'email'     =>   session('email'), 
                  )
             );
           }
        }
        if(session('aadhar_otp_view')=='yes'){
       $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://kyc-api.surepass.io/api/v1/aadhaar-v2/submit-otp',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{
            "client_id": "'.session('client_id').'",
            "otp": "'.$req->aadhar_otp.'"
        }',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJmcmVzaCI6ZmFsc2UsImlhdCI6MTY4Nzc3Mzk1NiwianRpIjoiMTdhZmYyZjItOWNhOS00YzNmLTk5ZTEtMzc1YzQyMTk2Nzk0IiwidHlwZSI6ImFjY2VzcyIsImlkZW50aXR5IjoiZGV2LmV2YXRvYXBwQHN1cmVwYXNzLmlvIiwibmJmIjoxNjg3NzczOTU2LCJleHAiOjIwMDMxMzM5NTYsInVzZXJfY2xhaW1zIjp7InNjb3BlcyI6WyJ3YWxsZXQiXX19.hl5RFDgRgNT-4ip7sC8nyjpupaVUC6OrGnVofhW3Phs'
          ),
        ));

        $response_url = curl_exec($curl);
        curl_close($curl);
        $response=json_decode($response_url);
      //  dd($response->message_code);
        if($response->message_code=="success"){
            
        
        $full_name=$response->data->full_name;
        $dob=$response->data->dob;
        $gender=$response->data->gender;
        $country=$response->data->address->country;
        $dist=$response->data->address->dist;
        $state=$response->data->address->state;
        $po=$response->data->address->po;
        $vtc=$response->data->address->vtc;
        $street=$response->data->address->street;
        $house=$response->data->address->house;
        $landmark=$response->data->address->landmark;
        $zip=$response->data->zip;
       $refer_id=session('sponsor_id');
       $pass=md5('helthx1234');
       $address=$vtc.' '.$po.' '.$street.' '.$house;
       Members::where('id', session('members_id'))->update(
             array(
                    
                    'gender'     =>   $gender, 
                    'dob'     =>   $dob, 
                    'address'     =>  $address , 
                    'state'     =>   $state, 
                    'dist'     =>   $dist, 
                    'pin'     =>   $zip, 
                    'landmark'     => $landmark ,
                    'admin_approved_status'=>'yes',
                    'approved_date'=>date('Y-m-d'),
                    'approved_time'=>date('H:i'),

                    
                  )
             );
        
            }else{
            $req->session()->flash('err','Aadhar OTP not matched');
            return redirect('enter_otp');
        }
     }
     else{
        Members::where('id', session('members_id'))->update(
             array(
                    
                    'state'     =>   $req->state, 
                    'dist'     =>   $req->dist, 
                    'pin'     =>  $req->pin  
                   )
             );
     }
     return redirect('bank_kyc');
    }
    function bank_kyc(){
        return view('bank_kyc');
        
    }
    function get_bank_details(Request $req)
    {
         $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://kyc-api.surepass.io/api/v1/bank-verification/',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{
            "id_number": "'.$req->acc.'",
            "ifsc": "'.$req->ifsc.'",
            "ifsc_details": true
        }',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJmcmVzaCI6ZmFsc2UsImlhdCI6MTY4Nzc3Mzk1NiwianRpIjoiMTdhZmYyZjItOWNhOS00YzNmLTk5ZTEtMzc1YzQyMTk2Nzk0IiwidHlwZSI6ImFjY2VzcyIsImlkZW50aXR5IjoiZGV2LmV2YXRvYXBwQHN1cmVwYXNzLmlvIiwibmJmIjoxNjg3NzczOTU2LCJleHAiOjIwMDMxMzM5NTYsInVzZXJfY2xhaW1zIjp7InNjb3BlcyI6WyJ3YWxsZXQiXX19.hl5RFDgRgNT-4ip7sC8nyjpupaVUC6OrGnVofhW3Phs'
          ),
        ));

    $response = curl_exec($curl);
    $my_data=json_decode($response);
    curl_close($curl);
    if($my_data->data->account_exists=='true'){
        $data['bank_name']=$my_data->data->ifsc_details->bank;
        $data['branch']=$my_data->data->ifsc_details->branch;
        $data['bank_address']=$my_data->data->ifsc_details->address;
        $data['ifsc']=$my_data->data->ifsc_details->ifsc;
        $data['full_name']=$my_data->data->full_name;
        $data['status']='true';  

    }else{
      $data['status']='false';  
    }
     
       echo json_encode($data);
    
    }
    function verify_otp_bank(Request $req){
        // $curl = curl_init();
        // curl_setopt_array($curl, array(
        //   CURLOPT_URL => 'https://kyc-api.surepass.io/api/v1/bank-verification/',
        //   CURLOPT_RETURNTRANSFER => true,
        //   CURLOPT_ENCODING => '',
        //   CURLOPT_MAXREDIRS => 10,
        //   CURLOPT_TIMEOUT => 0,
        //   CURLOPT_FOLLOWLOCATION => true,
        //   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //   CURLOPT_CUSTOMREQUEST => 'POST',
        //   CURLOPT_POSTFIELDS =>'{
        //     "id_number": "'.$req->acc.'",
        //     "ifsc": "'.$req->ifsc.'",
        //     "ifsc_details": true
        // }',
        //   CURLOPT_HTTPHEADER => array(
        //     'Content-Type: application/json',
        //     'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJmcmVzaCI6ZmFsc2UsImlhdCI6MTY4Nzc3Mzk1NiwianRpIjoiMTdhZmYyZjItOWNhOS00YzNmLTk5ZTEtMzc1YzQyMTk2Nzk0IiwidHlwZSI6ImFjY2VzcyIsImlkZW50aXR5IjoiZGV2LmV2YXRvYXBwQHN1cmVwYXNzLmlvIiwibmJmIjoxNjg3NzczOTU2LCJleHAiOjIwMDMxMzM5NTYsInVzZXJfY2xhaW1zIjp7InNjb3BlcyI6WyJ3YWxsZXQiXX19.hl5RFDgRgNT-4ip7sC8nyjpupaVUC6OrGnVofhW3Phs'
        //   ),
        // ));

        // $response = curl_exec($curl);

        // curl_close($curl);
        // $my_data=json_decode($response);
        // //dd($my_data);
        // if($my_data->data->account_exists=='true'){
             
        //     $bank_name=$my_data->data->ifsc_details->bank;
        //     $branch=$my_data->data->ifsc_details->branch;
        //     $bank_address=$my_data->data->ifsc_details->address;
        //     $ifsc=$my_data->data->ifsc_details->ifsc;
        //     $full_name=$my_data->data->full_name;
              Members::where('id', session('members_id'))->update(
             array(
                    
                    'bank_holder_name'     =>   $req->full_name, 
                    'bank_name'     =>   $req->bank_name, 
                    'ifsc_code'     =>  $req->ifsc,  
                    'branch'     =>  $req->branch,
                    'acc_no' => $req->acc,
                    'complete_profile'=>'yes'  
                   )
             );
                $package=Package::where('status','yes')->where('id',session('package_id'))->select('p_price')->get();
             $amount=$package[0]->p_price;
             //dd($amount);
             Members::where('id',session('members_id'))->
            update(
             array(
                    'package_id'     =>   $req->package_id,
                    'cappimg_amount'=> '0',
                    'level_eligibility'=> '1'
                     
                  )
             ); 
             Tranjaction_master::insert(
                         array(
                                
                                'member_id'  => session('members_id'), 
                                'payment_type'  => 'credit', 
                                'amount'     =>   $amount, 
                                'tr_date'     => date('Y-m-d'), 
                                'tr_time'     =>  date('H:i'), 
                                'tranjaction_type' =>  'registraion', 
                                'payment_status' => 'confirm'
                              )
                         );
              $this->busness_cal();
             $req->session()->flash('succ','Profile Register complete Please login');
               return redirect('index');
        // }else{
        //     $req->session()->flash('err','Bank verification Failed');
        //     return redirect('bank_kyc');
        // }
    }
    function payment(Request $req){
       // $req->session()->put('p_price','24950');
        //$req->session()->put('package_id','4');
        return view('payment');
    }
     function payment_generate(Request $req){
        $package=Package::where('status','yes')->where('id',session('package_id'))->select('p_price')->get();
             $amount=$package[0]->p_price;
             //dd($amount);
             Members::where('id',session('members_id'))->
            update(
             array(
                    'package_id'     =>   $req->package_id,
                    'cappimg_amount'=> '0',
                    'level_eligibility'=> '1'
                     
                  )
             ); 
             Tranjaction_master::insert(
                         array(
                                
                                'member_id'  => session('members_id'), 
                                'payment_type'  => 'credit', 
                                'amount'     =>   $amount, 
                                'tr_date'     => date('Y-m-d'), 
                                'tr_time'     =>  date('H:i'), 
                                'tranjaction_type' =>  'registraion', 
                                'payment_status' => 'confirm'
                              )
                         );
              $req->session()->flash('succ','Profile Register complete Please login');
               return redirect('index');
        
    }
    function busness_cal(){
        $member_id_cal=session('members_id');
        $tranjaction_master_id='0';
        $member_dtl=Members::where('id',$member_id_cal)->get();
        $refer_id=$member_dtl[0]->refer_id;
        $package_id=$member_dtl[0]->package_id;
        $amount=$member_dtl[0]->amount;
        $display_name=$member_dtl[0]->display_name;
        $ref_package_id=Members::where('id',$refer_id)->select('package_id')->get();
        $package_dtl=Package::where('id',$ref_package_id[0]->package_id)->select('direct_com')->get();
       // dd($ref_package_id);
        $direct_com_per=$package_dtl[0]->direct_com;
        $gst_amm=$amount-($amount*(100/(100+18)));
        $act_amount=round($amount-$gst_amm,2);
        //direct commision start
        $direct_comm_amount=round((($act_amount*$direct_com_per)/100),2);
        $refer_member_dtl=Members::where('id',$refer_id)->get();
        $pre_direct_amount=$refer_member_dtl[0]->direct;
        $pre_steady_amount=$refer_member_dtl[0]->steady;

        $pre_tot_earning=$refer_member_dtl[0]->tot_earning;
        $pre_wallet_bal=$refer_member_dtl[0]->wallet_bal;
        $pre_bv_amount=$refer_member_dtl[0]->business_amount;
        $direct_join_count=Members::where('refer_id',$refer_id)->count();
       // dd($direct_join_count);
        
        $bv_percentage=DB::table('bv_category_master')->where('status','yes')->where('our_tag','Package')->select('percentage','id')->get();
        $bv_amount=round((($act_amount*$bv_percentage[0]->percentage)/100),2);
        //dd($bv_amount);
        //echo "BV=".$bv_amount."<br>";
        //goto a;
        Members::where('id', $refer_id)->where('level_eligibility','1')->update(array('direct' => $direct_comm_amount+$pre_direct_amount,'tot_earning'=>$pre_tot_earning+$direct_comm_amount,'wallet_bal'=>$pre_wallet_bal+$direct_comm_amount,'business_amount'=>$bv_amount+$pre_bv_amount));
        Members_tranjaction::insert(
             array(
                    'tranjaction_master_id' =>  $tranjaction_master_id, 
                    'member_id'     =>   $refer_id, 
                    'member_for_refer'     => $member_id_cal, 
                    'amount'     =>   $direct_comm_amount, 
                    'tr_date'     => date('Y-m-d'), 
                    'tr_time'     =>  date('H:i'), 
                    'remarks'     =>   'For '.$display_name, 
                    'tranjaction_type_master_id' => '1'
                  )
             );
        //echo $direct_comm_amount+$pre_direct_amount;
       // dd($act_amount);
        //end direct commision
        //start executive income
        DB::connection()->enableQueryLog();
    
        $member_dtl_array=Members::where('status','yes')->where('business_amount','>=','10000000')->select('business_amount','id','refer_id_input','executive','tot_earning','wallet_bal')->get();
        $queries = DB::getQueryLog();
        //dd($queries);
        //dd($member_dtl_array);
        foreach ($member_dtl_array as  $value) {
            $member_count_amm=Members::where('status','yes')->where('refer_id',$value->id)->select('business_amount','id','refer_id_input')->where('business_amount','>=','400000')->count();
           // dd($member_count_amm);
            if($member_count_amm>0){
                $executive_amm=($value->business_amount*2)/100;
                $old_executive=$value->executive;
                $tot_earning=$value->tot_earning;
                $pre_wallet_bal=$value->wallet_bal;
                $tot_business_amount=$value->tot_business_amount;
                $business_amount=$value->business_amount;
                Members::where('id', $value->id)->where('level_eligibility','1')->update(array('executive' => $old_executive+$executive_amm,'tot_earning'=> $tot_earning+$executive_amm,'wallet_bal'=> $pre_wallet_bal+$executive_amm,'business_amount'=>'0','tot_business_amount'=>$business_amount+$tot_business_amount));

            Members_tranjaction::insert(
             array(
                    'tranjaction_master_id' =>  $tranjaction_master_id, 
                    'member_id'     =>   $value->id, 
                    'member_for_refer'     => '', 
                    'amount'     =>   $executive_amm, 
                    'tr_date'     => date('Y-m-d'), 
                    'tr_time'     =>  date('H:i'), 
                    'remarks'     =>   'For '.$display_name, 
                    'tranjaction_type_master_id' => '2'
                  )
             );
            }
        }
        //end executive income
        //steady Income start
        
        $id=$refer_id;
        //$id=7;
        $level=1;//start value
        $available_level=DB::table('steady_income_master')->where('status','yes')->where('performance','=',$direct_join_count)->select('eligibility')->orderBy('id', 'DESC')->first();
        $available_level_round=round($available_level->eligibility,0);
        while ($id !='1' && $level<=$available_level_round) {
            $id=$this->get_return_pre_refer($id);
        $steady_income_master=DB::table('steady_income_master')->where('status','yes')->where('eligibility','=',$level)->get();
        $steady_income_master_percentage=$steady_income_master[0]->earning_p;
        $steady_credit_amount=round(($bv_amount*$steady_income_master_percentage)/100,2);
            //echo "Id ".$id;
            //echo " Level ".$level++ ;
            //echo " Comission ".$steady_income_master_percentage."%";
            //echo " Amount ".$steady_credit_amount ."</br>";
            $member_dtl_steady=Members::where('status','yes')->where('id', $id)->select('tot_earning','wallet_bal')->get();
            $cur_tot_earning=$member_dtl_steady[0]->tot_earning;
            $pre_wallet_bal=$member_dtl_steady[0]->wallet_bal;
            Members::where('id', $id)->where('level_eligibility','1')->update(array('steady' => $steady_credit_amount+$pre_steady_amount,'tot_earning'=>$cur_tot_earning+$steady_credit_amount,'wallet_bal'=>$steady_credit_amount+$pre_wallet_bal));
        Members_tranjaction::insert(
             array(
                    'tranjaction_master_id' =>  $tranjaction_master_id, 
                    'member_id'     =>   $id, 
                    'member_for_refer'     => $member_id_cal, 
                    'amount'     =>   $steady_credit_amount, 
                    'tr_date'     => date('Y-m-d'), 
                    'tr_time'     =>  date('H:i'), 
                    'remarks'     =>   'For '.$display_name, 
                    'tranjaction_type_master_id' => '3'
                  )
             );

        }
        //steady Income end
        //a:
        
        return 1;
        
    }
    //Binary Income Start
    function binary_cor_jobs(){
        $tranjaction_master_id=0;
        $member_dtl_array=Members::where('status','yes')->where('status','yes')->get();
        $left_cf_amount=0;
        $right_cf_amount=0;
        foreach ($member_dtl_array as  $value) {
            echo "Id ".$value->id."<br>";
            $member_id=$value->id;
            $wallet_bal=$value->wallet_bal;
            $binary_bal=$value->binary_bal;
            $binary_b_amount=$value->binary_b_amount;
            $cf_left=$value->cf_left;
            $cf_right=$value->cf_right;
            $cur_tot_earning=$value->cur_tot_earning;
            $cappimg_amount=$value->cappimg_amount;
            //check 2:1 
            //dd($member_id);
            $count2=Members::where('status','yes')->whereIn('id',function($query)use ($member_id)
            {
                $query->select(DB::raw('refer_id'))
                      ->from('members')
                      ->where('refer_id',$member_id);
            })->count();
            $count1=Members::where('status','yes')->where('refer_id',$member_id)->count();
           
            if($count2>=1 && $count1>=2){
                $max_amount=Members::where('status','yes')->where('refer_id',$member_id)->max('binary_b_amount');
                $other_tot_sum_amount=Members::where('status','yes')->where('refer_id',$member_id)->where('binary_b_amount','!=',$max_amount)->sum('binary_b_amount');
                $max_amount=$max_amount+$cf_left;
                $other_tot_sum_amount=$other_tot_sum_amount+$cf_right;
                if($max_amount>$other_tot_sum_amount){
                    $credit_amm=($other_tot_sum_amount*6)/100;
                   $left_cf_amount=$max_amount-$other_tot_sum_amount; 
                }else{
                    $credit_amm=($max_amount*6)/100;
                   $right_cf_amount=$other_tot_sum_amount-$max_amount; 
                }
                
                  Members::where('id', $member_id)->where('level_eligibility','1')->update(array('binary_bal' => $binary_bal+$credit_amm,'tot_earning'=>$cur_tot_earning+$credit_amm,'cf_left'=>$left_cf_amount,'cf_right'=>$right_cf_amount));
                  Members::where('refer_id', $member_id)->where('level_eligibility','1')->update(array('binary_b_amount'=>'0'));
                    Members_tranjaction::insert(
                         array(
                                'tranjaction_master_id' =>  $tranjaction_master_id, 
                                'member_id'     =>   $member_id, 
                                'member_for_refer'     =>'', 
                                'amount'     =>   $credit_amm, 
                                'tr_date'     => date('Y-m-d'), 
                                'tr_time'     =>  date('H:i'), 
                                'remarks'     =>   ' ', 
                                'tranjaction_type_master_id' => '4'
                              )
                         );
                
            }
        echo " left cf amount ".$left_cf_amount;
        echo " Right cf amount ".$right_cf_amount;
        echo " Binary amount ".$credit_amm;
        //add cappimg 
        $package_id=$value->package_id;
        $package_dtl=Package::where('id',$package_id)->select('p_price')->get();
        $p_price=0;
        if(isset($package_dtl[0]->p_price)){
           $p_price=$package_dtl[0]->p_price; 
        }
        
        //dd($p_price);
        $amount=$p_price;
        //$direct_com_per=$package_dtl[0]->direct_com;
        $gst_amm=$amount-($amount*(100/(100+18)));
        $act_amount=round($amount-$gst_amm,2);
        $act_amount_10_time=$act_amount*10;
        if($cappimg_amount>$act_amount_10_time){
          Members::where('id', $member_id)->update(array('cappimg_amount' => '0','level_eligibility'=>'0'));  
        }
                
            
        }
    }//DB::table('members')->where('refer_id','6')->select('id')->get())
    function get_return_pre_refer($id){
        $member_dtl_all_for_steady=Members::where('status','yes')->where('id','=',$id)->select('refer_id')->get();
        if(!empty($member_dtl_all_for_steady[0]->refer_id)){
          return($member_dtl_all_for_steady[0]->refer_id);  
      }else{
        return '1';
      }
        

    }

    function get_tree($id,$str){
        
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
               // 
                $str=$str.'<li><span class="caret">'.$value->display_name.'</span>';
                $str=$str.' <ul class="nested">';
                $str=$str.$this->get_tree($value->id,'');
                $str=$str.'</ul>';
                 $str=$str.'</li>';
                // 
            }else{
              $str=$str.'<li>'.$value->display_name.'</li>';  
            }
            
        }
        return  $str;
       }
    function tree(){
        $member_id_cal=session('members_id');
        $str=$this->get_tree($member_id_cal,'');


        return view('tree',['str'=>$str]);
    }
     function total_team(){
        $member_id_cal=session('members_id');
        $str=$this->get_total_team($member_id_cal,'',$level=0);


        return view('total_team',['str'=>$str]);
    }
    function get_total_team($id,$str,$level){
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
            if($value->level_eligibility=='1' && $value->complete_profile=='yes' && $value->status=='yes'){
                    $status="Active";
                }else{
                    $status="Deactive";
                }
            if($count>0){
                $str=$str.' <tr>';
                $str=$str.'<td>'.$value->reg_date.'</td>';
                $str=$str.'<td>'.$value->user_name.'</td>';
                $str=$str.'<td>'.$value->display_name.'</td>';
                $str=$str.'<td>'.$value->phone.'</td>';
                $str=$str.'<td>'.$level.' Level</td>';
                $str=$str.'<td>'.$value->amount.'</td>';
                $str=$str.'<td>'.$status.'</td>';
                
                $str=$str.$this->get_total_team($value->id,'',$level);
                
                 $str=$str.'</td>';
                 $str=$str.'</tr>';
                // 
            }else{
                $str=$str.' <tr>';
                $str=$str.'<td>'.$value->reg_date.'</td>';
                $str=$str.'<td>'.$value->user_name.'</td>';
                $str=$str.'<td>'.$value->display_name.'</td>';  
                $str=$str.'<td>'.$value->phone.'</td>';
                $str=$str.'<td>'.$level.' Level</td>';
                $str=$str.'<td>'.$value->amount.'</td>';
                $str=$str.'<td>'.$status.'</td>';
                $str=$str.'</tr>';

            }
            
        }
        return  $str;
       }
       function direct_team(){
        $str='';
        $member_id_cal=session('members_id');
        $name_dtl=Members::where('refer_id','=',$member_id_cal)->select('id','display_name','reg_date','user_name','phone','amount','level_eligibility','complete_profile','status')->get();
            foreach ($name_dtl as $value){
                $str=$str.' <tr>';
                $str=$str.'<td>'.$value->reg_date.'</td>';
                $str=$str.'<td>'.$value->user_name.'</td>';
                $str=$str.'<td>'.$value->display_name.'</td>';  
                $str=$str.'<td>'.$value->phone.'</td>';
                
                $str=$str.'<td>'.$value->amount.'</td>';
                
                $str=$str.'</tr>';
            }

        return view('direct_team',['str'=>$str]);
    }
    function direct_income(){
        $str='';
        $i=1;
        $member_id_cal=session('members_id');
        $name_dtl=DB::table('members_tranjaction')->where('member_id','=',$member_id_cal)->where('tranjaction_type_master_id','1')->get();
       // dd($name_dtl);
            foreach ($name_dtl as $value){
                $str=$str.'<tr>';
                $str=$str.'<td>'.$i++.'</td>';
                $str=$str.'<td>'.$value->tr_date.'</td>';
                $str=$str.'<td>'.$value->amount.'</td>';
                $str=$str.'<td>'.$value->remarks.'</td>';  
                $str=$str.'</tr>';
            }

        return view('direct_income',['str'=>$str]);
    }
    function executive_income(){
        $str='';
        $i=1;
        $member_id_cal=session('members_id');
        $name_dtl=DB::table('members_tranjaction')->where('member_id','=',$member_id_cal)->where('tranjaction_type_master_id','2')->get();
       // dd($name_dtl);
            foreach ($name_dtl as $value){
                $str=$str.'<tr>';
                $str=$str.'<td>'.$i++.'</td>';
                $str=$str.'<td>'.$value->tr_date.'</td>';
                $str=$str.'<td>'.$value->amount.'</td>';
                $str=$str.'<td>'.$value->remarks.'</td>';  
                $str=$str.'</tr>';
            }

        return view('executive_income',['str'=>$str]);
    }
    function steady_income(){
        $str='';
        $i=1;
        $member_id_cal=session('members_id');
        $name_dtl=DB::table('members_tranjaction')->where('member_id','=',$member_id_cal)->where('tranjaction_type_master_id','3')->get();
       // dd($name_dtl);
            foreach ($name_dtl as $value){
                $str=$str.'<tr>';
                $str=$str.'<td>'.$i++.'</td>';
                $str=$str.'<td>'.$value->tr_date.'</td>';
                $str=$str.'<td>'.$value->amount.'</td>';
                $str=$str.'<td>'.$value->remarks.'</td>';  
                $str=$str.'</tr>';
            }

        return view('steady_income',['str'=>$str]);
    }
    function binary_income(){
        $str='';
        $i=1;
        $member_id_cal=session('members_id');
        $name_dtl=DB::table('members_tranjaction')->where('member_id','=',$member_id_cal)->where('tranjaction_type_master_id','4')->get();
       // dd($name_dtl);
            foreach ($name_dtl as $value){
                $str=$str.'<tr>';
                $str=$str.'<td>'.$i++.'</td>';
                $str=$str.'<td>'.$value->tr_date.'</td>';
                $str=$str.'<td>'.$value->amount.'</td>';
                $str=$str.'<td>'.$value->remarks.'</td>';  
                $str=$str.'</tr>';
            }

        return view('binary_income',['str'=>$str]);
    }
    function withdrawal(){
        $str='';
        $i=1;
        $member_id_cal=session('members_id');
        $name_dtl=Tranjaction_master::where('member_id','=',$member_id_cal)->where('payment_type','debit')->get();
       // dd($name_dtl);
            foreach ($name_dtl as $value){
                $str=$str.'<tr>';
                $str=$str.'<td>'.$i++.'</td>';
                $str=$str.'<td>'.$value->tr_date.'</td>';
                $str=$str.'<td>'.$value->amount.'</td>';
                $str=$str.'<td>'.ucfirst($value->tranjaction_type).'</td>';  
                $str=$str.'<td>'.ucfirst($value->payment_status).'</td>';  
                $str=$str.'</tr>';
            }

        return view('withdrawal',['str'=>$str]);
    }
    function my_wallet(){
        $str='';
        $i=1;
        $member_id_cal=session('members_id');
        $name_dtl=Tranjaction_master::where('member_id','=',$member_id_cal)->where('payment_type','credit')->get();
       // dd($name_dtl);
            foreach ($name_dtl as $value){
                $str=$str.'<tr>';
                $str=$str.'<td>'.$i++.'</td>';
                $str=$str.'<td>'.$value->tr_date.'</td>';
                $str=$str.'<td>'.$value->amount.'</td>';
                $str=$str.'<td>'.ucfirst($value->tranjaction_type).'</td>';  
                $str=$str.'<td>'.ucfirst($value->payment_status).'</td>';  
                $str=$str.'</tr>';
            }

        return view('my_wallet',['str'=>$str]);
    }
    function req_withdrawal(Request $req){
        $amm=DB::table('withdrawal_condition')->where('status','=','yes')->select('min_wallet_bal','min_withdrawal_bal')->get();
        $bal=DB::table('members')->where('status','=','yes')->select('wallet_bal','level_eligibility')->get();  
        if($amm[0]->min_withdrawal_bal>$req->amount){
          $req->session()->flash('err','Please enter valid amount');
        return redirect('withdrawal');  
        }
        $cur_bal=$bal[0]->wallet_bal-$req->amount;
        if($amm[0]->min_wallet_bal>($cur_bal)){
          $req->session()->flash('err','Please enter valid amount');
        return redirect('withdrawal');  
        }
        if($bal[0]->wallet_bal<($req->amount)){
          $req->session()->flash('err','Please enter valid amount');
        return redirect('withdrawal');  
        }
        //dd($req->amount);

        $member_id=session('members_id');
         Members::where('id', $member_id)->where('status','yes')->update(array('wallet_bal'=>$cur_bal));
                    Tranjaction_master::insert(
                         array(
                                
                                'member_id'     =>   $member_id, 
                                'payment_type'     =>'debit', 
                                'amount'     =>   $req->amount, 
                                'tr_date'     => date('Y-m-d'), 
                                'tr_time'     =>  date('H:i'), 
                                'tranjaction_type'     =>   'withdroll', 
                                'payment_status' => 'pending'
                              )
                         );
         $req->session()->flash('succ','Withdrawal Request Save Successfully');
        return redirect('withdrawal');  
    }
    function resend_mobile(Request $req){
         $mobile_otp=rand(1111,9999);
         $req->session()->put('mobile_otp',$mobile_otp);
         $req->session()->flash('succ','Mobile OTP Resend Successfully');
        return redirect('enter_otp');
    }
     function resend_email(Request $req){
        
        $email_otp=rand(1111,9999);
        
        $req->session()->put('email_otp',$email_otp);
        $req->session()->flash('succ','Email OTP Resend Successfully');
        return redirect('enter_otp');
    }
    function refer_member()
    {
        $eid=session('members_id');
        $encrypted = Crypt::encryptString($eid);
       return view('refer_member',['encrypted'=>$encrypted]);
    }
    function join(Request $req){
        $encrypted =$req->id;
        return view('join_member',['encrypted'=>$encrypted]);
    }
    function join_profile(Request $req){
        if($req->f_name=='')
        {
            $req->session()->flash('err','Please enter valid pan');
            return redirect('join/'.$req->token);
        }
         $record_exist=Members::where('user_name',$req->mobile)->where('status','yes')->count();
        if($record_exist != 0)
        {
            $req->session()->flash('err','Phone number type already register');
            return redirect('join/'.$req->token);
        }
         $record_exist_pan=Members::where('pan_no',$req->pan)->where('status','yes')->count();
        if($record_exist_pan != 0)
        {
            $req->session()->flash('err','PAN number already register');
           return redirect('join/'.$req->token);

        }
         $record_exist_email=Members::where('email',$req->pan)->where('status','yes')->count();
        if($record_exist_pan != 0)
        {
            $req->session()->flash('err','Email already register');
          return redirect('join/'.$req->token);

        }
        if ($req->email!=$req->c_email) {
            $req->session()->flash('err','Email and confirm email not matched');
            return redirect('join/'.$req->token);
        }
        
        $user_name=date('ymdHi');
        $pass=md5('hx1234');
        $decrypted = Crypt::decryptString($req->token);
        $new_member_id= Members::insertGetId(
             array(
                    'user_name'     =>  $user_name, 
                    'password'     =>   $pass, 
                    'refer_id'     =>   $decrypted, 
                    'display_name'     => $req->f_name, 
                    'phone'     =>    $req->mobile, 
                    'email'     =>   $req->email, 
                    'pan_no'     =>   $req->pan
                  )
             );
        $req->session()->put('new_member_id',$new_member_id);
        $req->session()->flash('succ','You have successfully register.Please login here.Your user name:'.$user_name.' and password: hx1234');
        $subject="healthx Registration Process";
        $full_email="Member added successfully. User Name:'.$user_name.' and password hx1234.";
        $this->send_email($req->email,$subject,$full_email);
        return redirect('');

    }
    function my_profile(){

        $member_data=Members::where('id',session('members_id'))->get();
        return view('my_profile',['member_data'=>$member_data]);
    }
    function change_password(){
        return view('change_password');
    }
    function update_change_password(Request $req){
        $old_password=md5($req->old);
        $member_data=Members::where('id',session('members_id'))->where('password',$old_password)->count();
        if($member_data>0)
        {
            if($req->new_password==$req->confirm_password){
            $enc_pass=md5($req->new_password);
            $new_member_id= Members::where('id', session('members_id'))->
            Update(
             array(
                    'password'     =>  $enc_pass  
                    
                    
                  )
             );
            $req->session()->flash('succ','Password changed successfully');
                return redirect('change_password');  
            }else{
              $req->session()->flash('err','Password and confirm password not matched');
                return redirect('change_password');  
            }
        }else{
            $req->session()->flash('err','Old password not matched');
             return redirect('change_password');
        }
    }
     function change_profile(Request $req){
        $member_data=Members::where('id',session('members_id'))->get();
        if($member_data[0]->phone==$req->mobile && $member_data[0]->email==$req->email){
          $req->session()->flash('err','Mobile number and email are same');
                return redirect('my_profile');   
        }
        $email_otp=rand(1111,9999);
        $subject="healthx Confirmation Email";
        $full_email="Your Email id:".$req->email." and Your Mobile no".$req->mobile."confirm to OTP Number ".$email_otp;
        $this->send_email($req->email,$subject,$full_email);
        $req->session()->put('email_otp',$email_otp);
        $req->session()->put('email',$req->email);
        $req->session()->put('mobile',$req->mobile);
        $req->session()->flash('succ','Email OTP Send Successfully');
        return view('enter_otp');

     }
     function verify_email_otp_profile(Request $req)
    {

       
       if(session('email_otp')!=$req->email_otp){
        
             $req->session()->flash('err','Email Otp not matched');
            return redirect('change_profile');
           }else{
            Members::where('id', session('members_id'))->
            update(
             array(
                    'phone'     =>   session('mobile'), 
                    'email'     =>   session('email'), 
                  )
             );
            $req->session()->flash('succ','Profile update Successfully');
            return redirect('my_profile');
           }
        }
         function update_package()
        {
             $package=Package::where('status','yes')->get();
            $member_data=Members::where('id',session('members_id'))->get();
             return view('update_package',['member_data'=>$member_data,'package'=>$package]);
        }
        function insert_update_package(Request $req)
        {
                //dd($req->package_id);
            if($req->cur_package>$req->package_id){
                $req->session()->flash('err','Please Select valid package');
                return redirect('update_package');

            }
             $package=Package::where('status','yes')->where('id',$req->package_id)->select('p_price')->get();
             $amount=$package[0]->p_price;
             //dd($amount);
             Members::where('id',session('members_id'))->
            update(
             array(
                    'package_id'     =>   $req->package_id,
                    'cappimg_amount'=> '0',
                    'level_eligibility'=> '1'
                     
                  )
             ); 
             Tranjaction_master::insert(
                         array(
                                
                                'member_id'  => session('members_id'), 
                                'payment_type'  => 'credit', 
                                'amount'     =>   $amount, 
                                'tr_date'     => date('Y-m-d'), 
                                'tr_time'     =>  date('H:i'), 
                                'tranjaction_type' =>  'renewal', 
                                'payment_status' => 'confirm'
                              )
                         );
            $req->session()->flash('succ','Package update successfully');
            return redirect('update_package');

        }
     function send_email($to,$subject,$message){
        $full_email = '<!DOCTYPE html>
                        <html lang="en">
                          <head>
                            <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400;700&display=swap" rel="stylesheet">
                          </head>
                          <body style="margin:0;">
                            <table style="width:100%;font-family:'." 'Roboto Condensed'".', sans-serif;">
                              <thead style="background:#f2e099;padding:20px 10px;display: block;border: 1px solid #cccccc;">
                                <tr>
                                  <td>
                                    <div style="display:flex;align-items:center;">
                                      
                                      <a href="#" style="display:flex;justify-content:flex-start;align-items:center;text-decoration:none;">
                                        <img src="'.url('').'/public/assets/images/healthx logo.png" alt="" style="height:50px;margin-right:5px">
                                        <h1 style="color:#086c36;margin:0;text-transform:uppercase;text-decoration:none;margin-left:5px;">HealthX</h1>
                                      </a>
                                    </div>
                                  </td>
                                </tr>
                              </thead>
                              <tbody style="padding:20px;display:block;border: 1px solid #cccccc;background: #ffffff;">
                              <tr><td>'.$message.'</td></tr></tbody>
                              <tfoot style="display: inline-block;width: 100%;font-size:14px;">
                                <tr style="display:flex;width:100%;background: #f9c303;padding: 1px 0;"><td></td></tr>
                                <tr style="display:flex;width:100%;background: #086c37;padding: 3px 0;margin-bottom:10px;"><td></td></tr>
                                <tr>
                                  <td style="margin:10px 0 5px;display:block;padding:0 30px;">
                                    <p style="margin:0 0 5px;font-weight:bold;">Sincerely </br> HealthX</p>
                                    <p style="margin:0 0 5px;color:#086c36;font-weight:bold;">If you have a question, write usa message at <b>support@healthx.world</b></p>
                                 
                                  </td>
                                </tr>
                              </tfoot>
                            </table>
                          </body>
                        </html>';
                       // dd($full_email);
    //   $subject = "Email OTP Verification";
    //   $headers = "MIME-Version: 1.0" . "\r\n";
    //   $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    //   // More headers
    //   $headers .= 'From: <self@helthx.app>' . "\r\n";
      

    //   $re=mail($to,$subject,$full_email,$headers);
    //   require_once "smtp/PHPMailer.php";
    //   require_once "smtp/SMTP.php";
    //   require_once 'controllers/smtp/PHPMailer.php';
    //   require_once 'smtp/SMTP.php';
      require(app_path() . '/Http/functions/smtp/PHPMailer.php');
      require(app_path() . '/Http/functions/smtp/SMTP.php');
      $mail = new \PHPMailer(); 
  $mail->SMTPDebug = 0;
  $mail->IsSMTP();     
  $mail->Mailer   = "smtp";
  $mail->SMTPAuth = true;
  $mail->Username = "support@healthx.world";
  $mail->Password = "Lm0bab081";
  $mail->Host     = "smtp.healthx.world";
  $mail->SMTPSecure = "ssl";
  $mail->Port     = 465;  // For ssl
  $mail->SetFrom("support@healthx.world", "HelthX");
  $mail->AddReplyTo("support@healthx.world", "PHPPot");
  $mail->AddAddress($to);
  $mail->Subject = $subject;
  $mail->WordWrap   = 80;
  $mail->MsgHTML($full_email);
  $mail->IsHTML(true);
  $mail->send();
  
     
         }
}
