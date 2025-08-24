<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;

class ClientControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Client::count() === 0) {
            return response()->json(['message' => 'No clients found'], 404);
        }

        return Client::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $client = Client::create($request->all());
        return response()->json($client, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (Client::find(($id)) === null) {
            return response()->json(['message' => 'Client not found'], 404);
        }
        return Client::find($id);
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
