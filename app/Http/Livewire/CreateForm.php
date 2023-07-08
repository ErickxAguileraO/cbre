<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Pregunta;
use App\Models\Formulario;
use App\Models\Opcion;

class CreateForm extends Component
{
    public $formId;
    public $form_nombre;
    public $form_descripcion;

    public $pre_pregunta = [];
    public $opc_opcion = [];

    public function render()
    {
        return view('livewire.create-form',[
            'formulario' => Formulario::findOrFail($this->formId),
        ]);
    }

    public function updateFormInfo(){
        $formulario = Formulario::findOrFail($this->formId);
        $formulario->form_nombre = empty($this->form_nombre) ? '' : $this->form_nombre;
        $formulario->form_descripcion = empty($this->form_descripcion) ? '' : $this->form_descripcion;
        $formulario->update();
    }

    public function createNewPregunta(){
        $pregunta = new Pregunta();
        $pregunta->pre_formulario_id = $this->formId;
        $pregunta->pre_tipo_pregunta_id = 1;
        $pregunta->pre_pregunta = '';
        $pregunta->pre_obligatorio = 1;
        $pregunta->save();

        $opcion = new Opcion();
        $opcion->opc_pregunta_id = $pregunta->pre_id;
        $opcion->opc_opcion = '';
        $opcion->save();
    }

    public function changePreguntaType($preguntaId, $value){
        $pregunta = Pregunta::findOrfail($preguntaId);
        $pregunta->pre_tipo_pregunta_id = $value;
        $pregunta->update();
    }

    public function deletePregunta($preguntaId){
        $pregunta = Pregunta::findOrfail($preguntaId);
        $pregunta->opciones()->delete();
        $pregunta->delete();
    }

    public function updatePreguntaTitle($preguntaId){
        $pregunta = Pregunta::findOrfail($preguntaId);
        $pregunta->pre_pregunta = end($this->pre_pregunta);
        $pregunta->update();
    }

    public function switchPreguntaRequired($preguntaId){
        $pregunta = Pregunta::findOrfail($preguntaId);

        if($pregunta->pre_obligatorio == 1){
            $pregunta->pre_obligatorio = 0;
        }else{
            $pregunta->pre_obligatorio = 1;
        }
        $pregunta->update();
    }

    public function addNewOption($preguntaId){
        $opcion = new Opcion();
        $opcion->opc_pregunta_id = $preguntaId;
        $opcion->opc_opcion = '';
        $opcion->save();
    }

    public function deleteOption($optionId){
        $opcion = Opcion::findOrfail($optionId);
        $opcion->delete();
    }

    public function updateOptionTitle($optionId){
        $opcion = Opcion::findOrfail($optionId);
        $opcion->opc_opcion = end($this->opc_opcion);
        $opcion->update();
    }

}
