<?php

namespace App\Http\Controllers;

use App\Models\Mechanic;
use Illuminate\Http\Request;

class MechanicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mechanics = Mechanic::with('carOwner')->get();
        return response()->json([
            'statusCode' => 200,
            'data' => [
                'mechanics' => $mechanics,
            ]
        ], 200 );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Mechanic $mechanic)
    {
        return response()->json([
            'statusCode' => 200,
            'data' => [
                'mechanic' => $mechanic->carOwner,
            ]
        ], 200 );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mechanic $mechanic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mechanic $mechanic)
    {
        //
    }
}
