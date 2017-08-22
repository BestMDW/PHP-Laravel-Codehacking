<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /******************************************************************************************************************/

    /**
     * Accessor for the "Name" column.
     *
     * @param $name
     * @return string
     */
    public function getNameAttribute($name) {
        return ucfirst($name);
    }
}
