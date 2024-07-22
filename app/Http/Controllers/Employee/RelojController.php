<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Reloj;
use Illuminate\Http\Request;

class RelojController extends Controller
{

    public function index()
    {
        $relojes = Reloj::orderBy('star_time', 'asc')->get();
        return view('Employee.pages.reloj.index', compact('relojes'));
    }

    // public function edit($id)
    // {

    //     $relojes = Reloj::orderBy('star_time', 'asc')->get();
    //     $reloj = Reloj::findOrFail($id);
    //     return view('Employee.pages.reloj.index', compact('reloj', 'relojes'));

    // }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'star_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:star_time',
            'number_minutes_1' => 'required|numeric|min:1|max:30',
            'number_minutes_2' => 'required|numeric|min:1|max:30',
            'number_minutes_3' => 'required|numeric|min:1|max:30',
        ]);

        // Verificación de solapamiento de horas
        $existingReloj = Reloj::where(function($query) use ($request) {
            $query->where('star_time', '<', $request->end_time)
                ->where('end_time', '>', $request->star_time);
        })->exists();

        if ($existingReloj) {
            return redirect()->back()->with('warning', 'El rango de tiempo se solapa con un registro existente.');
            
        }
    
        $reloj = Reloj::create([

            'name' => $request->name,
            'star_time' => $request->star_time,
            'end_time' => $request->end_time,
            'number_minutes_1' => $request->number_minutes_1,
            'number_minutes_2' => $request->number_minutes_2,
            'number_minutes_3' => $request->number_minutes_3,
            'state'=> 1,
            'employee_id'=> auth()->user()->id,

        ]);
    
        return redirect()->route('employee.reloj.index')->with('message', 'El Reloj ' . $request->name . ' se ha creado exitosamente.');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'star_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:star_time',
            'number_minutes_1' => 'required|numeric|min:1|max:30',
            'number_minutes_2' => 'required|numeric|min:1|max:30',
            'number_minutes_3' => 'required|numeric|min:1|max:30',
        ]);
    
        $startTime = $validatedData['star_time'];
        $endTime = $validatedData['end_time'];
    
        // Verificar solapamiento de horarios excluyendo el registro actual
        $overlap = Reloj::where('id', '!=', $id)
                        ->where(function($query) use ($startTime, $endTime) {
                            $query->where(function ($query) use ($startTime, $endTime) {
                                $query->where('star_time', '<', $endTime)
                                      ->where('end_time', '>', $startTime);
                            });
                        })->exists();
    
        if ($overlap) {
            return redirect()->route('employee.reloj.index')->with('warning','Los horarios se solapan con otros registros existentes.');
        }
    
        $reloj = Reloj::findOrFail($id);
        $reloj->update($validatedData);
    
        return redirect()->route('employee.reloj.index')->with('message', 'Reloj actualizado con éxito');
    }

    public function destroy($id)
    {
        $reloj = Reloj::findOrFail($id);
        $reloj->delete();

        return redirect()->route('employee.reloj.index')->with('success', 'Reloj eliminado con éxito');
    }


}
