<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmployeesController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->query('per_page', 10);

        $validatedData = $request->validate([
            'per_page' => 'integer|min:1|max:100', // Example validation rule
        ]);

        if (empty($validatedData['per_page'])) {
            $validatedData['per_page'] = $perPage;
        }

        $employees = Employee::paginate($validatedData['per_page']);

        return response()->json([
            'data' => $employees->items(),
            'meta' => [
                'current_page' => $employees->currentPage(),
                'last_page' => $employees->lastPage(),
                'per_page' => $employees->perPage(),
                'total' => $employees->total(),
            ],
        ]);
    }

    public function show(int $id)
    {
        $employee = Employee::find($id);

        if ($employee) {
            return response()->json($employee);
        } else {
            return response()->json([
                'message' => 'Employee not found',
            ], 404);
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'designation' => 'required|max:255',
            'email' => 'required|email|unique:employees|max:255',
            'department' => 'required|max:255',
        ]);

        // Sanitize email field
        $validatedData['email'] = filter_var($validatedData['email'], FILTER_SANITIZE_EMAIL);


        //check for unique email
        $employee = Employee::where('email', $request->email)->first();

        if ($employee) {
            return response()->json([
                'message' => 'Email already exists',
            ], 422);
        }

        $employee = Employee::create($validatedData);

        return response()->json($employee, 201);
    }

    public function update(Request $request, Employee $employee)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'designation' => 'required|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('employees')->ignore($employee->id),
            ],
            'department' => 'required|max:255',
        ]);

        // Sanitize email field
        $validatedData['email'] = filter_var($validatedData['email'], FILTER_SANITIZE_EMAIL);

        $employee->update($validatedData);

        return response()->json($employee);
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return response()->json(null, 204);
    }
}
