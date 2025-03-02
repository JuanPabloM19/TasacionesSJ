<?php

namespace App\Http\Controllers;

use App\Models\Tasacion;
use Illuminate\Http\Request;

class TasacionesController extends Controller
{
    public function index()
    {
        $tasaciones = Tasacion::all();
        return view('appraisals.index', compact('tasaciones'));
    }

    public function step1(Request $request, $id = null)
    {
        $tasacion = $id ? Tasacion::findOrFail($id) : new Tasacion();

        if ($request->isMethod('get')) {
            return view('appraisals.individualization', compact('tasacion'));
        }

        $validated = $request->validate([
            'nomenclatura' => 'required|unique:tasaciones,nomenclatura',
            'inscripcion_dominio' => 'required|string',
            'ubicacion' => 'required|string',
            'propietarios' => 'required|string',
            'nro_plano' => 'required|string',
            'superficie_total' => 'required|numeric',
            'fraccion_expropiar' => 'required|numeric',
        ]);

        // $tasacion = Tasacion::create(array_merge($validated, ['estado' => 'step1']));

        if ($id) {
            $tasacion->update($validated);
        } else {
            $tasacion = Tasacion::create(array_merge($validated, ['estado' => 'step1']));
        }

        return redirect()->route('appraisals.step2', ['id' =>  $tasacion->id]);
    }

    public function step2(Request $request, $id)
    {
        $tasacion = Tasacion::findOrFail($id);

        if ($request->isMethod('get')) {
            return view('appraisals.expropriating-body', compact('tasacion'));
        }

        $validated = $request->validate([
            'nombre_reparticion' => 'required|string',
            'expediente_nro' => 'required|numeric',
            'fecha_iniciacion' => 'required|date',
        ]);

        $tasacion->update($validated);

        return redirect()->route('appraisals.step3', ['id' => $tasacion->id]);
    }

    public function step3(Request $request, $id)
    {
        $tasacion = Tasacion::findOrFail($id);

        if ($request->isMethod('get')) {
            return view('appraisals.utility-law', compact('tasacion'));
        }

        $validated = $request->validate([
            'numero' => 'required|numeric',
            'fecha' => 'required|date',
            'boletin_oficial' => 'required|string',
            'ley_documento' => 'nullable|file|mimes:pdf,doc,docx',
        ]);

        if ($request->hasFile('ley_documento')) {
            $document = $request->file('ley_documento');
            $filename = uniqid() . '.' . $document->getClientOriginalExtension();
            $validated['ley_documento'] = $document->storeAs('documents', $filename);
        }

        $tasacion->update($validated);

        return redirect()->route('appraisals.step4', ['id' => $tasacion->id]);
    }

    public function step4(Request $request, $id)
    {
        $tasacion = Tasacion::findOrFail($id);

        if ($request->isMethod('get')) {
            return view('appraisals.notification-of-art', compact('tasacion'));
        }

        $validated = $request->validate([
            'numero_exp' => 'required|numeric',
            'monto_acordado' => 'required|numeric',
            'fecha' => 'required|date',
            'acta_numero' => 'required|string',
        ]);

        $tasacion->update($validated);

        return redirect()->route('appraisals.step5', ['id' => $tasacion->id]);
    }

    public function step5(Request $request, $id)
    {
        $tasacion = Tasacion::findOrFail($id);

        if ($request->isMethod('get')) {
            return view('appraisals.acceptance-of-amount', compact('tasacion'));
        }

        $validated = $request->validate([
            'incremento' => 'required|boolean',
            'aceptacion' => 'required|boolean',
            'conevenio_avenamiento' => 'required|string',
            'monto_pagado' => 'required|numeric',
        ]);

        $tasacion->update(array_merge($validated, ['estado' => 'completed']));

        return redirect()->route('appraisals.index')->with('success', 'Tasación completada');
    }

        public function destroy($id)
    {
        // Buscar la tasación a eliminar
        $tasacion = Tasacion::findOrFail($id);

        // Eliminar la tasación
        $tasacion->delete();

        // Redirigir de vuelta con un mensaje de éxito
        return redirect()->route('appraisals.index')->with('success', 'Tasación eliminada correctamente');
    }

}
