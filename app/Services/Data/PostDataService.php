<?php
namespace App\Services\Data;

use App\Models\PostModel;
use PDO;
use App\Services\Utility\AppLogger;
use App\Services\Utility\DatabaseException;
use PDOException;

//Database interacts with the data from the Post class
class PostDataService {
    private $conn = null;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Method to add post to database
    public function createPost(PostModel $post) {
        AppLogger::info("Entering PostDataService.createPost()");
        try{
            //select variables and see if the row exists
            $title = $post->getTitle();
            $description = $post->getDescription();
            $content = $post->getContent();
            $date = date('m/d/Y');
            $image = $post->getImage();
            $user_id = $post->getUser_id();

            //prepared statements is created
            $stmt = $this->conn->prepare("INSERT INTO `posts` (`title`, `description`, `content`, `date`, `image`, `users_id`) VALUES (:title, :description, :content, :date, :image, :user_id)");
            //binds parameters
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':image', $image);
            $stmt->bindParam(':user_id', $user_id);

            /*see if post was added
            else return false if not found*/
            if ($stmt->execute()) {
                AppLogger::info("Exit PostDataService.createPost() with true");
                return true;
            }

            else {
                AppLogger::info("Exit PostDataService.createPost() with false");
                return false;
            }
        }

        catch (PDOException $e){
            //log and throw custom exception
            AppLogger::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Finds the blog post by name/description
     * @param  $post
     * @return array
     */
    public function findPostByName($post) {
        AppLogger::info("Entering PostDataService.findPostByName()");
        try{
            //prepared statement is created
            $stmt = $this->conn->prepare("SELECT posts.*, users.firstName, users.lastName FROM posts INNER JOIN users ON posts.users_id=users.id WHERE posts.title LIKE '%".$post."%' OR posts.description LIKE '%".$post."%' OR posts.content LIKE '%".$post."%'");

            //array is created and statement is executed
            // $list = array();
            $stmt->execute();
            $posts = $stmt->fetchAll();

            //loops through table  using stmt->fetch
            // for ($i = 0; $row = $stmt->fetch(); $i++) {
            //     //post model is created
            //     $postSearch = new PostModel($row['id'], $row['title'], $row['description'], $row['content'], $row['date'], $row['image'], $row['users_id']);
            //     //inserts variables into end of array
            //     array_push($list, $postSearch);
            // }
            //return list array that holds post variables
            AppLogger::info("Exit PostDataService.findPostByName() with true");
            return $posts;
        }

        catch (PDOException $e){
            //log and throw custom exception
            AppLogger::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Fetches all posts from the database
     * @return array
     */
    public function findAllPosts() {
        AppLogger::info("Entering PostDataService.findAllPosts()");
        try{
            //prepared statement is created to display posts
            $stmt = $this->conn->prepare('SELECT posts.*, users.firstName, users.lastName FROM posts INNER JOIN users ON posts.users_id=users.id');
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
                AppLogger::info("Exiting PostDataService.findAllPosts() with true");
                return $postArray;
            }
        }

        catch(PDOException $e) {
            //log and throw custom exception
            AppLogger::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Deletes the post from the database
     * @param  $id
     * @return boolean
     */
    public function deletePost($id) {
        AppLogger::info("Entering PostDataService.deletePost()");
        try{
            //prepared statement is created
            $stmt = $this->conn->prepare('DELETE FROM posts WHERE `id` = :id');
            //bind parameter
            $stmt->bindParam(':id', $id);
            //executes statement
            $delete = $stmt->execute();

            //returns true or false if post has been deleted from database
            if ($delete) {
                AppLogger::info("Exiting PostDataService.deletePost() with true");
                return true;
            }

            else {
                AppLogger::info("Exiting PostDataService.deletePost() with false");
                return false;
            }
        }

        catch (PDOException $e) {
            //log and throw custom exception
            AppLogger::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Finds the post by user id
     * @param  $id
     * @return array
     */
    public function findPostByUserID($id) {
        AppLogger::info("Entering PostDataService.findPostByUserID()");
        try{
            //prepared statement is created and user id is binded
            $stmt = $this->conn->prepare('SELECT posts.*, users.firstName, users.lastName FROM posts INNER JOIN users ON posts.users_id=users.id WHERE posts.users_id = :id');
            $stmt->bindParam(':id', $id);

            //list array is created and statement is executed
            $stmt->execute();
            $posts = $stmt->fetchAll();

            //loops through table  using stmt->fetch
            // for ($i = 0; $row = $stmt->fetch(); $i++) {
            //     //post model is created
            //     $postSearch = new PostModel($row['id'], $row['title'], $row['description'], $row['content'], $row['date'], $row['image'], $id);
            //     //inserts variables into end of array
            //     array_push($list, $postSearch);
            // }
            //return list array that holds job variables
            AppLogger::info("Exiting PostDataService.findPostByUserID() with true");
            return $posts;
        }

        catch (PDOException $e) {
            //log and throw custom exception
            AppLogger::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Finds the post by post id
     * @param  $id
     * @return array
     */
    public function findPostByID($id) {
        AppLogger::info("Entering PostDataService.findPostByUserID()");
        try{
            //prepared statement is created and user id is binded
            $stmt = $this->conn->prepare('SELECT posts.*, users.firstName, users.lastName FROM posts INNER JOIN users ON posts.users_id=users.id WHERE posts.id = :id');
            $stmt->bindParam(':id', $id);

            //list array is created and statement is executed
            // $list = array();
            $stmt->execute();
            $posts = $stmt->fetchAll();

            //loops through table  using stmt->fetch
            // for ($i = 0; $row = $stmt->fetch(); $i++) {
            //     //post model is created
            //     $postSearch = new PostModel($id, $row['title'], $row['description'], $row['content'], $row['date'], $row['image'], $row['users_id']);
            //     //inserts variables into end of array
            //     array_push($list, $postSearch);
            // }

            //return list array that holds job variables
            AppLogger::info("Exiting PostDataService.findPostByID() with true");
            return $posts;
        }

        catch (PDOException $e){
            //log and throw custom exception
            AppLogger::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }

/**
     * Finds the posts that are featured on home page
     * @param  $id
     * @return array
     */
    public function findFeaturedPosts() {
        AppLogger::info("Entering PostDataService.findFeaturedPosts()");
        try{
            //prepared statement is created and user id is binded
            $stmt = $this->conn->prepare('SELECT posts.*, users.firstName, users.lastName FROM posts INNER JOIN users ON posts.users_id=users.id LIMIT 3');

            //list array is created and statement is executed
            // $list = array();
            $stmt->execute();
            $users = $stmt->fetchAll();
            //loops through table  using stmt->fetch
            // for ($i = 0; $row = $stmt->fetch(); $i++) {
            //     //post model is created
            //     $postSearch = new PostModel($row['id'], $row['title'], $row['description'], $row['content'], $row['date'], $row['image'], $row['users_id']);
            //     //inserts variables into end of array
            //     array_push($list, $postSearch);
            // }
            //return list array that holds job variables
            AppLogger::info("Exiting PostDataService.findFeaturedPosts() with true");
            return $users;
        }

        catch (PDOException $e){
            //log and throw custom exception
            AppLogger::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Updates the post info in database
     * @param PostModel $post
     * @return boolean
     */
    public function updatePost(PostModel $post) {
        AppLogger::info("Entering PostDataService.updatePost()");
        try{
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
                AppLogger::info("Exiting PostDataService.updatePost() with true");
                return true;
            }

            else {
                AppLogger::info("Exiting PostDataService.updatePost() with false");
                return false;
            }
        }

        catch (PDOException $e){
            //log and throw custom exception
            AppLogger::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
}
