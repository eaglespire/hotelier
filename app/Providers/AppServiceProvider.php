<?php

namespace App\Providers;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

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
        Builder::macro('search', function ($fields, $string){
            if ($string){
                foreach ($fields as $field){
                    $this->orWhere($field,'LIKE',"%$string%");
                }
            }
            return $this;
        });
        Str::macro('slugger', function ($string = 'slugger'){
            return substr(md5($string),1);
        });
    }
}
