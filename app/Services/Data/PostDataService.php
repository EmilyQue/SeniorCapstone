<?php
namespace App\Services\Data;

use App\Models\PostModel;
use PDO;

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

    /**
     * Finds the blog post by name/description
     * @param  $post
     * @return array
     */
    public function findPostByName($post) {
        //prepared statement is created
        $stmt = $this->conn->prepare("SELECT id, title, description, users_id FROM posts WHERE title LIKE '%".$post."%' OR description LIKE '%".$post."%' ");

        //array is created and statement is executed
        $list = array();
        $stmt->execute();

        //loops through table  using stmt->fetch
        for ($i = 0; $row = $stmt->fetch(); $i++) {
            //post model is created
            $postSearch = new PostModel($row['id'], $row['title'], $row['description'], $row['users_id']);
            //inserts variables into end of array
            array_push($list, $postSearch);
        }
        //return list array that holds post variables
        return $list;
    }

    /**
     * Fetches all posts from the database
     * @return array
     */
    public function findAllPosts() {
        //prepared statement is created to display posts
        $stmt = $this->conn->prepare('SELECT * from posts');
        //executes prepared query
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            //post array is created
            $postArray = array();
            //fetches result from prepared statement and returns as an array
            while ($post = $stmt->fetch(PDO::FETCH_ASSOC)) {
                //inserts variables into end of array
                array_push($postArray, $post);
            }
            //return post array
            return $postArray;
        }
    }

    /**
     * Deletes the post from the database
     * @param  $id
     * @return boolean
     */
    public function deletePost($id) {
        //prepared statement is created
        $stmt = $this->conn->prepare('DELETE FROM posts WHERE `id` = :id');
        //bind parameter
        $stmt->bindParam(':id', $id);
        //executes statement
        $delete = $stmt->execute();

        //returns true or false if post has been deleted from database
        if ($delete) {
            return true;
        }

        else {
            return false;
        }
    }

    /**
     * Finds the post by user id
     * @param  $id
     * @return array
     */
    public function findPostByID($id) {
        //prepared statement is created and user id is binded
        $stmt = $this->conn->prepare('SELECT * FROM posts WHERE users_id = :id');
        $stmt->bindParam(':id', $id);

        //list array is created and statement is executed
        $list = array();
        $stmt->execute();

        //loops through table  using stmt->fetch
        for ($i = 0; $row = $stmt->fetch(); $i++) {
            //post model is created
            $postSearch = new PostModel($row['id'], $row['title'], $row['description'], $id);
            //inserts variables into end of array
            array_push($list, $postSearch);
        }
        //return list array that holds job variables
        return $list;
    }

    /**
     * Updates the post info in database
     * @param PostModel $post
     * @return boolean
     */
    public function updatePost(PostModel $post)
    {
        // select variables and see if the row exists
        $id = $post->getId();
        $title = $post->getTitle();
        $description = $post->getdescription();

        // prepared statements is created
        $stmt = $this->conn->prepare("UPDATE posts SET title = :title, description = :description WHERE id = :id");
        // binds parameters
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);

        $stmt->execute();
        /*
            * see if new blog post data was inserted
            * else return false
            */
        if ($stmt->rowCount() == 1) {
            return true;
        } else {
            return false;
        }
    }
}
