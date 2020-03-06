<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $originalAsset = collect(DB::select('select count(*)as total from assets where flag ="Original" and deleted_at is null '))->first()->total;
        $prePatrolAsset = collect(DB::select('SELECT COUNT(serial_number)as total FROM assets
        WHERE flag = "Original" AND deleted_at IS null
        AND serial_number
        NOT IN 
        (SELECT serial_number FROM assets 
        WHERE flag = "Patrol"
        AND deleted_at IS null
        AND serial_number IS not NULL)'))->first()->total;
        $patrolAsset = collect(DB::select('select count(*)as total from assets where flag= "Patrol" and deleted_at is null'))->first()->total;
        return view('admin.dashboard',compact('originalAsset','patrolAsset','prePatrolAsset'));
    }
}
