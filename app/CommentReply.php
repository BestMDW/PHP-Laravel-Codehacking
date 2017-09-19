<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'comment_id', 'is_active', 'author', 'email', 'body', 'photo'
    ];

    /******************************************************************************************************************/

    /**
     * Eloquent One to One relation for the comments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function comment()
    {
        return $this->belongsTo('App\Comment');
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
