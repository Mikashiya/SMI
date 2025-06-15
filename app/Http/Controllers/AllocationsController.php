<?php

namespace App\Http\Controllers;

use App\Models\allocations;
use App\Models\warehouses;
use App\Models\spareparts;
use App\Models\stockmovements;
use App\Models\suppliers;
use App\Models\wh_locs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;


use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class AllocationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    //public function index()
    //{
    //    $allocations = allocations::with(['spareparts', 'warehouses'])->get();
    //    return view('leader.listspareparts', compact('allocations'));
    //}

    public function index(Request $request)
    {
        $plantId = wh_locs::where('id_whlocs', $request->query('id_whlocs'))->value('id_whlocs');

        if(!$plantId || $plantId == 'all'){
            $allocations = allocations::with('spareparts', 'warehouses')->get();
        }
        else{
            $allocations = allocations::with('spareparts')->whereHas('warehouses', function ($q) use ($plantId) {
                $q->where('id_whlocs', $plantId);
            })->get();
        }

        
        



        //dd($warehouses);
        //dd($request->all());

        $plants = wh_locs::all();

        $allocations = collect($allocations);

        return view('leader.listspareparts', compact('allocations', 'plants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $choices = warehouses::select(DB::raw("CONCAT(wh_type, ' - ', (SELECT location FROM whlocs WHERE whlocs.id_whlocs = warehouses.id_whlocs)) AS wh_display"), 'id_wh')->get()->pluck('wh_display', 'id_wh');

        $spl = suppliers::get()->pluck('spl_name', 'id_spl');
        return view('leader.registparts', compact('choices', 'spl'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate
        $request->validate([
            'part_id'=>'required|max:9|min:9',
            'part_name'=>'required',
            'part_type'=>'required',
            'mfg'=>'required',
            'date_in'=>'required',
            'pic_wh'=>'required',
            'pic_order'=>'required',
            'spl'=>'required',
            'usage'=>'required',
            'loc'=>'required',
            'price'=>'required|numeric',
            'f_stock'=>'required|numeric',
            's_stock'=>'required|numeric'
        ], [
            'part_id.required' => 'Part ID must be filled',
            'part_id.max' => 'Part ID must not exceed 9 letters',
            'part_id.min' => 'Part ID must not below 9 letters',
            'part_name.required' => 'Part Name must be filled',
            'part_type.required' => 'Part Type must be filled',
            'mfg.required' => 'Part Manufacture must be filled',
            'date_in.required' => 'Part Inbound Date must be filled',
            'pic_wh.required' => 'PIC Warehouse Name must be filled',
            'pic_order.required' => 'PIC Order Name must be filled',
            'spl.required' => 'Supplier Name must be filled',
            'usage.required' => 'Part Usage must be filled',
            'loc.required' => 'Warehouse Location must be filled',
            'price.required' => 'Part Price must be filled',
            'f_stock.required' => 'Part Inbound Stock must be filled',
            's_stock.required' => 'Part Safety Stock must be filled',
            'price.numeric' => 'Part Price must be numeric',
            'f_stock.numeric' => 'Part Inbound Stock must be numeric',
            's_stock.numeric' => 'Part Safety Stock must be numeric',
        ]);

        DB::beginTransaction();
        try{

            $supplier = suppliers::where('id_spl', $request->spl)->first();
            //Sparepart
            $spareparts = spareparts::create([
                'part_name'=>$request->part_name,
                'part_type'=>$request->part_type,
                'mfg'=>$request->mfg,
                'price'=>$request->price,
                'id_spl'=>$supplier->id_spl
            ]);
            
            //dd('Debug setelah sparepart:', $spareparts);

            
    
            DB::commit();

        } 
        catch (\Exception $e) {
            DB::rollBack(); // Batalkan semua perubahan jika ada error
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        if (allocations::where('id_alct', $request->part_id)->exists()) {
            return redirect()->back()->with('error', 'ID Part already exist');
        }

        $warehouses = warehouses::where('id_wh', $request->loc)->first();
        //Allocation
        $allocations = allocations::create([
            'id_alct'=>$request->part_id,
            'f_stock'=>$request->f_stock,
            'e_stock'=>$request->f_stock,
            's_stock'=>$request->s_stock,
            'id_wh'=>$warehouses->id_wh,
            'id_part'=>$spareparts->id_part,
            'note'=>$request->note,
            'usage'=>$request->usage,
            'reminder'=>$request->f_stock < $request->s_stock ? 'NG' : 'OK'
        ]);

        $smvt = stockmovements::create([
            'mvt_type' => 'in',
            'qty' => $request->f_stock,
            'from_loc' => null, // Assuming no from location for inbound
            'to_loc' => $warehouses->id_wh,
            'description' => 'Inbound stock for sparepart: ' . $spareparts->part_name,
            'pic_wh' => $request->pic_wh,
            'pic_item' => $request->pic_order,
            'price' => $request->price,
            'supplier' => $supplier->spl_name,
            'part_use' => $request->usage,
            'date_in' => $request->date_in,
            // Assuming id_alct is the allocation ID
            'id_alct' => $allocations->id_alct
        ]);
        // Commit the transaction
        //DB::commit();
       
        // Log activity
        $data = allocations::where('id_alct', $request->part_id)->with('spareparts', 'warehouses')->first();

        $user = Auth::user();

        // Log aktivitas create
        \App\Models\ActivityLog::record(
            $user->id,
            $user->role->role_name ?? 'guest',
            'create',
            $data->id_alct,
            'Adding sparepart and allocation'
        );







        return redirect()->back()->with('success', 'New part has been added');
        
        //dd(session()->all());
    }

    /**
     * Display the specified resource.
     */
    public function show($parts) {
        //$allocations = allocations::where('id_alct', $parts)->with('spareparts.supplier', 'warehouses.whlocs', 'stc_mvt')->first();
        $allocations = Allocations::where('id_alct', $parts)
        ->with([
            'spareparts.supplier',
            'warehouses.whlocs',
            'stc_mvt'])->first();

        if (!$allocations) {
            return response()->json(['error' => 'Allocation not found'], 404);
        }

        $allocations->reminder = ($allocations->e_stock < $allocations->s_stock) ? 'NG' : 'OK';

        


        return response()->json($allocations);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($parts)
    {
        $choices = warehouses::select(DB::raw("CONCAT(wh_type, ' - ', (SELECT location FROM whlocs WHERE whlocs.id_whlocs = warehouses.id_whlocs)) AS wh_display"), 'id_wh')->get()->pluck('wh_display', 'id_wh');

        $spl = suppliers::get()->pluck('spl_name', 'id_spl');

        $parts = allocations::where('id_alct', $parts)->first();

        $selectedLoc = $parts->warehouses->id_wh ?? null;

        $selectedSpl = $parts->spareparts->supplier->id_spl ?? null;

        return view('leader.conjureparts', compact('choices', 'parts', 'selectedLoc', 'spl', 'selectedSpl'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $parts)
    {

        DB::transaction(function () use ($request, $parts) {
            $allocations = allocations::where('id_alct', $parts)->with('spareparts', 'warehouses')->first();
            $warehouses = warehouses::where('id_wh', $request->loc)->first();
            $supplier = suppliers::where('id_spl', $request->spl)->first();
            //Spareparts
            $spareparts = spareparts::where('id_part', $allocations->id_part)->first();
            $spareparts->part_name = $request->part_name;
            $spareparts->part_type = $request->part_type;
            $spareparts->mfg = $request->mfg;
            $spareparts->price = $request->price;
            $spareparts->id_spl = $supplier->id_spl;
            $spareparts->save();

            //Allocations
            $allocations->id_alct = $request->part_id;
            $allocations->e_stock = $request->e_stock;
            $allocations->s_stock = $request->s_stock;
            $allocations->id_wh = $warehouses->id_wh;
            $allocations->id_part = $spareparts->id_part;
            $allocations->note = $request->note;
            $allocations->usage = $request->usage;
            $allocations->reminder = $request->e_stock < $request->s_stock ? 'NG' : 'OK';
            $allocations->save();
        });

        // Log activity
        $data = allocations::where('id_alct', $request->part_id)->with('spareparts', 'warehouses')->first();

        $user = Auth::user();

        // Log aktivitas edit
        \App\Models\ActivityLog::record(
            $user->id,
            $user->role->role_name ?? 'guest',
            'edit',
            $data->id_alct,
            'Editing sparepart and allocation'
        );

        //Session::put('plant_filter', request()->get('id_whlocs'));

        return redirect()->back()->with('success', 'Part have been updated');

        //return redirect()->route('leader.listspareparts', request()->query());

        //return redirect()->route('leader.listspareparts', ['id_whlocs' => Session::get('plant_filter')])->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($parts)
{
        stockmovements::where('id_alct', $parts)->delete();

        $allocation = allocations::where('id_alct', $parts)->first(); // Pastikan pakai id_alct

        if (!$allocation) {
            return response()->json(['error' => 'Allocation not found'], 404);
        }
         // Log activity

        $user = Auth::user();

        // Log aktivitas delete
        \App\Models\ActivityLog::record(
            $user->id,
            $user->role->role_name ?? 'guest',
            'delete',
            $allocation->id_alct,
            'Deleting sparepart and allocation'
        );
        
        $allocation->delete();

       
        return redirect()->back()->with('success', 'Data have been destroyed');
    }
}
