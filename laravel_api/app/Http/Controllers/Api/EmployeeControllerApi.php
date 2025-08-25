<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EmployeeControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Employee::count() === 0) {
            return response()->json(['message' => 'No employees found'], 404);
        }

        return Employee::with('transactions')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255|min:5',
            'middle_name' => 'required|string|max:255|min:5',
            'last_name' => 'required|string|max:255|min:5',

            'telephone_number' => [
                'required',
                'string',
                'size:10',
                Rule::unique('employees')->whereNull('deleted_at'),
            ],
            'position' => [
                'required',
                'string',
                'max:255',
                Rule::in(['manager', 'cashier', 'director', 'developer', 'security', 'cleaner', 'secretary']),
            ]
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422)->throwResponse();
        }

        $employee = Employee::create($request->all());
        return response()->json($employee, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (Employee::find($id) === null) {
            return response()->json(['message' => 'Employee not found'], 404);
        }
        return Employee::with('transactions')->find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'sometimes|required|string|max:255|min:5',
            'middle_name' => 'sometimes|required|string|max:255|min:5',
            'last_name' => 'sometimes|required|string|max:255|min:5',

            'telephone_number' => [
                'sometimes',
                'required',
                'string',
                'size:10',
                Rule::unique('employees')->whereNull('deleted_at'),
            ],
            'position' => [
                'sometimes',
                'required',
                'string',
                'max:255',
                Rule::in(['manager', 'cashier', 'director', 'developer', 'security', 'cleaner', 'secretary']),
            ]
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422)->throwResponse();
        }

        $employee = Employee::find($id);
        $employee->update($request->all());

        return response()->json($employee, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Employee::find($id) === null) {
            return response()->json(['message' => 'Employee not found'], 404);
        }
        Employee::destroy($id);
        return response()->json(null, 204);
    }
}
