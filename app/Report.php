<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'reports';

    public function groups(){
        return $this->belongsToMany('App\Project_group','reports_groups','report_id','group_id');
    }

    public function tags(){
        return $this->belongsToMany('App\Tag','tags_reports');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['content', 'file', 'name', 'picture', 'sound'];

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
