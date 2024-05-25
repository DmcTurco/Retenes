<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Retainer;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class RetainerController extends Controller
{
    public function index()
    {
        $date = Carbon::now()->toDateString(); 
        $retainer = Retainer::whereDate('created_at', $date)->get();
        return view('employee.pages.retainer.index',compact('retainer'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'padron' => 'required|numeric'
        ]);

        $retainer = Retainer::create([
            'padron' => $request->padron,
            'state' => 1,
        ]);

        return redirect()->route('employee.retainer.index');

    }
}
