<?php

namespace App\Http\Controllers;

use App\Models\warehouses;
use App\Models\wh_locs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WarehousesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $warehouses = warehouses::all();
        return view('leader.listwarehouses', compact('warehouses'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $choices = wh_locs::pluck('location', 'id_whlocs');
        return view('leader.registwh', compact('choices'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'wh_type'=>'required',
            'shelf_count'=>'required|numeric',
            'shelf_ids'=>'required',
            'cabs_count'=>'required|numeric',
            'cabs_ids'=>'required',
            'capacity'=>'required|numeric',
            'temp_ctrl'=>'required',
        ]);

        DB::beginTransaction();
        try{

            $whlocs = wh_locs::where('id_whlocs', $request->loc)->first();

            $warehouses = warehouses::create([
                'wh_type'=>$request->wh_type,
                'shelf_count'=>$request->shelf_count,
                'shelf_ids'=>$request->shelf_ids,
                'cabs_count'=>$request->cabs_count,
                'cabs_ids'=>$request->cabs_ids,
                'capacity'=>$request->capacity,
                'temp_ctrl'=>$request->temp_ctrl,
                'id_whlocs'=>$whlocs->id_whlocs
            ]);
                
            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack(); // Batalkan semua perubahan jika ada error
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'OK');
    }

    /**
     * Display the specified resource.
     */
    public function show($wh)
    {
        $warehouses = warehouses::where('id_wh', $wh)->with('whlocs')->first();

        if (!$warehouses) {
            return response()->json(['error' => 'Warehouse not found'], 404);
        }

        return response()->json($warehouses);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
