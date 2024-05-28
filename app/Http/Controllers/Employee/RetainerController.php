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
        $turns = collect(config('const.turns'));
        $date = Carbon::now()->toDateString(); 
        $retainer = Retainer::whereDate('created_at', $date)
        ->orderBy('created_at', 'asc')
        ->get()
        ->map(function($retainer) use ($turns) {
            $turn = $turns->firstWhere('id', $retainer->turns);
            $retainer->turn_name = $turn['name'] ?? 'N/A';
            return $retainer;
        });

        $retainersTurn1 = $retainer->filter(function($retainer) {
            return $retainer->turns == 1;
        });

        $retainersTurn2And3 = $retainer->filter(function($retainer) {
            return in_array($retainer->turns, [2, 3]);
        });

        
        return view('employee.pages.retainer.index', compact('retainersTurn1', 'retainersTurn2And3','turns'));
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

        $retainer = Retainer::create([
            'padron' => $request->padron,
            'state' => 1,
            'turns' => $request->turns
        ]);
    
        return redirect()->route('employee.retainer.index')->with('message', 'El Padron ' . $request->padron . ' se ha puesto en cola.');
    }

    public function updateState(Request $request, $id)
    {
        $item = Retainer::find($id);
        if ($item) {
            $item->state = $request->input('state');
            $item->save();
        }

        return redirect()->route('employee.retainer.index');
    }


    public function destroy(Request $request, $id)
    {
        $retainer = Retainer::findOrFail($id);
        $retainer->delete();

        return redirect()->route('employee.retainer.index')->with('message', 'El registro ha sido eliminado correctamente.');
    }



}
