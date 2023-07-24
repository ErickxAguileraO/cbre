<?php

namespace App\Http\Livewire\Administracion\Formulario;

use App\Models\Opcion;
use Livewire\Component;
use App\Models\Pregunta;
use App\Models\Formulario;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class EditForm extends Component
{
    public $formId;
    public $form_nombre;
    public $form_descripcion;

    public $pre_pregunta = [];
    public $opc_opcion = [];

    protected $listeners = ['refreshPregunta' => 'render'];

    public function render()
    {
        return view('admin.formulario_area_tecnica.livewire.edit-form',[
            'formulario' => Formulario::findOrFail($this->formId),
        ]);
    }

    public function mount(){
        $formulario = Formulario::with('preguntas.opciones')->find($this->formId);
        $this->form_nombre = $formulario->form_nombre;
        $this->form_descripcion = $formulario->form_descripcion;

        foreach ($formulario->preguntas as $pregunta) {
            $this->pre_pregunta[$pregunta->pre_id] = $pregunta->pre_pregunta;

            foreach($pregunta->opciones as $opcion){
                $this->opc_opcion[$opcion->opc_id] = $opcion->opc_opcion;
            }
        }

        $this->validate([
            'form_nombre' => 'required|max:50',
        ]);
    }

    public function saveBorrador(){
        sleep(3);
        return redirect()->route('formulario-area-tecnica.index');
    }

    public function uploadFileModal($preguntaId){
        sleep(1);
        $this->emit('uploadFileModal', $preguntaId);
    }

    public function updateFormInfo(){
        sleep(1);
        $this->validate([
            'form_nombre' => 'required|max:50',
        ]);
        $formulario = Formulario::findOrFail($this->formId);
        $formulario->form_nombre = empty($this->form_nombre) ? '' : $this->form_nombre;
        $formulario->form_descripcion = empty($this->form_descripcion) ? '' : $this->form_descripcion;
        $formulario->update();
    }

    public function createNewPregunta(){
        sleep(1);
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
        sleep(1);
        $pregunta = Pregunta::findOrfail($preguntaId);
        $pregunta->pre_tipo_pregunta_id = $preguntaTypeId;
        $pregunta->update();
    }

    public function deletePregunta($preguntaId){
        sleep(1);
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
        sleep(1);
        $pregunta = Pregunta::findOrfail($preguntaId);
        $pregunta->pre_pregunta = end($this->pre_pregunta);
        $pregunta->update();
    }

    public function switchPreguntaRequired($preguntaId){
        sleep(1);
        $pregunta = Pregunta::findOrfail($preguntaId);
        if($pregunta->pre_obligatorio == 1){
            $pregunta->pre_obligatorio = 0;
        }else{
            $pregunta->pre_obligatorio = 1;
        }
        $pregunta->update();
    }

    public function addNewOption($preguntaId){
        sleep(1);
        $opcion = new Opcion();
        $opcion->opc_pregunta_id = $preguntaId;
        $opcion->opc_opcion = '';
        $opcion->save();
    }

    public function deleteOption($optionId){
        sleep(1);
        $opcion = Opcion::findOrfail($optionId);
        $opcion->delete();
    }

    public function updateOptionTitle($optionId){
        sleep(1);
        $opcion = Opcion::findOrfail($optionId);
        $opcion->opc_opcion = $this->opc_opcion[$optionId];
        $opcion->update();
    }

}
