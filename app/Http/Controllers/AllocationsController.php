<?php

namespace App\Http\Controllers;

use App\Models\allocations;
use App\Models\warehouses;
use App\Models\spareparts;
use App\Models\wh_locs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Log;

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
        return view('leader.registparts', compact('choices'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate
        $request->validate([
            'part_id'=>'required',
            'part_name'=>'required',
            'part_type'=>'required',
            'mfg'=>'required',
            'date_in'=>'required',
            'pic_wh'=>'required',
            'pic_order'=>'required',
            'spl_name'=>'required',
            'usage'=>'required',
            'loc'=>'required',
            'price'=>'required|numeric',
            'f_stock'=>'required|numeric',
            's_stock'=>'required|numeric'
        ]);

        DB::beginTransaction();
        try{
            //Sparepart
            $spareparts = spareparts::create([
                'part_name'=>$request->part_name,
                'part_type'=>$request->part_type,
                'mfg'=>$request->mfg,
                'price'=>$request->price
            ]);
            
            //dd('Debug setelah sparepart:', $spareparts);

            
    
            DB::commit();

        } 
        catch (\Exception $e) {
            DB::rollBack(); // Batalkan semua perubahan jika ada error
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        if (allocations::where('id_alct', $request->part_id)->exists()) {
            return redirect()->back()->with('error', 'ID Allocation sudah ada, gunakan ID yang berbeda!');
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
       

        return redirect()->back()->with('success', 'OK');
    }

    /**
     * Display the specified resource.
     */
    public function show($parts) {
        $allocations = allocations::where('id_alct', $parts)->with('spareparts', 'warehouses')->first();

        if (!$allocations) {
            return response()->json(['error' => 'Allocation not found'], 404);
        }

        $allocations->reminder = ($allocations->e_stock < $allocations->s_stock) ? 'NG' : 'OK';


        return response()->json($allocations);

        $whloc = warehouses::where('id_wh', $parts)->with('whlocs')->first();
        return response()->json($whloc);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($parts)
    {
        $choices = warehouses::select(DB::raw("CONCAT(wh_type, ' - ', (SELECT location FROM whlocs WHERE whlocs.id_whlocs = warehouses.id_whlocs)) AS wh_display"), 'id_wh')->get()->pluck('wh_display', 'id_wh');
        

        $parts = allocations::where('id_alct', $parts)->first();

        $selectedLoc = $parts->warehouses->id_wh ?? null;

        return view('leader.conjureparts', compact('choices', 'parts', 'selectedLoc'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $parts)
    {

        DB::transaction(function () use ($request, $parts) {
            $allocations = allocations::where('id_alct', $parts)->with('spareparts', 'warehouses')->first();
            $warehouses = warehouses::where('id_wh', $request->loc)->first();

            //Spareparts
            $spareparts = spareparts::where('id_part', $allocations->id_part)->first();
            $spareparts->part_name = $request->part_name;
            $spareparts->part_type = $request->part_type;
            $spareparts->mfg = $request->mfg;
            $spareparts->price = $request->price;
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

       

        return redirect()->route('parts.index')->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($parts)
{
        $allocation = allocations::where('id_alct', $parts)->first(); // Pastikan pakai id_alct

        if (!$allocation) {
            return response()->json(['error' => 'Allocation not found'], 404);
        }

        $allocation->delete();
        return redirect()->back();
    }
}
