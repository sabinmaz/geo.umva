<?php

namespace Geo\Http\Controllers\api;

use Geo\Models\Country;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Http\Request;
use Geo\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CountryController extends Controller
{
    //
    public function getAllCountries()
    {
        try{
         return Country::all()->toArray();
        }
        catch(\Exception $e)
        {
            throw $e;
        }
    }

    public function getAllCountriesMinData()
    {
        try{
            return Country::all(['id','country_name','iso2','iso3'])->toArray();
        }
        catch(\Exception $e)
        {
            throw $e;
        }
    }

    public function getCountryByName($country)
    {
        try{
            return Country::all()->where('country_name','=',$country)->first()->toArray();
        }
        catch(\Exception $e)
        {
            throw $e;
        }
    }
}
