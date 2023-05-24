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
        $employees = Employee::paginate($perPage);

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

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'designation' => 'required',
            'email' => 'required|email|unique:employees',
            'department' => 'required',
        ]);

        $employee = Employee::create($validatedData);

        return response()->json($employee, 201);
    }

    public function update(Request $request, Employee $employee)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'designation' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('employees')->ignore($employee->id),
            ],
            'department' => 'required',
        ]);

        $employee->update($validatedData);

        return response()->json($employee);
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return response()->json(null, 204);
    }
}
