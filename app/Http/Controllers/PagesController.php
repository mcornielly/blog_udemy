<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use App\Category;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function spa()
    {
        return view('pages.spa');
    }

    public function home()
    {
        
        // $query = Post::with('category','tags','user','photos')->published();
        $query = Post::published();
        
        if(request('month')){
            $query->whereMonth('published_at', request('month'));
        }
        
        if(request('year')){
            $query->whereYear('published_at', request('year'));
        }
        
        // $posts = Post::published()->paginate();
        $posts = $query->paginate(2);

        //Se pregunta por donde viene la solicitud
        if( request()->wantsJson() )
        {
            return $posts;
        }

        return view('pages.home', compact('posts'));
    }

    public function about()
    {
        return view('pages.about');
    }

    public function archive()
    {
        
        // $publishes = Post::selectRaw('year(published_at) year')
        //             ->selectRaw('month(published_at) month')
        //             ->selectRaw('monthname(published_at) monthname')
        //             ->selectRaw('count(*) posts')
        //             ->groupBy('year','month','monthname')
        //             // ->orderBy('created_at', 'DESC')
        //             ->get();
        $data = [
            'publishes' => Post::Published()->byYearAndMonth()->get(),
            'users' => User::take(4)->get(),
            'categories' => Category::take(7)->get(),
            'posts' => Post::latest('published_at')->take(5) ->get()
        ];

        if( request()->wantsJson())
        {
            return [
                $data
            ];
        }

        return view('pages.archive', compact('data'));
        // return view('pages.archive', compact('users', 'categories', 'posts', 'publishes'));
    }

    public function contact()
    {
        return view('pages.contact');
    }
}
