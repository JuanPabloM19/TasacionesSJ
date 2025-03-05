<?php

namespace App\Http\Controllers;

use App\Models\TasacionJudicial;
use App\Models\Tasacion;
use Illuminate\Http\Request;

class JudicialController extends Controller
{
    private function getJudicialTasacion($tasacion_id)
    {
        return TasacionJudicial::firstOrNew(['tasacion_id' => $tasacion_id]);
    }

    public function step6(Request $request, $tasacion_id)
    {
        $tasacion = Tasacion::find($tasacion_id);
        $judicial = $this->getJudicialTasacion($tasacion_id);

        // Si la tasación ya está en un paso judicial, no permitir pasar de nuevo
        if ($tasacion->estado == 'step6') {
            return redirect()->route('judicial.step7', ['tasacion_id' => $tasacion->id]);
        }

        if ($request->isMethod('get')) {
            return view('judicial.judicial-action', compact('judicial'));
        }

        $validated = $request->validate([
            'expediente_nro' => 'required|string',
            'fecha_inicio' => 'required|date',
            'juzgado_interviniente' => 'required|string',
            'caratula' => 'required|string',
            'boleta_deposito' => 'nullable|file|mimes:pdf,jpg,png',
            'nro_comprobante' => 'nullable|string',
            'monto_depositado' => 'required|numeric',
            'observaciones' => 'nullable|string',
        ]);

        if ($request->hasFile('boleta_deposito')) {
            $filename = uniqid() . '.' . $request->file('boleta_deposito')->getClientOriginalExtension();
            $validated['boleta_deposito'] = $request->file('boleta_deposito')->storeAs('documents', $filename);
        }

        // Guardar los datos en la tabla judicial
        $judicial->fill($validated);
        $judicial->estado = 'step6'; // Cambiar el estado de la tasación judicial
        $judicial->save();

        // Actualizar el estado de la tasación en la tabla principal
        $tasacion->estado = 'step6'; // Pasar a step6
        $tasacion->save();

        // Redirigir al siguiente paso
        return redirect()->route('judicial.step7', ['tasacion_id' => $judicial->tasacion_id]);
    }

    public function step7(Request $request, $tasacion_id)
    {
        return $this->updateStep($request, $tasacion_id, 7, 'compensation-amount', [
            'dictamen_expediente' => 'required|string',
            'dictamen_fecha' => 'required|date',
            'dictamen_monto' => 'required|numeric',
            'orden_pago_fecha' => 'required|date',
            'orden_pago_monto' => 'required|numeric',
            'instrumento_legal' => 'required|string',
            'concepto_indemnizacion' => 'nullable|string',
        ]);
    }

    public function step8(Request $request, $tasacion_id)
    {
        return $this->updateStep($request, $tasacion_id, 8, 'transfer-of-ownership', [
            'dominio_publico' => 'required|string',
            'dominio_privado' => 'required|string',
        ]);
    }

    public function step9(Request $request, $tasacion_id)
    {
        return $this->updateStep($request, $tasacion_id, 9, 'bulletin', [
            'boletin_numero' => 'required|string',
            'boletin_fecha' => 'required|date',
            'boletin_archivo' => 'nullable|file|mimes:pdf,jpg,png',
        ]);
    }

    public function step10(Request $request, $tasacion_id)
    {
        return $this->updateStep($request, $tasacion_id, 10, 'observations', [
            'observaciones_finales' => 'nullable|string',
            'archivo_observaciones' => 'nullable|file|mimes:pdf,jpg,png',
        ]);
    }

    // Método para actualizar cualquier paso judicial
    public function updateStep(Request $request, $tasacion_id, $step, $view, $rules)
    {
        $tasacion = Tasacion::find($tasacion_id);
        $judicial = $this->getJudicialTasacion($tasacion_id);

        // Si ya completó el paso, redirigir al siguiente paso
        if ($tasacion->estado == 'step' . $step) {
            // Si estamos en el último paso (step10), finalizar
            if ($step == 10) {
                return $this->finish($tasacion_id);
            }
            return redirect()->route('judicial.step' . ($step + 1), ['tasacion_id' => $tasacion->id]);
        }

        if ($request->isMethod('get')) {
            return view("judicial.$view", compact('judicial'));
        }

        $validated = $request->validate($rules);

        // Manejo de archivos en cada paso
        if ($request->hasFile('boletin_archivo')) {
            $filename = uniqid() . '.' . $request->file('boletin_archivo')->getClientOriginalExtension();
            $validated['boletin_archivo'] = $request->file('boletin_archivo')->storeAs('documents', $filename);
        }

        if ($request->hasFile('archivo_observaciones')) {
            $filename = uniqid() . '.' . $request->file('archivo_observaciones')->getClientOriginalExtension();
            $validated['archivo_observaciones'] = $request->file('archivo_observaciones')->storeAs('documents', $filename);
        }

        // Actualizar los datos judiciales
        $judicial->fill($validated);
        $judicial->estado = 'step' . $step; // Actualiza el estado según el paso
        $judicial->save();

        // Actualizar el estado de la tasación en la tabla principal
        $tasacion->estado = 'step' . $step;
        $tasacion->save();

        // Si estamos en el último paso, llamamos al método `finish`
        if ($step == 10) {
            return $this->finish($tasacion_id);
        }

        // Redirigir al siguiente paso
        return redirect()->route("judicial.step" . ($step + 1), ['tasacion_id' => $tasacion->id]);
    }

    public function finish($tasacion_id)
    {
        $tasacion = Tasacion::find($tasacion_id);

        if (!$tasacion) {
            return redirect()->route('appraisals.index')->with('error', 'Tasación no encontrada.');
        }

        // Marcar la tasación como finalizada
        $tasacion->estado = 'completed_judicial';
        $tasacion->save();

        return redirect()->route('appraisals.index')->with('success', 'El proceso judicial ha sido completado exitosamente.');
    }

    public function finalize($tasacion_id)
    {
        $tasacion = Tasacion::findOrFail($tasacion_id);
        $tasacionJudicial = TasacionJudicial::where('tasacion_id', $tasacion_id)->first();

        if (!$tasacionJudicial) {
            return redirect()->route('appraisals.index')->with('error', 'No se encontró la tasación judicial.');
        }

        if ($tasacionJudicial->estado == 'step10') {
            $tasacionJudicial->estado = 'pagada';
            $tasacionJudicial->save();

            // Asegurar que en la vista no se intente calcular un step
            $tasacion->estado = 'pagada';
            $tasacion->save();

            return redirect()->route('appraisals.index')->with('success', 'La tasación judicial ha sido finalizada.');
        }

        return redirect()->route('appraisals.index')->with('error', 'Esta tasación judicial no está en el último paso y no puede ser finalizada.');
    }

}
