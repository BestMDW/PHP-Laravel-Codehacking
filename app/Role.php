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

    /**
     * Accessor for the "Name" column.
     *
     * @param $value
     * @return string
     */
    public function getNameAttribute($value) {
        return ucfirst($value);
    }
}
