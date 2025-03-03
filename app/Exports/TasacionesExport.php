<?php

namespace App\Exports;

use App\Models\Tasacion;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;

class TasacionesExport implements FromCollection, WithHeadings
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $query = Tasacion::query();

        // Aplicar filtros según los checkboxes seleccionados
        if ($this->request->has('fechaDesde') && $this->request->has('fechaHasta')) {
            $query->whereBetween('created_at', [$this->request->fechaDesde, $this->request->fechaHasta]);
        }

        $columns = [];
        if ($this->request->has('nomenclatura')) $columns[] = 'nomenclatura';
        if ($this->request->has('inscripcion_dominio')) $columns[] = 'inscripcion_dominio';
        if ($this->request->has('ubicacion')) $columns[] = 'ubicacion';
        if ($this->request->has('nro_plano')) $columns[] = 'nro_plano';
        if ($this->request->has('estado')) $columns[] = 'estado';

        return $query->get($columns);
    }

    public function headings(): array
    {
        return ['Nomenclatura', 'Inscripción de Dominio', 'Ubicación', 'Nro Plano', 'Estado'];
    }
}
