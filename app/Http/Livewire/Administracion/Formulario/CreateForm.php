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

    public $pregunta_tipo = [];

    public function render()
    {
        return view('admin.formulario_area_tecnica.livewire.create-form',[
            'formulario' => Formulario::findOrFail($this->formId),
        ]);
    }

    public function mount(){
        $this->validate([
            'form_nombre' => 'required|max:50',
        ]);
    }

    public function saveBorrador(){
        usleep(config('fake-delay.save'));

        return redirect()->route('formulario-area-tecnica.index');
    }

    public function uploadFileModal($preguntaId){
        usleep(config('fake-delay.file_gestor'));

        $this->emit('uploadFileModal', $preguntaId);
    }

    public function updateFormInfo(){
        usleep(config('fake-delay.general'));

        $this->validate([
            'form_nombre' => 'required|max:50',
        ]);

        try {
            $formulario = Formulario::findOrFail($this->formId);
            $formulario->form_nombre = empty($this->form_nombre) ? '' : $this->form_nombre;
            $formulario->form_descripcion = empty($this->form_descripcion) ? '' : $this->form_descripcion;
            $formulario->update();
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    public function createNewPregunta(){
        usleep(config('fake-delay.general'));

        try {
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
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    public function changePreguntaType($preguntaId){
        usleep(config('fake-delay.general'));

        try {
            $pregunta = Pregunta::findOrfail($preguntaId);
            $pregunta->pre_tipo_pregunta_id = $this->pregunta_tipo[$preguntaId];
            $pregunta->update();
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    public function deletePregunta($preguntaId){
        usleep(config('fake-delay.general'));

        try {
            $pregunta = Pregunta::findOrfail($preguntaId);
            $pregunta->opciones()->delete();

            $archivosFormulario = $pregunta->archivosFormulario;
            foreach ($archivosFormulario as $archivo) {
                Storage::delete($archivo->arcf_url);
            }

            $pregunta->archivosFormulario()->delete();
            $pregunta->delete();
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    public function updatePreguntaTitle($preguntaId){
        usleep(config('fake-delay.general'));

        try {
            $pregunta = Pregunta::findOrfail($preguntaId);
            $pregunta->pre_pregunta = $this->pre_pregunta[$preguntaId];
            $pregunta->update();
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    public function switchPreguntaRequired($preguntaId){
        usleep(config('fake-delay.general'));

        try {
            $pregunta = Pregunta::findOrfail($preguntaId);
            if($pregunta->pre_obligatorio == 1){
                $pregunta->pre_obligatorio = 0;
            }else{
                $pregunta->pre_obligatorio = 1;
            }
            $pregunta->update();
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    public function addNewOption($preguntaId){
        usleep(config('fake-delay.general'));

        try {
            $opcion = new Opcion();
            $opcion->opc_pregunta_id = $preguntaId;
            $opcion->opc_opcion = '';
            $opcion->save();
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    public function deleteOption($optionId){
        usleep(config('fake-delay.general'));

        try {
            $opcion = Opcion::findOrfail($optionId);
            $opcion->delete();
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    public function updateOptionTitle($optionId){
        usleep(config('fake-delay.general'));

        try {
            $opcion = Opcion::findOrfail($optionId);
            $opcion->opc_opcion = $this->opc_opcion[$optionId];
            $opcion->update();
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

}
