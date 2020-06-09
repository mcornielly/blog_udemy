<?php
use App\Post;
use App\Tag;
use App\Category;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Storage::disk('public')->deleteDirectory('posts');
        Post::truncate();
        Category::truncate();
        Tag::truncate();

        $category = new Category;
        $category->name = "Categoría 1";
        $category->save();

        $category = new Category;
        $category->name = "Categoría 2";
        $category->save();

        $category = new Category;
        $category->name = "Categoría 3";
        $category->save();

        $post = new Post;
        $post->title = 'Mi primer Post';
        $post->url = str_slug('Mi primer Post');
        $post->excerpt = 'Extrato de mi primer post';
        $post->body = '<p>Extrato de mi primer post</p>';
        $post->published_at = Carbon::now()->subDays(4);
        $post->category_id = 1;
        $post->user_id = 1;
        $post->save();

        $post->tags()->attach(Tag::create(['name' => 'Etiqueta 1'])); 

        $post = new Post;
        $post->title = 'Mi segundo Post';
        $post->url = str_slug('Mi segundo Post');
        $post->excerpt = 'Extrato de mi segundo post';
        $post->body = '<p>Extrato de mi segundo post</p>';
        $post->published_at = Carbon::now()->subDays(3);
        $post->category_id = 2;
        $post->user_id = 1;
        $post->save();

        $post->tags()->attach(Tag::create(['name' => 'Etiqueta 2']));

        $post = new Post;
        $post->title = 'Mi tercer Post';
        $post->url = str_slug('Mi tercer Post');
        $post->excerpt = 'Extrato de mi tercer post';
        $post->body = '<p>Extrato de mi tercer post</p>';
        $post->published_at = Carbon::now()->subDays(2);
        $post->category_id = 1;
        $post->user_id = 2;
        $post->save();

        $post->tags()->attach(Tag::create(['name' => 'Etiqueta 3']));


        $post = new Post;
        $post->title = 'Mi cuarto Post';
        $post->url = str_slug('Mi cuarto Post');
        $post->excerpt = 'Extrato de mi cuarto post';
        $post->body = '<p>Extrato de mi cuarto post</p>';
        $post->published_at = Carbon::now()->subDays(1);
        $post->category_id = 3;
        $post->user_id = 2;
        $post->save();

        $post->tags()->attach(Tag::create(['name' => 'Etiqueta 4']));

    }
}
