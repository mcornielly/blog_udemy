<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Category;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');       
    }

    public function index()
    {
        
        $posts = Post::allowed()->get();

        //relationship - model
        // $posts = auth()->user()->posts;
   
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.create', compact('categories','tags'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', new Post);
        
        $this->validate($request, [
            'title' => 'required|min:3'
        ]);
        
        $post = Post::create($request->all());   

        // $post = Post::create($request->only('title'));
        // $post = Post::create([
        //     'title' => $request->get('title'),
        //     'user_id' => auth()->id()
        // ]);

        //  $post = Post::create([
        //     'title' => $request->get('title'),
        //     'url' => str_slug($request->get('title')),
        //  ]);
        
        // $post = new Post;
        // $post->title = $request->only('title');
        // // $post->url = str_slug($request->get('title'));    
        // $post->save();    
 
         return redirect()->route('admin.posts.edit', $post);

    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.edit', compact('categories','tags', 'post'));
    }



    public function update(Post $post, StorePostRequest $request)
    {
        $this->authorize('update', $post);
        
        $post->update($request->all());
 
        $post->syncTags($request->get('tags')); 
        
        return redirect()->route('admin.posts.edit', $post)->with('message', 'La publicación ha sido guardada.');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        
        // $post->photos()->delete();
        
        // foreach($post->photos as $photo)
        // {
        //     $photo->delete();
        // }
            
        // $post->photos->each(function($photo){
        //     $photo->delete();
        // });
                
        $post->delete();

        return redirect()
                ->route('admin.posts.index')
                ->with('message', 'La publicación ha sido eliminada.');
    }

    // public function update(Post $post, Request $request)
    // {
    //     // return $request->all();

    //    $this->validate($request,[
    //         'title' => 'required',
    //         'body' => 'required',
    //         'excerpt' => 'required',
    //         'category' => 'required',
    //         'tags' => 'required',
    //    ]);

    //    $post->title = $request->get('title');
    //    // $post->url = str_slug($request->get('title'));
    //    $post->excerpt = $request->get('excerpt');
    //    $post->body = $request->get('body');
    //    $post->iframe = $request->get('iframe');
    //    $post->published_at = $request->has('published_at') ? Carbon::parse($request->get('published_at')) : null;
    // //  $post->published_at = Carbon::parse($request->get('published_at'));
    // //    $post->category_id = $request->get('category');
    //    $post->category_id = Category::find($cat = $request->get('category'))
    //                         ? $cat  
    //                         : Category::create(['name' => $cat])->id;
    //    $post->save();
    // //    $post->tags()->attach($request->get('tags'));
    //    $tags = [];
       
    //    foreach($request->get('tags') as $tag){
    //        $tags[] = Tag::find($tag)
    //                 ? $tag
    //                 : Tag::create(['name' => $tag])->id;
    //    }

    // //    $post->tags()->sync($request->get('tags'));
    //    $post->tags()->sync($tags);
       
    // //    return back()->with('message', 'Tu publicación ha sido guardada.');
    //    return redirect()->route('admin.posts.edit', $post)->with('message', 'Tu publicación ha sido guardada.');
    // }
}
