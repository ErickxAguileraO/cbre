<?php

namespace App\Http\Livewire\Administracion\Formulario;

use Livewire\Component;
use App\Models\Pregunta;
use App\Models\Respuesta;
use Livewire\WithFileUploads;
use App\Services\ArchivoService;
use App\Models\ArchivoFormulario;
use App\Models\FormularioEdificio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UploadFileModalRespuesta extends Component
{
    use WithFileUploads;
    protected $listeners = ['uploadFileModalRespuesta'];
    public $files = [];
    public $respuestaId;
    public $formId;

    public function render()
    {
        return view('admin.formularios_jop.livewire.upload-file-modal-respuesta',[
            'archivos' => ArchivoFormulario::where('arcf_respuesta_id', $this->respuestaId)->get(),
        ]);
    }

    public function uploadFileModalRespuesta($preguntaId){
        sleep(1);
        $this->respuestaId = Respuesta::where('res_pregunta_id', $preguntaId)
        ->where('res_formulario_edificio_id', FormularioEdificio::where('foredi_formulario_id', $this->formId)->where('foredi_edificio_id', Auth::user()->funcionario->edificio->edi_id)->first()->foredi_id)
        ->first()->res_id;
        $this->files = [];
        $this->dispatchBrowserEvent('show-uploadFileModalRespuesta');
    }

    public function updatedFiles()
    {
        sleep(1);
        foreach ($this->files as $file) {
            $archivo = new ArchivoFormulario();
            $archivo->arcf_respuesta_id = $this->respuestaId;

            $storedFile = ArchivoService::subirArchivos($file, Respuesta::findOrFail($this->respuestaId)->pregunta->formulario->form_id, Respuesta::findOrFail($this->respuestaId)->res_id, 'respuesta');

            $archivo->arcf_url = $storedFile;
            $archivo->arcf_nombre_original = $file->getClientOriginalName();
            $archivo->save();
        }
        $this->files = [];
        $this->emit('refreshRespuesta');
    }

    public function deleteFile($archivoId){
        sleep(1);
        $archivo = ArchivoFormulario::findOrFail($archivoId);
        Storage::delete($archivo->arcf_url);
        $archivo->delete();
        $this->emit('refreshRespuesta');
    }
}
