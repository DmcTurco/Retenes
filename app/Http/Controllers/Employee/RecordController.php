<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Retainer;
// use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use PDF;

class RecordController extends Controller
{
    public function index()
    {
        $retainersTurn1 = null;
        $retainersTurn2And3 = null; 
        return view('employee.pages.record.index', compact('retainersTurn1', 'retainersTurn2And3'));
    }

    public function getRetainer($date)
    {
        $turns = collect(config('const.turns'));
        $status = collect(config('const.state'));
        $current_date = Carbon::now()->toDateString(); 

        $search = !empty($date) ? $date :  $current_date;

        $retainer = Retainer::whereDate('created_at', $search)
        ->orderBy('created_at', 'asc')
        ->get()
        ->map(function($retainer) use ($turns) {
            $turn = $turns->firstWhere('id', $retainer->turns);
            $retainer->turn_name = $turn['name'] ?? 'N/A';
            return $retainer;
        })
        ->map(function($retainer) use($status){
            $state = $status->firstWhere('id',$retainer->state);
            $retainer->state_name = $state['name'] ?? 'N/A';
            return $retainer;
        });

        $retainersTurn1 = $retainer->filter(function($retainer) {
            return $retainer->turns == 1;
        });

        $retainersTurn2And3 = $retainer->filter(function($retainer) {
            return in_array($retainer->turns, [2, 3]);
        });

        
        return view('employee.pages.record.index', compact('retainersTurn1', 'retainersTurn2And3','turns'));
    }

    public function generatePdf(Request $request)
    {
        $date = $request->input('date');
        
        $turns = collect(config('const.turns'));
        $status = collect(config('const.state'));
        $current_date = Carbon::now()->toDateString(); 

        $search = !empty($date) ? $date :  $current_date;

        $retainer = Retainer::whereDate('created_at', $search)
        ->orderBy('created_at', 'asc')
        ->get()
        ->map(function($retainer) use ($turns) {
            $turn = $turns->firstWhere('id', $retainer->turns);
            $retainer->turn_name = $turn['name'] ?? 'N/A';
            return $retainer;
        })
        ->map(function($retainer) use($status){
            $state = $status->firstWhere('id',$retainer->state);
            $retainer->state_name = $state['name'] ?? 'N/A';
            return $retainer;
        });

        $retainersTurn1 = $retainer->filter(function($retainer) {
            return $retainer->turns == 1;
        });

        $retainersTurn2And3 = $retainer->filter(function($retainer) {
            return in_array($retainer->turns, [2, 3]);
        });

        $data = [
            'retainersTurn1' => $retainersTurn1,
            'retainersTurn2And3' => $retainersTurn2And3,
        ];

        $pdf = PDF::loadView('employee.pdf.report', $data);
        return $pdf->download('reporte.pdf');
    }
    
}
