<?php
 
namespace App\Views\Composers;
 
use App\Models\SubMercado;
use Illuminate\View\View;
 
class SubmercadoComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('submercados', SubMercado::where('sub_estado', 1)->get());
    }
}