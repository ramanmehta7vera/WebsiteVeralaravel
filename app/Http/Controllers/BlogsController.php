<?php

namespace App\Http\Controllers;

use App\Http\Requests\AllRequest;
use App\Http\Requests\SuggestedRequest;
use App\Services\Blog\BlogCalls;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BlogsController extends Controller
{

    public function index(Request $request)
    {
        return view('posts.create');
    }

    public function welcome(Request $request)
    {
        return view('welcome');
    }

    public function top_story(Request $request)
    {
        $top_story = new BlogCalls();
        return $top_story->top_story($request);
    }

    public function categories(Request $request)
    {
        $category = new BlogCalls();
        return $category->categories($request);
    }

    public function suggested_blog(SuggestedRequest $request)
    {
        $request->validated();
        $data = $request->all();
        $id = $data['id'];

        $suggested_blog = new BlogCalls();
        return $suggested_blog->suggested_blog($id);
    }

    public function all_blogs_paginated(AllRequest $request)
    {
        $request->validated();
        $data = $request->all();
        $limit = $data['limit'];
        $offset = $data['offset'];

        $all_blogs_paginated = new BlogCalls();
        return $all_blogs_paginated->all_blogs_paginated($limit, $offset);
    }

    public function postsadd(Request $request)
    {

        $blog_json = json_encode($request->all());
        $add_post = new BlogCalls();
        return $add_post->add_post($blog_json);
    }

    public function populate_blog(Request $request)
    {
        $uid_json = json_encode($request->all());
        $uid = json_decode($uid_json)->{'uid'};
        $blog_populate = new BlogCalls();
        return $blog_populate->populate_blog($uid);
    }
}
