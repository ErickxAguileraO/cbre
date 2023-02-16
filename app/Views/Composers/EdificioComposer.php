<?php
 
namespace App\Views\Composers;
 
use App\Models\Edificio;
use Illuminate\View\View;
 
class EdificioComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('edificios', Edificio::all());
    }
}