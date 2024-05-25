<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Retainer;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
class RetainerController extends Controller
{
    public function index()
    {
        $date = Carbon::now()->toDateString(); 
        $retainer = Retainer::whereDate('created_at', $date)
                            ->orderBy('created_at', 'asc') // Ordenar por fecha y hora de registro en orden descendente
                            ->get();
        return view('employee.pages.retainer.index', compact('retainer'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'padron' => 'required|numeric|min:1|max:140',
        ]);        
    
        $date = now()->toDateString();
        $existingRetainer = Retainer::where('padron', $request->padron)
                                     ->whereDate('created_at', '=', $date)
                                     ->first();
    
         if ($existingRetainer) {
            // Si el padron ya existe, mostrar SweetAlert para confirmar si se agrega de todos modos
            Session::flash('message', 'El padron ya ha sido registrado anteriormente.');
            Session::flash('existingRetainer', $existingRetainer);
            return redirect()->back();
        }
        // Si el padron no existe, crear el nuevo registro
        $retainer = Retainer::create([
            'padron' => $request->padron,
            'state' => 1,
        ]);
    
        return redirect()->route('employee.retainer.index');
    }

    public function updateState(Request $request, $id)
    {
        $item = Retainer::find($id);
        if ($item) {
            $item->state = $request->input('state');
            $item->save();
            // return back()->with('success', 'Estado actualizado correctamente');
        }

        return redirect()->route('employee.retainer.index');
    }
}
