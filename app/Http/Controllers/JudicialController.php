<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JudicialController extends Controller
{
    public function step6()
    {
        return view('judicial.judicial-action', ['step' => 6]);
    }

    public function step7(Request $request)
    {
        session()->put('step6_data', $request->all());
        return view('judicial.compensation-amount', ['step' => 7]);
    }

    public function step8(Request $request)
    {
        session()->put('step7_data', $request->all());
        return view('judicial.transfer-of-ownership', ['step' => 8]);
    }

    public function step9(Request $request)
    {
        session()->put('step8_data', $request->all());
        return view('judicial.bulletin', ['step' => 9]);
    }

    public function step10(Request $request)
    {
        session()->put('step9_data', $request->all());
        return view('judicial.observations', ['step' => 10]);
    }

    public function finish(Request $request)
    {
        session()->put('step10_data', $request->all());
        return redirect()->route('appraisals.index')->with('success', 'Proceso judicial completado (simulado)');
    }
}
