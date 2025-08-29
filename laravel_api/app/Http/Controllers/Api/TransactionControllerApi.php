<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TransactionControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Transaction::count() === 0) {
            return response()->json(['message' => 'No transaction found'], 404);
        }

        return Transaction::with(['client', 'account', 'employee'])->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => [
                'required',
                'string',
                Rule::in(['deposit', 'withdrawal', 'transfer']),
            ],
            "amount" => "required|numeric",
            "client_id" => "required|exists:clients,id",
            "account_id" => "required|exists:accounts,id",
            "employee_id" => "required|exists:employees,id",
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422)->throwResponse();
        }



        $transaction = Transaction::create($request->all());
        return response()->json($transaction, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (Transaction::find($id) === null) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }
        return Transaction::with(['client', 'account', 'employee'])->find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'type' => [
                'sometimes',
                'string',
                Rule::in(['deposit', 'withdrawal', 'transfer']),
            ],
            "amount" => "sometimes|numeric",
            "client_id" => "sometimes|exists:clients,id",
            "account_id" => "sometimes|exists:accounts,id",
            "employee_id" => "sometimes|exists:employees,id",
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422)->throwResponse();
        }

        $transaction = Transaction::find($id);
        $transaction->update($request->all());

        return response()->json($transaction, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Transaction::find($id) === null) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }
        Transaction::destroy($id);
        return response()->json(null, 204);
    }
}
