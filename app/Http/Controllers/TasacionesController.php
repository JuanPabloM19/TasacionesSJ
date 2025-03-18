<?php

namespace App\Http\Controllers;

use App\Models\Tasacion;
use Illuminate\Http\Request;
use App\Exports\TasacionesExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TasacionesController extends Controller
{
    public function index(Request $request)
    {
        $query = Tasacion::with('tasacionJudicial', 'aprobadoPor'); // Carga relación directamente

        // Filtrar por nomenclatura si se proporciona
        if ($request->filled('nomenclatura')) {
            $query->where('nomenclatura', 'LIKE', '%' . $request->nomenclatura . '%');
        }

        // Filtrar por estado (Etapa Administrativa) si se proporciona
        if ($request->filled('estado_administrativa') && $request->estado_administrativa !== 'no') {
            $query->where('estado', $request->estado_administrativa);
        }

        // Filtrar por estado (Etapa Judicial) si se proporciona
        if ($request->filled('estado_judicial') && $request->estado_judicial !== 'no') {
            $query->where('estado', $request->estado_judicial);
        }

        // Filtrar por estado de Pagada si se proporciona
        if ($request->filled('estado_pagada') && $request->estado_pagada !== 'no') {
            $query->where('estado', 'pagada');
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
            'nomenclatura' => ['required', 'digits:15', 'unique:tasaciones,nomenclatura'],
            'inscripcion_dominio' => ['required', 'max:200'],
            'ubicacion' => ['required', 'max:200'],
            'propietarios' => ['required', 'max:200'],
            'nro_plano' => ['required', 'regex:/^\d{2}\/\d{5}\/\d{4}$/'],
            'superficie_total' => ['required', 'numeric'],
            'unidad_superficie' => ['required', 'in:m2,ha'],
            'fraccion_expropiar' => ['required', 'max:200'],
        ]);

        // Validación extra: los primeros dos dígitos deben coincidir
        $nomenclatura_prefix = substr($validated['nomenclatura'], 0, 2);
        $nro_plano_prefix = substr($validated['nro_plano'], 0, 2);

        if ($nomenclatura_prefix !== $nro_plano_prefix) {
            return redirect()->back()->withErrors(['nro_plano' => 'Los dos primeros dígitos de la nomenclatura y del número de plano deben coincidir.'])
                ->withInput();
        }

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
            'nombre_reparticion' => ['required', 'max:200'],
            'expediente_nro' => ['required', 'regex:/^\d{3}-\d{5}-\d{4}$/'],
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
            'numero_ley' => 'required|string|max:200',
            'fecha_ley' => 'required|date',
            'boletin_oficial' => 'nullable|string',
            'boletin_oficial_archivo' => 'nullable|file|mimes:pdf,doc,docx|max:10240', // Máx. 10MB
            'ley_documento' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
        ]);

        // Manejo del archivo del boletín oficial
        if ($request->hasFile('boletin_oficial_archivo')) {
            $boletin = $request->file('boletin_oficial_archivo');
            $boletin_filename = uniqid() . '.' . $boletin->getClientOriginalExtension();
            // Usar el disco 'public' para guardar el archivo en 'public/documents'
            $validated['boletin_oficial_archivo'] = $boletin->storeAs('documents', $boletin_filename, 'public');
            // Si se sube archivo, se borra el campo de texto
            $validated['boletin_oficial'] = null;
        }

        // Manejo del archivo si se proporciona
        if ($request->hasFile('ley_documento')) {
            $document = $request->file('ley_documento');
            $filename = uniqid() . '.' . $document->getClientOriginalExtension();
            // Usar el disco 'public' para guardar el archivo en 'public/documents'
            $validated['ley_documento'] = $document->storeAs('documents', $filename, 'public');
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
            'numero_exp' => ['required', 'regex:/^\d{3}-\d{5}-\d{4}$/'],
            'monto_acordado' => 'required|numeric',
            'fecha_notificacion' => 'required|date',
            'acta_numero' => 'nullable|string',
            'acta_documento' => 'nullable|file|mimes:pdf,doc,docx|max:10240', // Máx. 10MB
        ]);

        // Guardar el archivo del acta si se sube uno
        if ($request->hasFile('acta_documento')) {
            $acta = $request->file('acta_documento');
            $acta_filename = uniqid() . '.' . $acta->getClientOriginalExtension();
            $validated['acta_documento'] = $acta->storeAs('documents', $acta_filename);
            // Si se sube archivo, se borra el campo de texto
            $validated['acta_numero'] = null;
        }

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

    public function store(Request $request)
    {
        $request->validate([
            'nomenclatura' => 'required|unique:tasaciones,nomenclatura',
            // Agrega más validaciones según sea necesario
        ]);

        $tasacion = new Tasacion($request->all());

        if (auth()->user()->isPasante()) {
            $tasacion->aprobado = false;
            $tasacion->aprobado_por = null;
        } else {
            $tasacion->aprobado = true;
            $tasacion->aprobado_por = auth()->id();
        }

        $tasacion->save();

        return redirect()->route('appraisals.index')->with('success', 'Tasación creada.');
    }

    public function aprobar($id)
    {
        $tasacion = Tasacion::findOrFail($id);

        // Verificar si el usuario tiene permiso
        if (Auth::user()->role != 'admin' && Auth::user()->role != 'publicador') {
            abort(403, 'No tienes permisos para aprobar esta tasación.');
        }

        // Lógica de aprobación
        $tasacion->aprobado = true;
        $tasacion->aprobado_por = Auth::user()->id; // Asegúrate de que se está guardando el ID correcto del usuario
        $tasacion->save();

        return redirect()->route('appraisals.index')->with('success', 'Tasación aprobada con éxito.');
    }

    public function show($id)
    {
        $tasacion = Tasacion::with('tasacionJudicial')->findOrFail($id);
        return view('appraisals.show', compact('tasacion'));
    }

    public function downloadDocument($filename)
    {
        // Reemplaza 'private/documents' por la ruta correcta en tu sistema
        $path = storage_path('app/public/documents/' . $filename);

        // Verifica si el archivo existe
        if (file_exists($path)) {
            return response()->download($path);
        }

        abort(404, 'Archivo no encontrado');
    }
}
