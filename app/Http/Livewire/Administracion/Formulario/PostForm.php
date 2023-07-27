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
            'edificios' => Edificio::orderBy('edi_nombre')->get(),
            'formulario' => Formulario::findOrFail($this->formId),
        ]);
    }

    public function attachEdificio($edificioId){
        usleep(config('fake-delay.attach_edificio'));

        try {
            if($edificioId){
                if($edificioId == 'todos'){
                    $this->selectedEdificioId = $edificioId;
                    $formulario = Formulario::findOrFail($this->formId);
                    $formulario->edificios()->attach(Edificio::orderBy('edi_nombre')->get());
                }else{
                    $this->selectedEdificioId = $edificioId;
                    $formulario = Formulario::findOrFail($this->formId);
                    $formulario->edificios()->attach(Edificio::findOrFail($edificioId));
                }
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    public function detachEdificio($edificioId){
        usleep(config('fake-delay.attach_edificio'));

        try {
            $formulario = Formulario::findOrFail($this->formId);
            $formulario->edificios()->detach(Edificio::findOrFail($edificioId));
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    public function detachAll(){
        usleep(config('fake-delay.attach_edificio'));

        try {
            $formulario = Formulario::findOrFail($this->formId);
            $formulario->edificios()->detach();
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
}
