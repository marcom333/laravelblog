<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Tag;
use App\TagBlog;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use GuzzleHttp\Client;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $total = 0;
        $active_only = request("active")?true:false;
        $page = request("page")?request("page"):1;
        $all = null;

        if(request("tag")){
            $tag = Tag::whereName(request("tag"))->first();
            if($tag)
                $all = $tag->blogs;
            if(!$active_only)
                $all->where('active', !$active_only);
        }
        else{
            $all = Blog::where('active', !$active_only)->get();
        }   

        $data = $all->sortByDesc("created_at")->forPage($page,9);
        $total = $all->count();

        return view("blog.index",["blogs"=>$data,"total"=>$total]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("blog.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            "title"=>[
                "required",
                "min:3"
            ],
            "resume"=>[
                "required",
                "min:3",
            ],
            "content"=>[
                "required",
                "min:3",
            ],
            "slug"=>[
                "required",
                "min:3",
                "unique:blogs,slug"
            ],
            "active"=>"required"
        ]);

        $attributes["cover"] = $request->file('cover')->storePublicly("blog-cover");
        $attributes["user_id"] = auth()->id();
        $attributes["content"] = str_replace(' ', '',htmlspecialchars($attributes["content"]));
        $tagstring = request("tags");
        $tagsArray = explode(",", $tagstring);
        $blog = Blog::create($attributes);
        foreach ( explode(",", $tagstring) as $tag) {
            $tag = trim($tag);
            $tagE = Tag::whereName($tag)->first();
            if(!$tagE){
                $tagE = new Tag();
                $tagE->name = $tag;
                $tagE->save();
            }
            $tagblog = new TagBlog();
            $tagblog->tag_id = $tagE->id;
            $tagblog->blog_id = $blog->id;
            $tagblog->save();
        }

        return redirect("/blog/".$blog->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show($find)
    {
        $blog = "";
        try{
            $find+1;
            //dd("que chuchas es entonces?");
            $blog = Blog::whereId($find)->first();
        }
        catch(\Exception $x){
            $blog = Blog::whereSlug($find)->first();
        }
        abort_unless($blog,404);
        Storage::setVisibility($blog->cover, 'public');
        return view("blog.show",["blog"=>$blog]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        //
    }
}

