<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Reloj;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FrequencyController extends Controller
{

    public function index()
    {
        $currentTime = Carbon::now()->format('H:i:s');
        $frequency = Reloj::where('star_time', '<=', $currentTime)
        ->where('end_time', '>=', $currentTime)
        ->get();

        if (request()->ajax()) {
            return response()->json($frequency);
        }
        
        return view('Employee.pages.frequency.index',compact('frequency'));
    }
}
