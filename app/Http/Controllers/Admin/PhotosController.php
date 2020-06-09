<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PhotosController extends Controller
{
    public function store(Post $post)
    {
        $this->validate(request(), [
            'photo' => 'required|image|max:2048'
        ]);
        
        $post->photos()->create([
            'url' => Storage::url(request()->file('photo')->store('posts','public')),
        ]);
    }

    public function destroy(Photo $photo)
    {
        
        //se elimina de la bd 
        $photo->delete();

        return back()->with('message', 'Foto Eliminada');

    }
}
