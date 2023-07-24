<?php

namespace App\Http\Livewire\Administracion\Formulario;

use Livewire\Component;
use App\Models\Pregunta;
use Livewire\WithFileUploads;
use App\Models\ArchivoFormulario;
use App\Services\ArchivoService;
use Illuminate\Support\Facades\Storage;

class UploadFileModal extends Component
{
    use WithFileUploads;
    protected $listeners = ['uploadFileModal'];
    public $files = [];
    public $preguntaId;

    public function render()
    {
        return view('admin.formulario_area_tecnica.livewire.upload-file-modal',[
            'archivos' => ArchivoFormulario::where('arcf_pregunta_id', $this->preguntaId)->get(),
        ]);
    }

    public function uploadFileModal($preguntaId){
        sleep(1);
        $this->preguntaId = $preguntaId;
        $this->files = [];
        $this->dispatchBrowserEvent('show-uploadFileModal');
    }

    public function updatedFiles()
    {
        sleep(1);
        foreach ($this->files as $file) {
            $archivo = new ArchivoFormulario();
            $archivo->arcf_pregunta_id = $this->preguntaId;

            $storedFile = ArchivoService::subirArchivos($file, Pregunta::findOrFail($this->preguntaId)->formulario->form_id, $this->preguntaId, 'pregunta');

            $archivo->arcf_url = $storedFile;
            $archivo->arcf_nombre_original = $file->getClientOriginalName();
            $archivo->save();
        }
        $this->files = [];
        $this->emit('refreshPregunta');
    }

    public function deleteFile($archivoId){
        sleep(1);
        $archivo = ArchivoFormulario::findOrFail($archivoId);
        Storage::delete($archivo->arcf_url);
        $archivo->delete();
        $this->emit('refreshPregunta');
    }

}
