<?php

namespace App\Http\Controllers;

use App\Models\suppliers;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supplier = suppliers::all();

        return view('leader.listsuppliers', compact('supplier'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('leader.registspl');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'spl_name' => 'required|string|max:255',
            'ctc_info' => 'required|string|max:255',
        ]);

        suppliers::create($validatedData);

        return redirect()->route('supplier.index')->with('success', 'Supplier created successfully.');
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
    public function edit($spl)
    {
        $supplier = suppliers::findOrFail($spl);

        return view('leader.conjurespl', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $spl)
    {
        $validatedData = $request->validate([
            'spl_name' => 'required|string|max:255',
            'ctc_info' => 'required|string|max:255',
        ]);

        $supplier = suppliers::findOrFail($spl);
        $supplier->update($validatedData);

        return redirect()->route('supplier.index')->with('success', 'Supplier updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($spl)
    {
        $supplier = suppliers::findOrFail($spl);
        $supplier->delete();

        return redirect()->route('supplier.index')->with('success', 'Supplier deleted successfully.');
    }
}
