<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id', 'photo_id', 'title', 'body'
    ];

    /******************************************************************************************************************/

    /**
     * Eloquent One to One relation for the users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo('App\User');
    }

    /******************************************************************************************************************/

    /**
     * Eloquent One to One relation for the photos.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function photo() {
        return $this->belongsTo('App\Photo');
    }

    /******************************************************************************************************************/

    /**
     * Eloquent One to One relation for the photos.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category() {
        return $this->belongsTo('App\Category');
    }
}
