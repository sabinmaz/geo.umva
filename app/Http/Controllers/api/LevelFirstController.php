<?php

namespace Geo\Http\Controllers\api;

use Geo\Models\Admin_area1;
use Geo\Models\Admin_area2;
use Geo\Models\Country;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Http\Request;
use Geo\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class LevelFirstController extends Controller
{
    //
    public function getAllProvince($country)
    {
        try{

            $countrydata=Country::all()->where('country_name','=',$country)->first()->toArray();
            //return $countrydata['id'];
            return Admin_area1::Where('country_id','=',$countrydata['id'])->get()->toArray();
        }
        catch(\Exception $e)
        {
            throw $e;
        }
    }

    public function getProvinceByCountryAndName($country,$state)
    {
        try{
            $countrydata= Country::all()->where('country_name','=',$country)->first()->toArray();
            return Admin_area1::Where('country_id','=',$countrydata['id'])
                ->where('name','=',$state)
                ->first()
                ->toArray();
        }
        catch(\Exception $e)
        {
            throw $e;
        }
    }
    public function getCommuneByCountryAndState($country,$state)
    {
        try{
            $countrydata= Country::all()->where('country_name','=',$country)->first()->toArray();
            $statedata= Admin_area1::all()->where('country_id','=',$countrydata['id'])
                ->where('name','=',$state)
                ->first()
                ->toArray();
            return Admin_area2::Where('area1_id','=',$statedata['id'])->get()->toArray();
        }
        catch(\Exception $e)
        {
            throw $e;
        }
    }
}
