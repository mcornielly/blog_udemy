<?php

namespace App\Http\Controllers;
use App\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function show(Tag $tag)
    {
        // return $category->load('posts');
        $posts = $tag->posts()->published()->paginate(3);

        if( request()->wantsJson())
        {
            return $posts;
        }

        $title = "Publicaciones de la Etiqueta '$tag->name' ";
        return view('pages.home', compact('posts', 'title'));
    }
}
