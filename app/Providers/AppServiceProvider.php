<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Form;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $compPrefix = 'vspot';
        $formCompPath = 'backend.components.forms.';
        // form components
        Form::component($compPrefix.'Text', $formCompPath.'text', ['name', 'label' => null, 'value' => null, 'attributes' => []]);
        Form::component($compPrefix.'Email', $formCompPath.'email', ['name', 'label' => null, 'value' => null, 'attributes' => []]);
        Form::component($compPrefix.'Password', $formCompPath.'password', ['name', 'label' => null, 'value' => null, 'attributes' => []]);
        Form::component($compPrefix.'Submit', $formCompPath.'btn-submit', ['text' => 'Speichern']);
        Form::component($compPrefix.'Back', $formCompPath.'btn-back', ['text' => 'Zurück']);
    }
}
