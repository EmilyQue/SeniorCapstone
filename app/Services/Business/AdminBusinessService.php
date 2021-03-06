<?php
/*Handles admin user business logic and connections to database*/
namespace App\Services\Business;

use \PDO;
use App\Services\Data\AdminDataService;
use App\Services\Utility\AppLogger;
use App\Services\Utility\DatabaseConnection;

class AdminBusinessService {
    /**
     * Suspend user
     * @param $id
     * @return boolean
     */
    public function suspendUser($id) {
        AppLogger::info("Entering AdminBusinessService.suspendUser()");

        //connect to database
        $conn = new DatabaseConnection();

        //create an admin dao with this connection and try to find and suspend user
        $service = new AdminDataService($conn);
        $flag = $service->suspendUser($id);

        //return the finder results
        AppLogger::info("Exit AdminBusinessService.suspendUser() with " . $flag);
        return $flag;
    }

    /**
     * Unsuspends user
     * @param $id
     * @return boolean
     */
    public function unsuspendUser($id) {
        AppLogger::info("Entering AdminBusinessService.unsuspendUser()");

        //create connection to database
        $conn = new DatabaseConnection();

        //create an admin dao with this connection and try to find and unsuspend user
        $service = new AdminDataService($conn);
        $flag = $service->unsuspendUser($id);

        //return the finder results
        AppLogger::info("Exit AdminBusinessService.unsuspendUser() with " . $flag);
        return $flag;
    }

    /**
     * Displays all users
     * @return array
     */
    public function showUsers() {
        AppLogger::info("Entering AdminBusinessService.showUsers()");

        //create connection to database
        $conn = new DatabaseConnection();

        //create an admin dao with this connection and try to display all users
        $service = new AdminDataService($conn);
        //calls the findAllUsers command
        $flag = $service->findAllUsers();

        //return the finder results
        AppLogger::info("Exit AdminBusinessService.showUsers() with " . print_r($flag, true));
        return $flag;
    }
}
