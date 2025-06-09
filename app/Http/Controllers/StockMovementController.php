<?php

namespace App\Http\Controllers;

use App\Models\allocations;
use App\Models\stockmovements;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockMovementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $parts)
    {
        $request->validate([
            'id_alct'=>'required',
            'mvt_type'=>'required',
            'qty'=>'required|numeric',
        ]);

        DB::beginTransaction();
        try{

            $parts = allocations::where('id_alct', $parts)->get();

            $qty = $request->qty;

            if($parts->e_stock >= $qty){
                $stockmovements = stockmovements::create([
                    'id_alct'=>$request->id_alct,
                    'mvt_type'=>$request->mvt_type,
                    'qty'=>$request->qty,
                    'from_loc'=>$request->from_loc,
                    'to_loc'=>$request->to_loc,
                    'desc'=>$request->desc,

                ]);
                DB::commit();

                $parts->decrement('e_stock', $qty);
            }
            else{
                return back()->with('error', 'Stock Not Sufficient');
            }
        } 
        catch (\Exception $e) {
            DB::rollBack(); // Batalkan semua perubahan jika ada error
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
