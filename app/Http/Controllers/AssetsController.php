<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Assets;
use Carbon\Carbon;
use App\Imports\AssetsImport;
use app\Exports\AssetsExport;
use Maatwebsite\Excel\Facades\Excel;

class AssetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:originalPatrol-list');
        $this->middleware('permission:originalPatrol-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:originalPatrol-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:originalPatrol-import', ['only' => ['import','fileImport']]);
        $this->middleware('permission:originalPatrol-prepatrol', ['only' => ['prePatrol']]);
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
        where flag="Original"
        and deleted_at is null ');
        return view('assets.index',compact('asset'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('assets.create');
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
            'serial_number' => 'required',
            'asset_old' => 'required',
            'asset_new' => 'required',
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
                'created_by' => Auth::user()->name
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
        }
        return redirect()->route('assets.index')->with(['success'=>'Data has been saved']);
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
        return view('assets.show',compact('asset'));
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
        return view('assets.edit',compact('asset'));
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
            'asset_old' => 'required',
            'asset_new' => 'required',
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
            return redirect()->route('assets.index')->with(['success' =>'Data has been updated']);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
        }
       
    }
    public function fileImport()
    {
        return view('assets.import');
    }
    public function import() 
    {
        
        DB::select('DELETE FROM assets WHERE flag="Original"');
        Excel::import(new AssetsImport,request()->file('file'));
           
        //return back();
        return redirect()->route('assets.index');
    }
    public function prePatrol()
    {
        $asset = DB::select('
        SELECT * FROM assets
        WHERE flag = "Original" AND deleted_at IS null
        AND serial_number
        NOT IN 
        (SELECT serial_number FROM assets 
        WHERE flag = "Patrol"
        AND deleted_at IS null
        AND serial_number IS not NULL) ');
        return view('assets.prepatrol',compact('asset'));
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
        return redirect()->route('assets.index')->with(['success' => 'Asset deleted successfully', 'class' => 'close']);
        
    }
}
