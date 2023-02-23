<?php
 
namespace App\Views\Composers;
 
use App\Models\Caracteristica;
use Illuminate\View\View;
 
class CaracteristicaComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('caracteristicas', Caracteristica::where('car_estado', 1)->get());
    }
}