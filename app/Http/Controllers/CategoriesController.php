<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function show(Category $category)
    {
        // return $category->load('posts');
        $posts = $category->posts()->published()->paginate();
        
        if( request()->wantsJson() )
        {
            return $posts;
        }
        $title = "Publicaciones de la Categoría '$category->name' ";

        return view('pages.home', compact('posts', 'title'));
    }


}
