<?php
namespace App\Services\Data;

use PDO;


//Database interacts with the data from the User class
class AdminDataService {
    private $conn = null;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    /**
     * Fetches all users from the database
     * @return array
     */
    public function findAllUsers() {
        //prepared statement is created to display users
        $stmt = $this->conn->prepare('SELECT * from users');
        //executes prepared query
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            //user array is created
            $userArray = array();
            //fetches result from prepared statement and returns as an array
            while ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
                //inserts variables into end of array
                array_push($userArray, $user);
            }
            //return user array
            return $userArray;
        }
    }

    /**
     * Suspends the user's account
     * @param  $id
     * @return boolean
     */
    public function suspendUser($id) {
        //prepared statement is created
        $stmt = $this->conn->prepare("UPDATE users SET `active` = '1' WHERE `id` = :id");
        //bind parameter
        $stmt->bindParam(':id', $id);
        //executes statement
        $suspend = $stmt->execute();

        //returns true or false if user active row has been set to 1
        if ($suspend) {
            return true;
        }

        else {
            return false;
        }
    }

    /**
     * Unsuspends the user's account
     * @param  $id
     * @return boolean
     */
    public function unsuspendUser($id) {
        //prepared statement is created
        $stmt = $this->conn->prepare("UPDATE users SET `active` = '0' WHERE `id` = :id");
        //bind parameter
        $stmt->bindParam(':id', $id);
        //executes statement
        $unsuspend = $stmt->execute();

        //returns true or false if user active row has been set to 0
        if ($unsuspend) {
            return true;
        }

        else {
            return false;
        }
    }
}
