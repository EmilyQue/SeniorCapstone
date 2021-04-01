<?php
/*Handles user business logic and connections to database*/
namespace App\Services\Business;

use App\Models\CredentialsModel;
use \PDO;
use App\Models\UserModel;
use App\Services\Data\UserDataService;
use App\Services\Utility\AppLogger;
use App\Services\Utility\DatabaseConnection;

class UserBusinessService {
/**
     * Create User
     * @param UserModel $user
     * @return boolean
     */
    public function create(UserModel $user) {
        AppLogger::info("Entering UserBusinessService.create()");

        //create connection to database
        $conn = new DatabaseConnection();

        //create a recipe service dao with this connection and try to create recipe
        $service = new UserDataService($conn);
        $flag = $service->createUser($user);

        //return the finder results
        AppLogger::info("Exit UserBusinessService.create() with " . $flag);
        return $flag;
    }

    /**
     * User login
     * @param UserModel $user
     * @return NULL
     */
    public function login(CredentialsModel $user) {
        AppLogger::info("Entering UserBusinessService.login()");

        //create connection to database
        $conn = new DatabaseConnection();

        //create a security service dao with this connection and try to find the password in user
        $service = new UserDataService($conn);
        $flag = $service->findByUser($user);

        //return the finder results
        AppLogger::info("Exit UserBusinessService.login() with " . $flag);
        return $flag;
    }
}
