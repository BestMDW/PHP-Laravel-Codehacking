<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Eloquent One to One relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role() {
        return $this->belongsTo('App\Role');
    }
}
