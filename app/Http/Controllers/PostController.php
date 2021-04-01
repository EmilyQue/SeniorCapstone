<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostModel;
use App\Services\Business\PostBusinessService;
use App\Services\Utility\AppLogger;
use Exception;
use DB;

class PostController extends Controller {
    //add a post
    public function index(Request $request){
        AppLogger::info("Entering PostController.index()");

        try{
            //recieves data inputed from user
            $title = $request->input('title');
            $description = $request->input('description');
            $content = $request->input('content');
            $date = $request->input('date');
            $image = $request->input('image');

            if($request->session()->has('user_id')) {
                $user_id = $request->session()->get('user_id');
            }
            //2. create object model
            //save posted form data in post object model
            $post = new PostModel(-1, $title, $description, $content, $date, $image, $user_id);

            //3. execute business service
            //call post business service
            $service = new PostBusinessService();
            $status = $service->create($post);

            //4. process results from business service (navigation)
            //render a failed or success response view and pass the post model to it
            if ($status) {
                return redirect()->action('App\Http\Controllers\PostController@displayUserPosts');
            }

            else {
                return view("registerFail");
            }
        }

        catch (Exception $e){
            //log exception and display exception view
            AppLogger::error("Exception: ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
    }

    /**
     * This method is to search for a blog post based on keywords in the blog post title and description
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory|boolean
     */
    public function searchBlogPost(Request $request){
        AppLogger::info("Entering PostController.searchBlogPost()");

        try{
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

        catch (Exception $e){
            //log exception and display exception view
            AppLogger::error("Exception: ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
    }

    /**
     * This method is to display all posts from user
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function displayUserPosts(Request $request) {
        AppLogger::info("Entering PostController.displayUserPosts()");

        try{
            //get session user id and username
            $id = session()->get('user_id');
            $username = session()->get('username');

            //call post business service
            $service = new PostBusinessService();
            $posts = $service->findBlogPostByUserID($id);

            //render a response view
            return view('displayMyPosts')->with(['posts' => $posts, 'username' => $username]);
        }

        catch (Exception $e){
            //log exception and display exception view
            AppLogger::error("Exception: ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
    }

    /**
     * This method is to display single blog post
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function displaySinglePost(Request $request) {
        AppLogger::info("Entering PostController.displaySinglePost()");

        try {
            //get session user id and username
            $id = $_GET['id'];
            $username = session()->get('username');

            //call post business service
            $service = new PostBusinessService();
            $posts = $service->findBlogPostByID($id);

            //render a response view
            return view('displaySinglePost')->with(['posts' => $posts, 'username' => $username]);

        }

        catch (Exception $e){
            //log exception and display exception view
            AppLogger::error("Exception: ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
    }

    /**
     * This method is to display featured posts
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function displayFeaturedPosts(Request $request) {
        AppLogger::info("Entering PostController.displayFeaturedPosts()");

        try {
            //call post business service
            $service = new PostBusinessService();
            $posts = $service->findFeaturedPosts();

            //render a response view
            return view('home')->with('posts' , $posts);
        }

        catch (Exception $e){
            //log exception and display exception view
            AppLogger::error("Exception: ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
    }

    /**
     * This method is to display all posts from database
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function displayAllPosts(Request $request) {
        AppLogger::info("Entering PostController.displayAllPosts()");

        try {
            //call post business service
            $service = new PostBusinessService();
            $posts = $service->findAllBlogPosts();

            //render a response view
            if ($posts) {
                return view('displayPosts')->with('posts', $posts);
            }
        }

        catch (Exception $e){
            //log exception and display exception view
            AppLogger::error("Exception: ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
    }

    /**
     * This method is to delete the blog post
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function deleteBlogPost(Request $request) {
        AppLogger::info("Entering PostController.deleteBlogPost()");

        try{
            //GET method for post id
            $id = $_GET['id'];
            //call user business service
            $service = new PostBusinessService();
            $delete = $service->removeBlogPost($id);

            //render a success or fail view
            if($delete) {
                return redirect()->action('App\Http\Controllers\PostController@displayUserPosts');
            }

            else {
                return view('deleteFail');
            }
        }

        catch (Exception $e){
            //log exception and display exception view
            AppLogger::error("Exception: ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
    }

    /**
     * This method is to find the user's blog posts
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory|boolean
     */
    public function findUserPosts() {
        AppLogger::info("Entering PostController.findUserPosts()");

        try{
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

        catch (Exception $e){
            //log exception and display exception view
            AppLogger::error("Exception: ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
    }

    /**
     * This method is to update the user's blog post
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateBlogPost(Request $request) {
        AppLogger::info("Entering PostController.updateBlogPost()");

        try{
            //get posted form data
            $id = $request->input('id');
            $title = $request->input('title');
            $date = $request->input('date');
            $description = $request->input('description');
            $content = $request->input('content');
            $image = $request->input('image');

            if ($request->session()->has('user_id')) {
                $user_id = $request->session()->get('user_id');
            }

            //create object model and save posted form data in post object model
            $blogPost = new PostModel($id, $title, $description, $content, $date, $image, $user_id);

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

        catch (Exception $e){
            //log exception and display exception view
            AppLogger::error("Exception: ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
    }

    public function pagination(){

    }
}
