<?php
/*Handles post business logic and connections to database*/
namespace App\Services\Business;

use \PDO;
use App\Models\PostModel;
use App\Services\Data\PostDataService;

class PostBusinessService {
/**
     * Create Post
     * @param PostModel $post
     * @return boolean
     */
    public function create(PostModel $post) {
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
        return $flag;
    }

    /**
     * Finds the blog post by name/description
     * @param $post
     * @return array
     */
    public function findPostByName($post) {
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
        return $flag;
    }

    /**
     * Finds all blog posts
     * @return array
     */
    public function findAllBlogPosts() {
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
    }

    /**
     * Deletes the blog post
     * @param $id
     * @return boolean
     */
    public function removeBlogPost($id) {
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
        return $flag;
    }

    /**
     * Finds the blog post info by user id
     * @param $id
     * @return array
     */
    public function findBlogPostByUserID($id) {
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
        return $flag;
    }

    /**
     * Finds the blog post info by id
     * @param $id
     * @return array
     */
    public function findBlogPostByID($id) {
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
        return $flag;
    }

    /**
     * Updates the blog post info
     * @param PostModel $post
     * @return boolean
     */
    public function editPostInfo(PostModel $post)
    {
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
        return $flag;
    }
}
