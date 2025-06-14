<?php

namespace App\Http\Controllers;

use App\Models\stockmovements;
use App\Models\wh_locs;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function daily(Request $request)
    { 
        $plantId = $request->input('plant_id');

        if (!$plantId || $plantId == 'all') {
            $movements = stockmovements::with(['allocations.warehouses'])->get();
        } else {
            $movements = stockmovements::with(['allocations.warehouses'])
                ->whereHas('allocations.warehouses', function ($q) use ($plantId) {
                    $q->where('id_whlocs', $plantId);
                })->get();
        }
        

        //dd($warehouses);
        //dd($request->all());

        $plants = wh_locs::all();

        $movements = collect($movements);

        return view('leader.dailyreport', compact('movements', 'plantId'));
    }
}
