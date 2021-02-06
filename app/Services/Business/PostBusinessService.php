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
}
