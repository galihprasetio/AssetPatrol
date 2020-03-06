<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Assets;
use App\Department;
use App\Status;
use Carbon\Carbon;
use App\Imports\AssetsImport;
use App\Exports\AssetsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Validation\Rule; 
use App\HistoryAsset;
class AssetsPatrolController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:patrol-list');
        $this->middleware('permission:patrol-create', ['only' => ['create', 'store','searchAsset']]);
        $this->middleware('permission:patrol-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:patrol-import', ['only' => ['import','fileImport']]);
        $this->middleware('permission:patrol-export', ['only' => ['export']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $asset = DB::select('
        SELECT
        id, 
        asset_old, asset_new, 
        serial_number, team, 
        location, pic, 
        label, ad_join, 
        drm, antivirus, 
        hw, power, 
        remarks
        FROM assets
        where flag="Patrol"
        and deleted_at is null ');
        return view('assetspatrol..index',compact('asset'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $team = Department::pluck('department','department');
        $status = Status::pluck('status','status');
        return view('assetspatrol.create',compact('team','status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'serial_number' => ['required',Rule::unique('assets')->where('flag','Patrol')],
            'team' => 'required',
            'location' => 'required',
            'pic' => 'required'
        ]);
        DB::beginTransaction();
        try {
            //code...
            Assets::create([
                'serial_number' => $request->serial_number,
                'asset_old' => $request->asset_old,
                'asset_new' => $request->asset_new,
                'status' => $request->status,
                'team' => $request->team,
                'location' => $request->location,
                'pic' => $request->pic,
                'label' => $request->label,
                'ad_join' => $request->ad,
                'drm' => $request->drm,
                'antivirus' => $request->antivirus,
                'hw' => $request->hw,
                'power' => $request->power,
                'remarks' => $request->remarks,
                'flag' => 'Patrol',
                'created_by' => Auth::user()->name
            ]);
            HistoryAsset::create([
                'serial_number' => $request->serial_number,
                'status' => $request->status,
                'location'=> $request->location,
                'pic' => $request->pic,
                'remark' => $request->remarks,
                'updated_by' => Auth::user()->name
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
        }
        return redirect()->route('assetspatrol.create')->with(['success'=>'Data has been saved']);
        //return $request->ad;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $asset = Assets::find($id);
        return view('assetspatrol.show',compact('asset'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 
        $asset = Assets::find($id);
        $team = Department::pluck('department','department');
        return view('assetspatrol.edit',compact('asset','team'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'serial_number' => 'required',
            
            'team' => 'required',
            'location' => 'required',
            'pic' => 'required'
        ]);
        DB::beginTransaction();
        try {
            //code...
            
            $asset = Assets::find($id);
            $asset->serial_number = $request->serial_number;
            $asset->asset_old = $request->asset_old;
            $asset->asset_new = $request->asset_new;
            $asset->status = $request->status;
            $asset->team = $request->team;
            $asset->location = $request->location;
            $asset->pic = $request->pic;
            $asset->label = $request->label;
            $asset->ad_join = $request->ad_join;
            $asset->drm = $request->drm;
            $asset->antivirus = $request->antivirus;
            $asset->hw = $request->hw;
            $asset->power = $request->power;
            $asset->remarks = $request->remarks;
            $asset->created_by = Auth::user()->name;
            $asset->save();
            DB::commit();
            return redirect()->route('assetspatrol.index')->with(['success' =>'Data has been updated']);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
        }
       
    }
    public function searchAsset(Request $request){
        $data = DB::table('assets')->where('serial_number',$request->id)->where('flag','Original')->first();
        //$data = DB::table('assets')->where('asset_tag',3)->first();
        //$asset = DB::select('select * from assets where id =3');
        return response()->json($data);
        
    }
    public function fileImport()
    {
        return view('assetspatrol.import');
    }
    public function import() 
    {
        
        DB::select('TRUNCATE ASSETS');
        Excel::import(new AssetsImport,request()->file('file'));
           
        //return back();
        return redirect()->route('assetspatrol.index');
    }
    public function export()
    {
        return Excel::download(new AssetsExport, 'assets.xlsx');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $asset = Assets::find($id);
        $asset->delete();
        return redirect()->route('assetspatrol.index')->with(['success' => 'Asset deleted successfully', 'class' => 'close']);
        
    }
}
