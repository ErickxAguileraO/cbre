<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Pregunta;
use Livewire\WithFileUploads;
use App\Models\ArchivoFormulario;
use Illuminate\Support\Facades\Storage;

class UploadFileModal extends Component
{
    use WithFileUploads;
    protected $listeners = ['uploadFileModal'];
    public $files = [];
    public $preguntaId;

    public function render()
    {
        return view('livewire.upload-file-modal',[
            'archivos' => ArchivoFormulario::where('arcf_pregunta_id', $this->preguntaId)->get(),
        ]);
    }

    public function uploadFileModal($preguntaId){
        $this->preguntaId = $preguntaId;
        $this->files = [];
        $this->dispatchBrowserEvent('show-uploadFileModal');
    }

    public function updatedFiles()
    {
        foreach ($this->files as $file) {
            $archivo = new ArchivoFormulario();
            $archivo->arcf_pregunta_id = $this->preguntaId;

            $storedFile = $file->store('public/archivos/'.Pregunta::findOrFail($this->preguntaId)->formulario->form_id.'/preguntas/'.$this->preguntaId);

            $archivo->arcf_url = $storedFile;
            $archivo->arcf_nombre_original = $file->getClientOriginalName();
            $archivo->save();
            $this->files = [];
        }
    }

    public function deleteFile($archivoId){
        $archivo = ArchivoFormulario::findOrFail($archivoId);
        Storage::delete($archivo->arcf_url);
        $archivo->delete();
    }

}
