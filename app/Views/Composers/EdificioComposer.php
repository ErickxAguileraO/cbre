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


        /**
     * Bind active Edificio data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function orderByName(View $view)
    {
        $view->with('edificios', Edificio::orderBy('edi_nombre')->get());
    }
}
