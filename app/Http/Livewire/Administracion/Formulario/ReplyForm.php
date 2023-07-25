<?php

namespace App\Http\Livewire\Administracion\Formulario;

use App\Models\Opcion;
use Livewire\Component;
use App\Models\Pregunta;
use App\Models\Respuesta;
use App\Models\Formulario;
use Livewire\WithFileUploads;
use App\Services\ArchivoService;
use App\Models\FormularioEdificio;
use App\Models\Obersacion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

    public $preguntaHSEIdTemp;

    public function render()
    {
        return view('admin.formularios_jop.livewire.reply-form',[
            'formulario' => Formulario::findOrFail($this->formId),
        ]);
    }

 /*    public function mount(){
        //$this->validates();
    }

    public function validates(){
        $this->validate([
            'res_parrafo' => 'required|max:50',
            'res_dotacion' => 'required|max:50',
            'res_dotacion_sub_contratos' => 'required|max:50',
            'res_dotacion_nuevos' => 'required|max:50',
            'res_documentacion_sub_contrato' => 'required|max:50',
        ]);
    } */

    public function uploadFileModalRespuesta($preguntaId){
        usleep(config('fake-delay.file_gestor'));

        $this->emit('uploadFileModalRespuesta', $preguntaId);
    }

    public function selectOption($optionId){
        usleep(config('fake-delay.general'));

        try {
            $opcion = Opcion::findOrFail($optionId);
            $respuesta = Respuesta::where('res_pregunta_id', $opcion->pregunta->pre_id)
            ->where('res_formulario_edificio_id', FormularioEdificio::where('foredi_formulario_id', $this->formId)->where('foredi_edificio_id', Auth::user()->funcionario->edificio->edi_id)->first()->foredi_id)
            ->first();

            $respuesta->opciones()->detach();
            $respuesta->opciones()->attach($opcion);
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    public function selectCheckbox($optionId){
        usleep(config('fake-delay.general'));

        try {
            $opcion = Opcion::findOrFail($optionId);
            $respuesta = Respuesta::where('res_pregunta_id', $opcion->pregunta->pre_id)
            ->where('res_formulario_edificio_id', FormularioEdificio::where('foredi_formulario_id', $this->formId)->where('foredi_edificio_id', Auth::user()->funcionario->edificio->edi_id)->first()->foredi_id)
            ->first();

            $respuesta->opciones()->detach();
            $respuesta->opciones()->attach($this->selectedCheckboxes);
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    public function updateParrafo($preguntaId){
        usleep(config('fake-delay.general'));

        try {
            $respuesta = Respuesta::where('res_pregunta_id', $preguntaId)
            ->where('res_formulario_edificio_id', FormularioEdificio::where('foredi_formulario_id', $this->formId)->where('foredi_edificio_id', Auth::user()->funcionario->edificio->edi_id)->first()->foredi_id)
            ->first();
            $respuesta->res_parrafo = $this->res_parrafo;
            $respuesta->update();
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    public function updateHSE($preguntaId){
        usleep(config('fake-delay.general'));

        try {
            $respuesta = Respuesta::where('res_pregunta_id', $preguntaId)
            ->where('res_formulario_edificio_id', FormularioEdificio::where('foredi_formulario_id', $this->formId)->where('foredi_edificio_id', Auth::user()->funcionario->edificio->edi_id)->first()->foredi_id)
            ->first();

            $respuesta->res_mes = empty($this->res_mes) ? null : $this->res_mes;
            $respuesta->res_ano = empty($this->res_ano) ? null : $this->res_ano;
            $respuesta->res_dotacion = empty($this->res_dotacion) ? null : $this->res_dotacion;
            $respuesta->res_dotacion_sub_contratos = empty($this->res_dotacion_sub_contratos) ? null : $this->res_dotacion_sub_contratos;
            $respuesta->res_dotacion_nuevos = empty($this->res_dotacion_nuevos) ? null : $this->res_dotacion_nuevos;
            $respuesta->res_documentacion_sub_contrato = empty($this->res_documentacion_sub_contrato) ? 0 : $this->res_documentacion_sub_contrato;

            $respuesta->update();
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    public function updateHSEfiles($preguntaId){
        usleep(config('fake-delay.general'));

        try {
            $this->preguntaHSEIdTemp = $preguntaId;
            $respuesta = Respuesta::where('res_pregunta_id', $preguntaId)
            ->where('res_formulario_edificio_id', FormularioEdificio::where('foredi_formulario_id', $this->formId)->where('foredi_edificio_id', Auth::user()->funcionario->edificio->edi_id)->first()->foredi_id)
            ->first();
            if($this->res_documento_accidentabilidad){
                Storage::delete($respuesta->res_documento_accidentabilidad);
                $respuesta->res_documento_accidentabilidad = empty($this->res_documento_accidentabilidad) ? null : ArchivoService::subirArchivos($this->res_documento_accidentabilidad, Pregunta::findOrFail($preguntaId)->formulario->form_id, $respuesta->res_id, 'respuesta');
            }
             if($this->res_documentacion){
                Storage::delete($respuesta->res_documentacion);
                $respuesta->res_documentacion = empty($this->res_documentacion) ? null : ArchivoService::subirArchivos($this->res_documentacion, Pregunta::findOrFail($preguntaId)->formulario->form_id, $respuesta->res_id, 'respuesta');
            }
            $respuesta->update();
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }

    }

    public function checkThemAll(){
        if($this->preguntaHSEIdTemp){
            $this->updateHSEfiles($this->preguntaHSEIdTemp);
        }
        $this->dispatchBrowserEvent('fireSwal');
    }


}
