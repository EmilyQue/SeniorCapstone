<?php
/*Handles post business logic and connections to database*/
namespace App\Services\Business;

use \PDO;
use App\Models\PostModel;
use App\Services\Data\PostDataService;
use App\Services\Utility\AppLogger;
use App\Services\Utility\DatabaseConnection;

class PostBusinessService {
/**
     * Create Post
     * @param PostModel $post
     * @return boolean
     */
    public function create(PostModel $post) {
        AppLogger::info("Entering PostBusinessService.create()");

        //create connection to database
        $conn = new DatabaseConnection();

        //create a post service dao with this connection and try to create post
        $service = new PostDataService($conn);
        $flag = $service->createPost($post);

        //return the finder results
        AppLogger::info("Exit PostBusinessService.create() with " . $flag);
        return $flag;
    }

    /**
     * Finds the blog post by name/description
     * @param $post
     * @return array
     */
    public function findPostByName($post) {
        AppLogger::info("Entering PostBusinessService.findPostByName()");

        //create connection to database
        $conn = new DatabaseConnection();

        //create a post dao with this connection and try to find the blog post by name
        $service = new PostDataService($conn);
        $flag = $service->findPostByName($post);

        //return the finder results
        AppLogger::info("Exit PostBusinessService.findPostByName() with " .  print_r($flag, true));
        return $flag;
    }

    /**
     * Finds all blog posts
     * @return array
     */
    public function findAllBlogPosts() {
        AppLogger::info("Entering PostBusinessService.findAllBlogPosts()");

        //create connection to database
        $conn = new DatabaseConnection();

        //create a post dao with this connection and try to find all blog posts
        $service = new PostDataService($conn);
        $flag = $service->findAllPosts();

        //return the finder results
        return $flag;
        AppLogger::info("Exit PostBusinessService.findAllBlogPosts() with " . $flag);
    }

    /**
     * Deletes the blog post
     * @param $id
     * @return boolean
     */
    public function removeBlogPost($id) {
        AppLogger::info("Entering PostBusinessService.removeBlogPost()");

        //create connection to database
        $conn = new DatabaseConnection();

        //create a post dao with this connection and try to delete the blog post
        $service = new PostDataService($conn);
        $flag = $service->deletePost($id);

        //return the finder results
        AppLogger::info("Exit PostBusinessService.removeBlogPost() with " . $flag);
        return $flag;
    }

    /**
     * Finds the blog post info by user id
     * @param $id
     * @return array
     */
    public function findBlogPostByUserID($id) {
        AppLogger::info("Entering PostBusinessService.findBlogPostByUserID()");

        //create connection to database
        $conn = new DatabaseConnection();

        //create a post dao with this connection and try to find blog post by id
        $service = new PostDataService($conn);
        $flag = $service->findPostByUserID($id);

        //return the finder results
        AppLogger::info("Exit PostBusinessService.findBlogPostByUserID() with " . print_r($flag, true));
        return $flag;
    }

    /**
     * Finds the blog post info by id
     * @param $id
     * @return array
     */
    public function findBlogPostByID($id) {
        AppLogger::info("Entering PostBusinessService.findBlogPostByID()");

        //create connection to database
        $conn = new DatabaseConnection();

        //create a post dao with this connection and try to find blog post by id
        $service = new PostDataService($conn);
        $flag = $service->findPostByID($id);

        //return the finder results
        AppLogger::info("Exit PostBusinessService.findBlogPostByID() with " . print_r($flag, true));
        return $flag;
    }

    /**
     * Finds the featured posts
     * @param $id
     * @return array
     */
    public function findFeaturedPosts() {
        AppLogger::info("Entering PostBusinessService.findFeaturedPosts()");

        //create connection to database
        $conn = new DatabaseConnection();

        //create a post dao with this connection and try to find blog post by id
        $service = new PostDataService($conn);
        $flag = $service->findFeaturedPosts();

        //return the finder results
        AppLogger::info("Exit PostBusinessService.findFeaturedPosts() with " . print_r($flag, true));
        return $flag;
    }

    /**
     * Updates the blog post info
     * @param PostModel $post
     * @return boolean
     */
    public function editPostInfo(PostModel $post) {
        AppLogger::info("Entering PostBusinessService.editPostInfo()");

        //create connection to database
        $conn = new DatabaseConnection();

        // create a post dao with this connection and try to update blog post info
        $service = new PostDataService($conn);
        $flag = $service->updatePost($post);

        // return the finder results
        AppLogger::info("Exit PostBusinessService.editPostInfo() with " . $flag);
        return $flag;
    }
}
