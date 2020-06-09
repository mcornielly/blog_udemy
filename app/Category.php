<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    //Borrado lógico
    use SoftDeletes; //Implementamos 
    protected $dates = ['deleted_at']; //Registramos la nueva columna

    // protected $guarded = [];
    protected $fillable = ['name'];

    public function getRouteKeyName()
    {
        return 'url';
    } 

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // Accessor
    // public function getNameAttribute($name)
    // {
    //     return str_slug($name);
    // }

    // Mutators
    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;
        $this->attributes['url'] = str_slug($name);
    }
}
