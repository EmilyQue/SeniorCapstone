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
}
