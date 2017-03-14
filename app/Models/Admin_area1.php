<?php

namespace Geo\Models;

use Illuminate\Database\Eloquent\Model;

class Admin_area1 extends Model  {

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'admin_area1';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'code', 'country_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];

}