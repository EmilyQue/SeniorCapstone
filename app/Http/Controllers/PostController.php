<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostModel;
use App\Services\Business\PostBusinessService;

class PostController extends Controller {
    //add a post
    public function index(Request $request){
        //recieves data inputed from user
        $title = $request->input('title');
        $description = $request->input('description');

        if($request->session()->has('user_id')) {
            $user_id = $request->session()->get('user_id');
        }
        //2. create object model
        //save posted form data in post object model
        $post = new PostModel(-1, $title, $description, $user_id);

        //3. execute business service
        //call post business service
        $service = new PostBusinessService();
        $status = $service->create($post);

        //4. process results from business service (navigation)
        //render a failed or success response view and pass the post model to it
        if ($status) {
            return view("registerSuccess");
        }

        else {
            return view("registerFail");
        }
    }

    /**
     * This method is to search for a blog post based on keywords in the blog post title and description
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory|boolean
     */
    public function searchBlogPost(Request $request){
        //1. process form data
        //get posted form data
        $post = $request->input('search');

        //call job posting business service
        $service = new PostBusinessService();
        $blogPost = $service->findPostByName($post);

        //returns the results of the search
        if ($blogPost > 0) {
            return view('searchView')->with('blogPost', $blogPost);
        }

        else {
            return false;
        }
    }
}
