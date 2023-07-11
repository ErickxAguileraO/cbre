<?php

namespace App\Http\Livewire\Administracion\Formulario;

use Livewire\Component;
use App\Models\Edificio;
use App\Models\Formulario;

class PostForm extends Component
{
    public $formId;
    public $selectedEdificioId;
    protected $listeners = ['attachEdificio'];

    public function render()
    {
        return view('admin.formulario_area_tecnica.livewire.post-form',[
            'edificios' => Edificio::all(),
            'formulario' => Formulario::findOrFail($this->formId),
        ]);
    }

    public function attachEdificio($edificioId){
        if($edificioId){
            $this->selectedEdificioId = $edificioId;
            $formulario = Formulario::findOrFail($this->formId);
            $formulario->edificios()->attach(Edificio::findOrFail($edificioId));
        }
    }

    public function detachEdificio($edificioId){
        $formulario = Formulario::findOrFail($this->formId);
        $formulario->edificios()->detach(Edificio::findOrFail($edificioId));
    }

    public function detachAll(){
        $formulario = Formulario::findOrFail($this->formId);
        $formulario->edificios()->detach();
    }
}
