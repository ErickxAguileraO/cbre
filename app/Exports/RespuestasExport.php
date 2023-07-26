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
        $data[] = ['Fecha de envío', $this->formulario->fecha];
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
            // Verificar el tipo de pregunta y obtener la respuesta correspondiente
            switch ($pregunta->tipoPregunta->tipp_id) {
                case 1: // Seleccion individual
                    $opciones = $respuesta->opciones->pluck('opc_opcion')->implode(', ');
                    return (!empty($opciones)) ? $opciones : $respuesta->res_respuesta;
                case 2: // Seleccion multiple
                    $opciones = $respuesta->opciones->pluck('opc_opcion')->implode(', ');
                    return (!empty($opciones)) ? $opciones : '';
                case 3: // Parrafo
                    return $respuesta->res_parrafo;
                    case 4: // HSE
                        $mesEvaluacion = $this->getNombreMes($respuesta->res_mes);
                        $alDia = $this->getAlDia($respuesta->res_documentacion_sub_contrato);
                        return implode(', ', [
                            'Mes de evaluación: ' . $mesEvaluacion,
                            'Año: ' . $respuesta->res_ano,
                            'Dotación: ' . $respuesta->res_dotacion,
                            'Dotación sub contratos: ' . $respuesta->res_dotacion_sub_contratos,
                            '¿Cuántos de estos son nuevos?: ' . $respuesta->res_dotacion_nuevos,
                            '¿Todos tienen documentación de sub contratación al día?: ' . $alDia,
                        ]);
                    default:
                    return '';
            }
        }

        return '';
    }

    private function getNombreMes($mesNumero)
    {
        $meses = [
            1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
            5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
            9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre',
        ];

        return $meses[$mesNumero] ?? '';
    }

    private function getAlDia($alternativa)
    {
        $alDia = [
            0 => 'No', 1 => 'Si',
        ];

        return $alDia[$alternativa] ?? '';
    }
}
