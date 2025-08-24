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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:clients',
            'phone' => 'required|string|max:10|min:10',
            'address' => 'required|string|max:500',
        ]);

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
        if (Client::find($id) === null) {
            return response()->json(['message' => 'Client not found'], 404);
        }

        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:clients',
            'phone' => 'sometimes|required|string|max:10|min:10',
            'address' => 'sometimes|required|string|max:500',
        ]);

        $client = Client::find($id);
        $client->update($request->all());

        return response()->json($client, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Client::find($id) === null) {
            return response()->json(['message' => 'Client not found'], 404);
        }
        Client::destroy($id);
        return response()->json(null, 204);
    }
}
