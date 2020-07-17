<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission_role extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'permission_role';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['permission_id', 'role_id'];


}
