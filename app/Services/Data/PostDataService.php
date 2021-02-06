<?php
namespace App\Services\Data;

use App\Models\PostModel;

//Database interacts with the data from the Post class
class PostDataService {
    private $conn = null;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Method to add post to database
    public function createPost(PostModel $post) {
        //select variables and see if the row exists
        $title = $post->getTitle();
        $description = $post->getDescription();
        $user_id = $post->getUser_id();

        //prepared statements is created
        $stmt = $this->conn->prepare("INSERT INTO `posts` (`title`, `description`, `users_id`) VALUES (:title, :description, :user_id)");
        //binds parameters
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':user_id', $user_id);

        /*see if user existed and return true if found
        else return false if not found*/
        if ($stmt->execute() >= 1) {
            return true;
        }

        else {
            return false;
        }
    }
}
