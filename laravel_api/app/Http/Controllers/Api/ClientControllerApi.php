<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Validator;


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
        $this->validateInput($request);

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

        $this->validateInput($request);

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

    private function validateInput(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'middle_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|size:10|unique:clients,phone_number',
            'egn' => 'required|string|size:10|unique:clients,egn',
            'address' => 'required|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422)->throwResponse();
        }
    }
}
