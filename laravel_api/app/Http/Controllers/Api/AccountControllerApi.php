<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AccountControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Account::count() === 0) {
            return response()->json(['message' => 'No account found'], 404);
        }

        return Account::with(['client', 'transactions'])->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'account_number' => [
                'required',
                'string',
                Rule::unique('accounts')->whereNull('deleted_at')
            ],
            'currency' => [
                'required',
                'string',
                Rule::in(['USD', 'EUR', 'GBP', 'JPY', 'AUD']),
            ],
            "interest" => "required|numeric",
            "balance" => "required|numeric",
            "client_id" => "required|exists:clients,id"
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422)->throwResponse();
        }

        $account = Account::create($request->all());
        return response()->json($account, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (Account::find($id) === null) {
            return response()->json(['message' => 'Account not found'], 404);
        }
        return Account::with(['client', 'transactions'])->find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'account_number' => [
                'sometimes',
                'string',
                Rule::unique('accounts')->whereNull('deleted_at')
            ],
            'currency' => [
                'sometimes',
                'string',
                Rule::in(['USD', 'EUR', 'GBP', 'JPY', 'AUD']),
            ],
            "interest" => "sometimes",
            "balance" => "sometimes",
            "client_id" => "sometimes|exists:clients,id"
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422)->throwResponse();
        }

        $account = Account::find($id);
        $account->update($request->all());

        return response()->json($account, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Account::find($id) === null) {
            return response()->json(['message' => 'Account not found'], 404);
        }
        Account::destroy($id);
        return response()->json(null, 204);
    }
}
