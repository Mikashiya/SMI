<?php

namespace App\Http\Controllers;

use App\Models\allocations;
use App\Models\stockmovements;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        // Get the transaction type from the request
        $transactionType = request()->route('transactionType');
        //dd($transactionType);
        // Retrieve all parts (allocations) to display in the form
        $parts = allocations::all();
        // Pass the parts and transaction type to the view
        return view('main.partmovements', compact('parts', 'transactionType'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        // Validate the request data
        $request->validate([
            'part_id' => 'required|exists:allocations,id_alct',
            'date' => 'required|date',
            'mvt_type' => 'required|in:in,out,transfer',
            'qty' => 'required|integer|min:1',
            'from_loc' => 'nullable|string|max:255',    
            'to_loc' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:500',
            'pic_wh' => 'nullable|string|max:255',
            'pic_item' => 'nullable|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'supplier' => 'nullable|string|max:255',
            'part_use' => 'nullable|string|max:255',
            'date_in' => 'nullable|date',
            'date_out' => 'nullable|date',
            'date_transfer' => 'nullable|date',
        ]);

        // Create a new stock movement record
        $stockMovement = new stockmovements();
        $stockMovement->id_alct = $request->part_id; // Assuming $parts is an instance of allocations
        if (!$stockMovement->id_alct) {
            return back()->with('error', 'Part not found!');
        }
        // Set the stock movement details
        $stockMovement->mvt_type = $request->mvt_type;
        $stockMovement->qty = $request->qty;
        $stockMovement->description = $request->description;
        $stockMovement->pic_wh = $request->pic_wh;
        $stockMovement->pic_item = $request->pic_item;
        $stockMovement->part_use = $request->part_use;
        // Save the stock movement record
        if ($request->mvt_type === 'in') {
            $stockMovement->date_in = $request->date;
            $stockMovement->price = $request->price;
            $stockMovement->supplier = $request->supplier;
        } elseif ($request->mvt_type === 'out') {
            $stockMovement->date_out = $request->date;
        } elseif ($request->mvt_type === 'transfer') {
            $stockMovement->date_transfer = $request->date;
            $stockMovement->from_loc = $request->part_id; // Assuming from_loc is the same as part_id
            $stockMovement->to_loc = $request->to_loc;
        }

        $stockMovement['user_id'] = Auth::id();

        $stockMovement->save();

        // Update the allocation status if necessary
        $allocation = allocations::find($request->part_id);
        if ($allocation) {
            // Example logic to update allocation status based on movement type
            if ($request->mvt_type === 'in') {
                $allocation->e_stock = $allocation->e_stock + $request->qty;
            } elseif ($request->mvt_type === 'out') {

                if ($allocation->e_stock < $request->qty) {
                    return back()->with('error', 'Stok tidak mencukupi untuk pengeluaran!');
                }

                $allocation->e_stock = $allocation->e_stock - $request->qty;
            } elseif ($request->mvt_type === "transfer") {

                // Handle transfer logic
                if ($request->to_loc === null) {
                    return back()->with('error', 'Lokasi tujuan tidak boleh kosong untuk transfer!');
                }
                // Ensure both origin and destination stocks exist
                if ($request->part_id === $request->to_loc) {
                    return back()->with('error', 'Lokasi asal dan tujuan tidak boleh sama!');
                }
                try {
                    $originStock = allocations::where('id_alct', $request->part_id)
                        ->firstOrFail();
                    $destinationStock = allocations::where('id_alct', $request->to_loc)
                        ->firstOrFail();
                } catch (\Exception $e) {
                    return back()->with('error', 'Stok asal atau tujuan tidak ditemukan!');
                }
                
                // Check if the origin stock has enough quantity for transfer

                if ($originStock->e_stock >= $request->qty) {
                    $originStock->e_stock -= $request->qty; // Kurangi stok asal
                    $destinationStock->e_stock += $request->qty; // Tambah stok tujuan
                    $originStock->save();
                    $destinationStock->save();

                } else {
                    return back()->with('error', 'Stok tidak mencukupi untuk transfer!');
                }
            }
            // Save the updated allocation
            $allocation->save();

            $user = Auth::user();

            // Log aktivitas create
            \App\Models\ActivityLog::record(
                $user->id,
                $user->role->role_name ?? 'guest',
                'create',
                $stockMovement['id_alct'] ?? null,
                'Creating stock movement',
            );
        }
        // Optionally, you can return the created stock movement
        return redirect()->back()->with('success', 'Stock movement created successfully', ['data' => $stockMovement['id_alct']]);
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
