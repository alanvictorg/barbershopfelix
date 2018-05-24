<?php

namespace App\Http\ViewComposers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;


class GlobalComposer
{

    public function compose(View $view)
    {
        $route = Route::current();
        $rota_atual = $route->uri;

        $view->with('rota_atual', $rota_atual);
    }

}
