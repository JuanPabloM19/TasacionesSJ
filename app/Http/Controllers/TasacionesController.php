<?php

namespace App\Http\Controllers;

use App\Models\Tasacion;
use Illuminate\Http\Request;
use App\Exports\TasacionesExport;
use Maatwebsite\Excel\Facades\Excel;


class TasacionesController extends Controller
{
    public function index(Request $request)
    {
        $query = Tasacion::with('tasacionJudicial'); // Carga relación directamente

        // Filtrar por nomenclatura si se proporciona
        if ($request->filled('nomenclatura')) {
            $query->where('nomenclatura', 'LIKE', '%' . $request->nomenclatura . '%');
        }

        // Filtrar por estado si se proporciona
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        // Obtener las tasaciones con sus relaciones cargadas
        $tasaciones = $query->get();

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

        $tasacion->update(array_merge($validated, ['estado' => 'step2']));

        return redirect()->route('appraisals.step3', ['id' => $tasacion->id]);
    }

    public function step3(Request $request, $id)
    {
        $tasacion = Tasacion::findOrFail($id);

        if ($request->isMethod('get')) {
            return view('appraisals.utility-law', compact('tasacion'));
        }

        $validated = $request->validate([
            'numero_ley' => 'required|numeric',
            'fecha_ley' => 'required|date',
            'boletin_oficial' => 'required|string',
            'ley_documento' => 'nullable|file|mimes:pdf,doc,docx|max:10240', // max 10MB
        ]);

         // Manejo del archivo si se proporciona
        if ($request->hasFile('ley_documento')) {
            $document = $request->file('ley_documento');
            $filename = uniqid() . '.' . $document->getClientOriginalExtension();
            // Guardar el archivo en la carpeta 'documents'
            $validated['ley_documento'] = $document->storeAs('documents', $filename);
        }

        $tasacion->update(array_merge($validated, ['estado' => 'step3']));

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
            'fecha_notificacion' => 'required|date',
            'acta_numero' => 'required|string',
        ]);

        $tasacion->update(array_merge($validated, ['estado' => 'step4']));

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
            'conevenio_avenamiento' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'monto_pagado' => 'required|numeric',
        ]);

        if ($request->hasFile('monto_pagado')) {
            $document = $request->file('monto_pagado');
            $filename = uniqid() . '.' . $document->getClientOriginalExtension();
            // Guardar el archivo en la carpeta 'documents'
            $validated['monto_pagado'] = $document->storeAs('documents', $filename);
        }

        $tasacion->update(array_merge($validated, ['estado' => 'completed']));

        return redirect()->route('appraisals.index')->with('success', 'Tasación completada exitosamente');
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

    public function export(Request $request)
    {
        return Excel::download(new TasacionesExport($request), 'tasaciones.xlsx');
    }

    public function goToJudicial($id)
    {
        $tasacion = Tasacion::findOrFail($id);

        if ($tasacion->estado == 'completed') {
            // Cambiar estado a judicial
            $tasacion->estado = 'judicial';
            $tasacion->save();

            // Redirigir al primer paso de la etapa judicial
            return redirect()->route('judicial.step6', ['id' => $tasacion->id])->with('success', 'La tasación ha sido enviada a la etapa judicial.');
        }

        return redirect()->route('appraisals.index')->with('error', 'Esta tasación no está completada y no puede ser enviada a judicial.');
    }

    public function finalizeTasacion($id)
    {
        $tasacion = Tasacion::findOrFail($id);

        if ($tasacion->estado == 'completed') {
            // Cambiar estado a 'pagada'
            $tasacion->estado = 'pagada';
            $tasacion->save();

            // Redirigir a la vista principal con mensaje de éxito
            return redirect()->route('appraisals.index')->with('success', 'La tasación ha sido finalizada y marcada como pagada.');
        }

        return redirect()->route('appraisals.index')->with('error', 'Esta tasación no está completada y no puede ser finalizada.');
    }

}
