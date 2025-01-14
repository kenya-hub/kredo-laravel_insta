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

    // public function edit($id)
    // {

    //     $post = $this->post->findOrFail($id);

    //     # IF the Auth uwer is not the woner of the post , rediredt to homepage
    //     if(Auth::user()->id != $post->user_id)
    //     {
    //         return redirect()->route('index');
    //     }

    //     $all_categories = $this->category->all(); //retrieve all categories

    //     return view('users.posts.edit')
    //             ->with('all_categories', $all_categories)
    //             ->with('post', $post);
    // }

    // edit() - view the Edit Post Page and display details of a post
    public function edit($id)
    {
        $post = $this->post->findOrFail($id);
        # If the Auth user is NOT the owner of the post, redirect to homepage
        if (Auth::user()->id != $post->user->id){
            return redirect()->route('index');
        }
        $all_categories = $this->category->all(); // retrieves all categories
        # Get all the category IDs of this post. Save in an array
        $selected_categories = [];
        foreach ($post->categoryPost as $category_post){
            $selected_categories[] = $category_post->category_id;
            /*
                $selected_categories = [
                    [1],
                    [2],
                    [3]
                ];
            */
        }
        return view('users.posts.edit')
            ->with('all_categories', $all_categories)
            ->with('post', $post)
            ->with('selected_categories', $selected_categories);
    }

    // update() - update the post
    public function update(Request $request, $id)
    {
        # 1. Validate the data from the form
        $request->validate([
            'category'      => 'required|array|between:1,3',
            'description'   => 'required|max:1000',
            'image'         => 'mimes:jpg,png,jpeg,gif|max:1048'
                            # Multipurpose Internet Mail Extensions
        ]);
        # 2. Update the post
        $post               = $this->post->findOrFail($id);
        $post->description  = $request->description;
        // If there is a new image...
        if ($request->image){
            $post->image = 'data:image/' . $request->image->extension() . ';base64,' . base64_encode(file_get_contents($request->image));
        }
        $post->save();
        # 3. Delete all records from categoryPost related to this post
        $post->categoryPost()->delete();
        # 4. Save the new categories to category_post pivot table
        foreach ($request->category as $category_id){
            $category_post[] = [
                'category_id' => $category_id
            ];
            /*
                $category_post = [
                    ['category_id' => 1],
                    ['category_id' => 2],
                    ['category_id' => 3],
                ];
            */
        }
        $post->categoryPost()->createMany($category_post);
        /*
            $category_post = [
                ['post_id' => 2, 'category_id' => 1],
                ['post_id' => 2, 'category_id' => 2],
                ['post_id' => 2, 'category_id' => 3]
            ];
        */
        # redirect to show post page
        return redirect()->route('post.show', $id);
    }

    //destroy() - delete the post
    public function delete($id)
    {
        $post = $this->post->findOrFail($id);

        if(Auth::user()->id != $post->user_id)
        {
            return redirect()->route('index');
        }

        $post->delete();
        return redirect()->route('index');
    }
}
