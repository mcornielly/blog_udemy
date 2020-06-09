<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Boolean;

class Post extends Model
{
    protected $fillable = ['title', 'excerpt', 'body', 'category_id','iframe', 'published_at', 'user_id'];

    protected $dates = ['published_at'];

    protected $appends = ['published_date'];

    // protected $with = ['user','category','tags','photos'];

    public function getRouteKeyName()
    {
        return 'url';
    }  

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getPublishedDateAttribute()
    {
        return optional($this->published_at)->format('M d');
    }

    public function scopePublished($query)
    {
        // Query Scope
        $query->with(['user','category','tags','photos'])
                ->whereNotNull('published_at')
                ->where('published_at','<=', Carbon::now());
                //  ->latest('published_at');
    }

    public function scopeAllowed($query)
    {
        // if(auth()->user()->hasRole('Admin'))
        if(auth()->user()->can('view', $this))
        {
            // $posts = Post::all();
            return $query;

        }else
        {
            // $posts = auth()->user()->posts;
            return $query->where('user_id', auth()->id());
        }

    }

    public function scopebyYearAndMonth($query)
    {
        return $query->selectRaw('year(published_at) year')
                    ->selectRaw('month(published_at) month')
                    ->selectRaw('monthname(published_at) monthname')
                    ->selectRaw('count(*) posts')
                    ->groupBy('year','month','monthname');
                    // ->orderBy('created_at', 'DESC')
    }

    // public function setTitleAttribute($title)
    // {
    //     $this->attributes['title'] = $title;
    //     $this->attributes['url'] = str_slug($title);

    // }

    public function setPublishedAtAttribute($published_at)
    {
        $this->attributes['published_at'] = $published_at ? Carbon::parse($published_at) : null;
    }
    
    public function setCategoryIdAttribute($category)
    {
        $this->attributes['category_id'] = Category::find($category)
        ? $category  
        : Category::create(['name' => $category])->id;
    }

    public function syncTags($tags)
    {
        $tagIds = collect($tags)->map(function($tag){
            return Tag::find($tag) ? $tag : Tag::create(['name' => $tag])->id;
        });
        
        return $this->tags()->sync($tagIds);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function($post){
            $post->tags()->detach();
            $post->photos->each->delete();
        });
    }

    public static function create(array $attributes = [])
    {
        $attributes['user_id'] = auth()->id();
        $post = static::query()->create($attributes);
        $post->generateUrl();

        return $post;
    }
    
    public function isPublished()
    {
        // return (Boolean) $this->published_at;
        return ! is_null($this->published_at) && $this->published_at < today();
    }

    public function generateUrl()
    {
        $url = str_slug($this->title);

        if($this::whereUrl($url)->exists())
        {
            $url = $url ."-" . $this->id;
        }

        $this->url = $url;

        $this->save();
    }


    public function viewType($home = '')
    {
        if($this->photos->count() === 1):
            return 'posts.photo';
        elseif($this->photos->count() > 1):
            return $home === 'home' ? 'posts.carousel-preview' : 'posts.carousel';
        elseif($this->iframe):
            return 'posts.iframe';
        else:
            return 'posts.text';
        endif;
    }
}
