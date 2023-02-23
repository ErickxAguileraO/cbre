<?php
 
namespace App\Views\Composers;
 
use App\Models\Certificacion;
use Illuminate\View\View;
 
class CertificacionComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('certificaciones', Certificacion::where('cer_estado', 1)->get());
    }
}