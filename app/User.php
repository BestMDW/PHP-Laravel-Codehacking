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

    /******************************************************************************************************************/

    /**
     * Eloquent One to One relation for the role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role() {
        return $this->belongsTo('App\Role');
    }

    /******************************************************************************************************************/

    /**
     * Eloquent One to One relation for the photo.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function photo() {
        return $this->belongsTo('App\Photo');
    }

    /******************************************************************************************************************/

    /**
     * Eloquent One to Many relation for the posts.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts() {
        return $this->hasMany('App\Post');
    }

    /******************************************************************************************************************/

    /**
     * Get and return as array available status options.
     *
     * @return array
     */
    public static function getStatusOptions() {
        return self::$statusFieldOptions;
    }

    /******************************************************************************************************************/

    /**
     * Checks if user has administrator role.
     *
     * @return bool
     */
    public function isAdmin() {
        // Check if user role is administrator.
        if ($this->role && $this->role->name == "Administrator" && $this->is_active == 1) {
            // Return true if is administrator.
            return true;
        }

        // Return false if not administrator.
        return false;
    }

    /******************************************************************************************************************/

    /**
     * Generates gravatar for the User.
     *
     * @return string
     */
    public function getGravatarAttribute()
    {
        $hash = md5(strtolower(trim($this->attributes['email']))) . "?d=mm";

        return "https://www.gravatar.com/avatar/$hash";
    }
}
