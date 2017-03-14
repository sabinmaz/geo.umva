<?php

namespace Geo\Http\Controllers\api;

use Geo\GeoSoap;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Http\Request;
use Geo\Http\Controllers\Controller;

class GeoController extends Controller
{
    //
    public function getStates($country)
    {
        try{
            $soap =new GeoSoap();

            $data= $soap->__call('address_getProvience',array($country));
           return $data;
        }
        catch(\Exception $e)
        {
            throw $e;
        }
    }
    public function getCommune($country,$state)
    {
        try{
            $soap =new GeoSoap();

            $data= $soap->__call('address_getCommune',array($country,$state));
            return $data;
        }
        catch(\Exception $e)
        {
            throw $e;
        }
    }

    public function getZone($country,$state,$commune)
    {
        try{
            $soap =new GeoSoap();

            $data= $soap->__call('address_getZone',array($country,$state,$commune));
            return $data;
        }
        catch(\Exception $e)
        {
            throw $e;
        }
    }

    public function getCity($country,$state,$commune,$zone)
    {
        try{
            $soap =new GeoSoap();
            $data= $soap->__call('address_getColline',array($country,$state,$commune,$zone));
            return $data;
        }
        catch(\Exception $e)
        {
            throw $e;
        }
    }
}
