<?php

namespace App\Http\Controllers;

use App\Services\Business\AdminBusinessService;
use App\Services\Utility\MyLogger;
use Exception;
use App\Models\DTO;
use App\Services\Business\PostBusinessService;
use Illuminate\Http\Request;

class PostsRestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            //call service to get all posts
            $service = new PostBusinessService();
            $posts = $service->findAllBlogPosts();

            if ($posts != null) {
                $dto = new DTO(0, "OK", $posts);
            }
            else {
                $dto = new DTO(-1, "Blog Posts Not Found", "");
            }

            //serialize the dto to JSON
            $json = json_encode($posts);

            return $json;
        }

        catch (Exception $e1) {
            //log exception
            MyLogger::error("Exception: ", array("message" => $e1->getMessage()));

            //return an error back to the user in the dto
            $dto = new DTO(-2, $e1->getMessage(), "");
            return json_encode($dto);
        }
    }
}
