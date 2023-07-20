<?php

namespace App\Http\Livewire\Administracion\Formulario;

use App\Models\Opcion;
use Livewire\Component;
use App\Models\Pregunta;
use App\Models\Formulario;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class CreateForm extends Component
{
    public $formId;
    public $form_nombre;
    public $form_descripcion;

    public $pre_pregunta = [];
    public $opc_opcion = [];

    protected $listeners = ['refreshPregunta' => 'render'];

    public function render()
    {
        $this->dispatchBrowserEvent('fireSwalDoneRequest');
        return view('admin.formulario_area_tecnica.livewire.create-form',[
            'formulario' => Formulario::findOrFail($this->formId),
        ]);
    }

    public function mount(){
        $this->validate([
            'form_nombre' => 'required|max:50',
        ]);
    }

    public function uploadFileModal($preguntaId){
        $this->emit('uploadFileModal', $preguntaId);
    }

    public function updateFormInfo(){
        $this->validate([
            'form_nombre' => 'required|max:50',
        ]);
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

    public function changePreguntaType($preguntaId, $preguntaTypeId){
        $pregunta = Pregunta::findOrfail($preguntaId);
        $pregunta->pre_tipo_pregunta_id = $preguntaTypeId;
        $pregunta->update();
    }

    public function deletePregunta($preguntaId){
        $pregunta = Pregunta::findOrfail($preguntaId);
        $pregunta->opciones()->delete();

        $archivosFormulario = $pregunta->archivosFormulario;
        foreach ($archivosFormulario as $archivo) {
            Storage::delete($archivo->arcf_url);
        }

        $pregunta->archivosFormulario()->delete();
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
        $opcion->opc_opcion = $this->opc_opcion[$optionId];
        $opcion->update();
    }

}
