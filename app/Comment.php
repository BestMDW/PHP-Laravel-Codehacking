<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_id', 'is_active', 'author', 'email', 'body', 'photo'
    ];

    /******************************************************************************************************************/

    /**
     * Eloquent Many to Many relation for the comments replays.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies($is_active = null)
    {
        return $is_active ? $this->hasMany('App\CommentReply')->whereIsActive($is_active) : $this->hasMany('App\CommentReply');
    }

    /******************************************************************************************************************/

    /**
     * Eloquent One to Many relation for the post.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo('App\Post');
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
