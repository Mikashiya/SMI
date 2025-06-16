<?php

namespace App\Http\Controllers;

use App\Models\stockmovements;
use App\Models\wh_locs;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function daily(Request $request)
    { 
        $plantId = $request->input('plant_id');

        if ($plantId !== null) {
            session(['plant_id' => $plantId]);
        } else {
            $plantId = session('plant_id');
        }


        $date = $request->input('date') 
        ? Carbon::parse($request->input('date'))->startOfDay()
        : Carbon::today();

        $query = stockmovements::with(['allocations.warehouses'])->orderBy('created_at', 'desc');

        // Filter tanggal (selalu dipakai)
        $query->whereDate('created_at', $date);

        // Filter plant (jika ada dan bukan 'all')
        if ($plantId && $plantId !== 'all') {
            $query->whereHas('allocations.warehouses', function ($q) use ($plantId) {
                $q->where('id_whlocs', $plantId);
            });
        }

        $movements = $query->get();

        //if (!$plantId || $plantId == 'all') {
        //    $movements = stockmovements::with(['allocations.warehouses'])->orderBy('created_at', 'desc')->get();
        //} else {
        //    $movements = stockmovements::with(['allocations.warehouses'])->whereDate('created_at', $date)
        //    ->whereHas('allocations.warehouses', function ($q) use ($plantId) {
        //        $q->where('id_whlocs', $plantId);
        //    })->orderBy('created_at', 'desc')->get();
        //}
        

        //dd($warehouses);
        //dd($request->all());

        $plants = wh_locs::all();

        //$movements = collect($movements);

        return view('main.dailyreport', compact('movements', 'plantId', 'date'));
    }
}
