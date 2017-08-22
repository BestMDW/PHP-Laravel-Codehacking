<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    /** Directory for the uploads files. */
    const UPLOAD_DIRECTORY = 'storage/photos';
    /** Placeholder path. */
    const PLACEHOLDER = '/images/default-placeholder-300x300.png';

    //
    protected $fillable = [
        'path'
    ];

    /******************************************************************************************************************/

    /** Accessor for the path attribute, adds directory for the uploaded files. */
    public function getPathAttribute($value) {
        return '/' . Photo::UPLOAD_DIRECTORY . '/' . $value;
    }
}
