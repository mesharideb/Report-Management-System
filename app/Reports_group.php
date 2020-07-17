<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reports_group extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'reports_groups';

    public function groups(){
        return $this->belongsTo('App\Project_group');
    }

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['group_id', 'report_id'];

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
    protected $dates = ['failed_at'];

}
