<?php
/*Handles post business logic and connections to database*/
namespace App\Services\Business;

use \PDO;
use App\Models\PostModel;
use App\Services\Data\PostDataService;
use Illuminate\Support\Facades\Log;

class PostBusinessService {
/**
     * Create Post
     * @param PostModel $post
     * @return boolean
     */
    public function create(PostModel $post) {
        Log::info("Entering PostBusinessService.create()");

        $servername = config("database.connections.mysql.host");
        $dbname = config("database.connections.mysql.database");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");

        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //create a post service dao with this connection and try to create post
        $service = new PostDataService($conn);
        $flag = $service->createPost($post);

        //return the finder results
        Log::info("Exit PostBusinessService.create() with " . $flag);
        return $flag;
    }

    /**
     * Finds the blog post by name/description
     * @param $post
     * @return array
     */
    public function findPostByName($post) {
        Log::info("Entering PostBusinessService.findPostByName()");

        //get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $dbname = config("database.connections.mysql.database");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");

        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //create a post dao with this connection and try to find the blog post by name
        $service = new PostDataService($conn);
        $flag = $service->findPostByName($post);

        //return the finder results
        Log::info("Exit PostBusinessService.findPostByName() with " .  print_r($flag, true));
        return $flag;
    }

    /**
     * Finds all blog posts
     * @return array
     */
    public function findAllBlogPosts() {
        Log::info("Entering PostBusinessService.findAllBlogPosts()");

        //get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $dbname = config("database.connections.mysql.database");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");

        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //create a post dao with this connection and try to find all blog posts
        $service = new PostDataService($conn);
        $flag = $service->findAllPosts();

        //return the finder results
        return $flag;
        Log::info("Exit PostBusinessService.findAllBlogPosts() with " . $flag);
    }

    /**
     * Deletes the blog post
     * @param $id
     * @return boolean
     */
    public function removeBlogPost($id) {
        Log::info("Entering PostBusinessService.removeBlogPost()");

        //get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $dbname = config("database.connections.mysql.database");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");

        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //create a post dao with this connection and try to delete the blog post
        $service = new PostDataService($conn);
        $flag = $service->deletePost($id);

        //return the finder results
        Log::info("Exit PostBusinessService.removeBlogPost() with " . $flag);
        return $flag;
    }

    /**
     * Finds the blog post info by user id
     * @param $id
     * @return array
     */
    public function findBlogPostByUserID($id) {
        Log::info("Entering PostBusinessService.findBlogPostByUserID()");

        //get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $dbname = config("database.connections.mysql.database");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");

        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //create a post dao with this connection and try to find blog post by id
        $service = new PostDataService($conn);
        $flag = $service->findPostByUserID($id);

        //return the finder results
        Log::info("Exit PostBusinessService.findBlogPostByUserID() with " . print_r($flag, true));
        return $flag;
    }

    /**
     * Finds the blog post info by id
     * @param $id
     * @return array
     */
    public function findBlogPostByID($id) {
        Log::info("Entering PostBusinessService.findBlogPostByID()");

        //get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $dbname = config("database.connections.mysql.database");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");

        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //create a post dao with this connection and try to find blog post by id
        $service = new PostDataService($conn);
        $flag = $service->findPostByID($id);

        //return the finder results
        Log::info("Exit PostBusinessService.findBlogPostByID() with " . print_r($flag, true));
        return $flag;
    }

    /**
     * Finds the featured posts
     * @param $id
     * @return array
     */
    public function findFeaturedPosts() {
        Log::info("Entering PostBusinessService.findFeaturedPosts()");

        //get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $dbname = config("database.connections.mysql.database");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");

        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //create a post dao with this connection and try to find blog post by id
        $service = new PostDataService($conn);
        $flag = $service->findFeaturedPosts();

        //return the finder results
        Log::info("Exit PostBusinessService.findFeaturedPosts() with " . print_r($flag, true));
        return $flag;
    }

    /**
     * Updates the blog post info
     * @param PostModel $post
     * @return boolean
     */
    public function editPostInfo(PostModel $post) {
        Log::info("Entering PostBusinessService.editPostInfo()");

        // get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $dbname = config("database.connections.mysql.database");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        // create connection to database
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // create a post dao with this connection and try to update blog post info
        $service = new PostDataService($conn);
        $flag = $service->updatePost($post);

        // return the finder results
        Log::info("Exit PostBusinessService.editPostInfo() with " . $flag);
        return $flag;
    }
}
