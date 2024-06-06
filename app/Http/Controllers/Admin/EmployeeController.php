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

    public function index () {
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
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'tel' => 'nullable',
            'cel' => 'nullable',
            'doc_type' => 'nullable',
            'doc_number' => 'nullable|string|min:8|max:8',
        ]);

        if ($validator->fails()) {
            // return redirect()->back()->withErrors($validator)->withInput();
            return response()->json(['errors' => $validator->errors()], 422);
            // return response()->json(['success' => false, 'errors' => $validator->errors()], 200);
        }

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
        
        session()->flash('message', 'Empleado Creado Pendejo');
        return response()->json(['redirect' => route('admin.employee.index')]);

        // return redirect()->route('admin.employee.index')->with('message', 'Empleado Creado Pendejo');
        // return response()->json([
        //     'message' => 'Empleado creado exitosamente.',
        //     'redirect' => route('admin.employee.index')
        // ]);
    }

    public function update(Request $request){

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
        // return response()->json(['message' => 'Empleado Creado', 'redirect' => route('admin.employee.index')]);
        // if ($request->ajax()) {
        //     return response()->json(['redirect' => route('admin.employee.index')]);
        // } else {
        //     return redirect()->route('admin.employee.index')->with('success', 'Empleado creado exitosamente.');
        // }

    }





}
