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

        //create a recipe service dao with this connection and try to create recipe
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

        //create an admin dao with this connection and try to find the job posting by name
        $service = new PostDataService($conn);
        $flag = $service->findPostByName($post);

        //return the finder results
        return $flag;
    }
}
