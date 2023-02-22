<?php

namespace App\Mixins;

use Carbon\Carbon;
use Illuminate\Support\Str;

class StrMixins
{
    public function slugger()
    {
        return function ($slugger = 'slugger'){
            return substr(md5($slugger),1);
        };
    }
    public function staff()
    {
        return function ($age,$doe,$role){
            // Extract first three letters of the application name
            $appName = substr(config('app.name'),0,3);
            //Get the year the staff was hired in 2 digit format
            $yr = substr(Carbon::parse($doe)->year,2,2);

            //Get the staff DOB in 2 digit format
            $dob = Carbon::now()->subYears($age);
            $staffDOB = substr($dob->year,2,2);

            //Extract first three letters from the role
            $rol = substr($role,0,3);
            //Time
            $time = substr(time(),6);
            return strtoupper($appName.$rol.$yr.$staffDOB.$time);
        };
    }
}
