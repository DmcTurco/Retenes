<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class EmployeeController extends Controller
{

    public function index()
    {
        $employee = Employee::all();
        return view('admin.pages.employee.index', compact('employee'));
    }

    public function edit($id)
    {

        $employee = Employee::findOrFail($id);
        if (!$employee) {
            $employee = new Employee();
        }
        return response()->json(['employee' => $employee]);
    }

    public function store(Request $request)
    {
        $id = $request->id;

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => !empty($id) ? 'nullable|string|min:8' : 'required|string|min:8',
            'tel' => 'nullable',
            'cel' => 'nullable',
            'doc_type' => 'nullable',
            'doc_number' => 'nullable|string|min:8|max:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if (!empty($id)) {
            $employee = Employee::find($id);

            if (!$employee) {
                return response()->json(['error' => 'Empleado no encontrado.'], 404);
            }

            $employee->update([
                'name' => $request->name,
                // 'email' => $request->email,
                'password' => $request->password ? Hash::make($request->password) : $employee->password,
                'tel' => $request->tel,
                'cel' => $request->cel,
                'doc_type' => $request->doc_type,
                'doc_number' => $request->doc_number,
                'status' => 1,
            ]);

            session()->flash('message', 'Empleado Actualizado correctamente.');

        } else {

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
            
            session()->flash('message', 'Empleado Creado correctamente.');
        }

        // session()->flash('message', 'Empleado ' . (!empty($id) ? 'Actualizado' : 'Creado') . ' correctamente.');
        return response()->json(['redirect' => route('admin.employee.index')]);
    }
}
