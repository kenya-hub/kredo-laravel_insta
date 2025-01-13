<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    //
    private $post;
    private $category;

    public function __construct(Post $post, Category $category)
    {
        $this->post = $post;
        $this->category = $category;
    }

    public function create()
    {
        $all_categories = $this->category->all();

        return view('users.posts.create')
                ->with('all_categories', $all_categories);
    }

    public function store(Request $request)
    {
        $request->validate([
            'category'    => 'required|array|between:1,3',
            'description' => 'required|max:1000',
            'image'       => 'required|mimes:jpg,jpeg,png,gif|max:1048'
        ]);

        $this->post->user_id     = Auth::user()->id;
        $this->post->image       = 'data:image/jpg' . $request->image->extension() . ';base64,' . base64_encode(file_get_contents($request->image));
        $this->post->description = $request->description;
        $this->post->save();

        foreach($request->category as $category_id)
        {
            $category_post[]     = ['category_id' => $category_id];
            // ['category_id' => $category_id => 4];
            // ['category_id' => $category_id => 4];
            // ['category_id' => $category_id => 4];
        }

        $this->post->categoryPost()->createMany($category_post);

        return redirect()->route('index');

    }

    public function show($id){

        $post = $this->post->findOrFail($id);

        return view('users.posts.show')
                ->with('post', $post);
    }

    public function edit($id)
    {

        $post = $this->post->findOrFail($id);

        # IF the Auth uwer is not the woner of the post , rediredt to homepage
        if(Auth::user()->id != $post->user_id)
        {
            return redirect()->route('index');
        }

        $all_categories = $this->category->all(); //retrieve all categories

        return view('users.posts.edit')
                ->with('all_categories', $all_categories)
                ->with('post', $post);
    }
}
