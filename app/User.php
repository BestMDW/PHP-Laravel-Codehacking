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
        'role_id', 'is_active', 'name', 'email', 'password', 'photo_id',
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
     * Possible options for the status field.
     * [0 - Not Active, 1 - Active]
     *
     * @var array
     */
    protected static $statusFieldOptions = [
        1 => 'Active',
        0 => 'Not Active'
    ];

    /**
     * Eloquent One to One relation for the role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role() {
        return $this->belongsTo('App\Role');
    }

    /**
     * Eloquent One to One relation for the photo.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function photo() {
        return $this->belongsTo('App\Photo');
    }

    /**
     * Get and return as array available status options.
     *
     * @return array
     */
    public static function getStatusOptions() {
        return self::$statusFieldOptions;
    }

    /**
     * Mutator for the password field, protects password in the database.
     *
     * @param $photo - Password to save in the database.
     */
    public function setPasswordAttribute($photo) {
        $this->attributes['password'] = bcrypt($photo);
    }
}
