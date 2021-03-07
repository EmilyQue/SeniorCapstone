<?php
/*Handles user business logic and connections to database*/
namespace App\Services\Business;

use App\Models\CredentialsModel;
use \PDO;
use App\Models\UserModel;
use App\Services\Data\UserDataService;
use Illuminate\Support\Facades\Log;

class UserBusinessService {
/**
     * Create User
     * @param UserModel $user
     * @return boolean
     */
    public function create(UserModel $user) {
        Log::info("Entering UserBusinessService.create()");

        $servername = config("database.connections.mysql.host");
        $dbname = config("database.connections.mysql.database");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");

        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //create a recipe service dao with this connection and try to create recipe
        $service = new UserDataService($conn);
        $flag = $service->createUser($user);

        //return the finder results
        Log::info("Exit UserBusinessService.create() with " . $flag);
        return $flag;
    }

    /**
     * User login
     * @param UserModel $user
     * @return NULL
     */
    public function login(CredentialsModel $user) {
        Log::info("Entering UserBusinessService.login()");

        //get credentials for accessing the database
        $servername = config("database.connections.mysql.host");
        $dbname = config("database.connections.mysql.database");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");

        //create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //create a security service dao with this connection and try to find the password in user
        $service = new UserDataService($conn);
        $flag = $service->findByUser($user);

        //return the finder results
        Log::info("Exit UserBusinessService.login() with " . $flag);
        return $flag;
    }
}
