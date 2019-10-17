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
        // form components
        Form::component('vspotText', 'form-components.text', ['name', 'label' => null, 'value' => null, 'attributes' => []]);
        Form::component('vspotEmail', 'form-components.text', ['name', 'label' => null, 'value' => null, 'attributes' => []]);
        Form::component('vspotPassword', 'form-components.password', ['name', 'label' => null, 'value' => null, 'attributes' => []]);
        Form::component('vspotSubmit', 'form-components.btn-submit', ['text' => 'Speichern']);
        Form::component('vspotBack', 'form-components.btn-back', ['text' => 'Zurück']);
    }
}
