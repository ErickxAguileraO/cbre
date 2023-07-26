<?php

namespace App\Exports;

use App\Models\Formulario;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RespuestasExport implements FromCollection, WithHeadings, WithStyles
{
    protected $formulario;
    protected $area;

    public function __construct(Formulario $formulario, $area)
    {
        $this->formulario = $formulario;
        $this->area = $area;
    }

    public function collection()
    {
        return new Collection($this->generateData());
    }

    public function headings(): array
    {
        return [];
    }

    public function styles(Worksheet $sheet)
    {
        $lastColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString('F');
        $questionCount = count($this->formulario->preguntas);
        $questionLastColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($questionCount + 1);
        $questionRange = "A6:{$questionLastColumnIndex}6";

        // Estilo para el encabezado de formulario y área
        $sheet->getStyle('A1:A3')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
        ]);

        // Estilo para la fecha de envío
        $sheet->getStyle('A3')->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_DDMMYYYY);

        // Estilo para el encabezado de edificios y preguntas
        $sheet->getStyle('A6:' . $questionLastColumnIndex . '6')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 12, // Tamaño de fuente normal
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'cccccc'], // Color de fondo gris (hex: #808080)
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT, // Alineación izquierda
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER, // Alineación vertical centrada
            ],
        ]);

        // Aplicar el color de relleno #d9d9d9 a la columna A desde la fila 7 hacia abajo
        $sheet->getStyle('A7:A' . $sheet->getHighestRow())->applyFromArray([
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'd9d9d9'], // Color de fondo gris (hex: #d9d9d9)
            ],
        ]);

        // Ajustar el ancho de las columnas
        foreach (range('A', $questionLastColumnIndex) as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }
    }

    private function generateData()
    {
        $data = [];

        // Encabezados fijos
        $data[] = ['Nombre Formulario', $this->formulario->form_nombre];
        $data[] = ['Área', $this->area];
        $data[] = ['Fecha de envío', $this->formulario->updated_at];
        $data[] = [''];
        $data[] = [''];
        $data[] = ['Edificio'];

        // Encabezados de preguntas
        $preguntas = $this->formulario->preguntas;
        $data[5] = array_merge($data[5], $preguntas->pluck('pre_pregunta')->toArray());

        // Resto del contenido (filas de datos)
        foreach ($this->formulario->formulariosEdificio as $formEdificio) {
            $row = [$formEdificio->edificio->edi_nombre];

            foreach ($preguntas as $pregunta) {
                $respuestaTexto = $this->getRespuestaTexto($pregunta, $formEdificio);
                $row[] = $respuestaTexto;
            }

            $data[] = $row;
        }

        return $data;
    }

    private function getRespuestaTexto($pregunta, $formEdificio)
    {
        $respuesta = $pregunta->respuestas->where('res_formulario_edificio_id', $formEdificio->foredi_id)->first();
        if ($respuesta) {
            $opciones = $respuesta->opciones->pluck('opc_opcion')->implode(', ');
            if (!empty($opciones)) {
                return $opciones;
            } else {
                return $respuesta->res_respuesta;
            }
        }
        return '';
    }
}
