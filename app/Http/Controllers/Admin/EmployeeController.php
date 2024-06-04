<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{

    public function index () {
        $employee = Employee::all();
        return view('admin.pages.employee.index', compact('employee'));
    }

    public function edit($id)
    {

        $employee = Employee::findOrFail($id);
        if (!$employee) {
            $headquarter = new Headquarters();
        }
        return response()->json(['employee' => $employee]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'tel' => 'nullable',
            'cel' => 'nullable',
            'doc_type' => 'nullable',
            'doc_number' => 'nullable|string|min:8|max:8',
        ]);

        $employee = Employee::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'tel' => $request->cel,
            'cel' => $request->cel,
            'doc_type' => $request->doc_type,
            'doc_number' => $request->doc_number,
            'status' => 1,
        ]);

        return redirect()->route('admin.employee.index')->with('message', 'Empleado Creado Pendejo');

    }
}
