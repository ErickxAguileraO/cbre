<?php

namespace App\Http\Livewire\Administracion\Formulario;

use App\Models\Opcion;
use Livewire\Component;
use App\Models\Pregunta;
use App\Models\Respuesta;
use App\Models\Formulario;
use Livewire\WithFileUploads;
use App\Services\ArchivoService;

class ReplyForm extends Component
{
    use WithFileUploads;

    public $formId;

    protected $listeners = ['refreshRespuesta' => 'render'];

    public $selectedCheckboxes = [];
    public $res_parrafo;
    public $res_mes;
    public $res_ano;
    public $res_dotacion; //text
    public $res_documento_accidentabilidad; //file
    public $res_dotacion_sub_contratos; //text
    public $res_dotacion_nuevos; //text
    public $res_documentacion_sub_contrato; //boolean
    public $res_documentacion; //file

    public function render()
    {
        return view('admin.formularios_jop.livewire.reply-form',[
            'formulario' => Formulario::findOrFail($this->formId),
        ]);
    }

    public function uploadFileModalRespuesta($preguntaId){
        $this->emit('uploadFileModalRespuesta', $preguntaId);
    }

    public function selectOption($optionId){
        $opcion = Opcion::findOrFail($optionId);
        $respuesta = Respuesta::where('res_pregunta_id', $opcion->pregunta->pre_id)->first();

        $respuesta->opciones()->detach();
        $respuesta->opciones()->attach($opcion);
    }

    public function selectCheckbox($optionId){
        $opcion = Opcion::findOrFail($optionId);
        $respuesta = Respuesta::where('res_pregunta_id', $opcion->pregunta->pre_id)->first();

        $respuesta->opciones()->detach();
        $respuesta->opciones()->attach($this->selectedCheckboxes);
    }

    public function updateParrafo($preguntaId){
        $pregunta = Pregunta::findOrFail($preguntaId);
        $pregunta->respuesta->res_parrafo = $this->res_parrafo;
        $pregunta->respuesta->update();
    }

    public function updateHSE($preguntaId){
        $respuesta = Respuesta::where('res_pregunta_id', $preguntaId)->first();

        $respuesta->res_mes = empty($this->res_mes) ? null : $this->res_mes;
        $respuesta->res_ano = empty($this->res_ano) ? null : $this->res_ano;
        $respuesta->res_dotacion = empty($this->res_dotacion) ? null : $this->res_dotacion;

        $respuesta->res_documento_accidentabilidad = empty($this->res_documento_accidentabilidad) ? null : ArchivoService::subirArchivos($this->res_documento_accidentabilidad, Pregunta::findOrFail($preguntaId)->formulario->form_id, Pregunta::findOrFail($preguntaId)->pre_id, 'respuesta');

        $respuesta->res_dotacion_sub_contratos = empty($this->res_dotacion_sub_contratos) ? null : $this->res_dotacion_sub_contratos;
        $respuesta->res_dotacion_nuevos = empty($this->res_dotacion_nuevos) ? null : $this->res_dotacion_nuevos;
        $respuesta->res_documentacion_sub_contrato = empty($this->res_documentacion_sub_contrato) ? null : $this->res_documentacion_sub_contrato;

        $respuesta->res_documentacion = empty($this->res_documentacion) ? null : ArchivoService::subirArchivos($this->res_documentacion, Pregunta::findOrFail($preguntaId)->formulario->form_id, Pregunta::findOrFail($preguntaId)->pre_id, 'respuesta');

        $respuesta->update();
    }
}
