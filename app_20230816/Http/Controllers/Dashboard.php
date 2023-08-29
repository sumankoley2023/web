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
        return view('dashboard',['member_data'=>$member_data]);
    }
    
}
