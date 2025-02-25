<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TasacionesController extends Controller
{
    public function index()
    {
        return view('appraisals.index'); // Asegúrate de tener esta vista creada
    }

    public function step1()
    {
        return view('appraisals.individualization', ['step' => 1]);
    }

    public function step2(Request $request)
    {
        session()->put('step1_data', $request->all());
        return view('appraisals.expropriating-body', ['step' => 2]);
    }

    public function step3(Request $request)
    {
        session()->put('step2_data', $request->all());
        return view('appraisals.utility-law', ['step' => 3]);
    }

    public function step4(Request $request)
    {
        session()->put('step3_data', $request->all());
        return view('appraisals.notification-of-art', ['step' => 4]);
    }

    public function step5(Request $request)
    {
        session()->put('step4_data', $request->all());
        return view('appraisals.acceptance-of-amount', ['step' => 5]);
    }

    public function finish(Request $request)
    {
        session()->put('step5_data', $request->all());
        return redirect()->route('appraisals.index')->with('success', 'Tasación agregada exitosamente (simulado)');
    }
}
