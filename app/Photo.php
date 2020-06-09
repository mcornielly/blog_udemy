<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Psy\Test\TabCompletion\StaticSample;
use Illuminate\Support\Facades\Storage;

class Photo extends Model
{
    // protected $guarded = [];
    protected $fillable = ['post_id', 'url'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function($photo){
            //Se elimina de la carpeta fisica
            $photoPath = str_replace('storage','public',$photo->url);
            Storage::delete($photoPath);
        });
    }
}
