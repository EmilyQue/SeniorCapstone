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
            return view("displayPosts");
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

    /**
     * This method is to display all posts from database
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function displayAllPosts(Request $request) {
        //call post business service
        $service = new PostBusinessService();
        $posts = $service->findAllBlogPosts();
        //render a response view
        if ($posts) {
            return view('displayPosts')->with($posts);
        }
    }

    /**
     * This method is to delete the blog post
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function deleteBlogPost(Request $request) {
        //GET method for post id
        $id = $request->session()->get('user_id');
        //call user business service
        $service = new PostBusinessService();
        $delete = $service->removeBlogPost($id);

        //render a success or fail view
        if($delete) {
            return view('displayPosts');
        }

        else {
            return view('deleteFail');
        }
    }

    /**
     * This method is to find the user's blog posts
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory|boolean
     */
    public function findUserPosts() {
        //get posted form data
        $id = session()->get('user_id');

        //call post business service
        $service = new PostBusinessService();
        $userPosts = $service->findBlogPostByID($id);

        //process results from business service (navigation)
        //render a failed or edit blog post response view and pass the post model to it
        if ($userPosts) {
            return view('editBlogPost')->with('userPosts', $userPosts);
        }

        else {
            return false;
        }

    }

    /**
     * This method is to update the user's blog post
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateBlogPost(Request $request) {
        //get posted form data
        $id = $request->input('id');
        $title = $request->input('title');
        $description = $request->input('description');

        if ($request->session()->has('user_id')) {
            $user_id = $request->session()->get('user_id');
        }

        //create object model and save posted form data in post object model
        $blogPost = new PostModel($id, $title, $description, $user_id);

        //execute business service and call post business service
        $service = new PostBusinessService();
        $status = $service->editPostInfo($blogPost);

        //process results from business service (navigation)
        //render a failed or redirect to profile view
        if ($status) {
            return view('displayPosts');
        }

        else {
            return view('registerFail');
        }
    }
}
