<?php
namespace App\Services\Data;

use PDO;
use App\Services\Utility\DatabaseException;
use PDOException;
use Illuminate\Support\Facades\Log;

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
        Log::info("Entering AdminDataService.findAllUsers()");
        try{
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
                Log::info("Exiting AdminDataService.findAllUsers() with true");
                return $userArray;
            }
        }

        catch (PDOException $e){
            //log and throw custom exception
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Suspends the user's account
     * @param  $id
     * @return boolean
     */
    public function suspendUser($id) {
        Log::info("Entering AdminDataService.suspendUser()");
        try{
            //prepared statement is created
            $stmt = $this->conn->prepare("UPDATE users SET `active` = '1' WHERE `id` = :id");
            //bind parameter
            $stmt->bindParam(':id', $id);
            //executes statement
            $suspend = $stmt->execute();

            //returns true or false if user active row has been set to 1
            if ($suspend) {
                Log::info("Exiting AdminDataService.suspendUser() with true");
                return true;
            }

            else {
                Log::info("Exiting AdminDataService.suspendUser() with false");
                return false;
            }
        }

        catch (PDOException $e){
           //log and throw custom exception
           Log::error("Exception: ", array("message" => $e->getMessage()));
           throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Unsuspends the user's account
     * @param  $id
     * @return boolean
     */
    public function unsuspendUser($id) {
        Log::info("Entering AdminDataService.unsuspendUser()");
        try{
            //prepared statement is created
            $stmt = $this->conn->prepare("UPDATE users SET `active` = '0' WHERE `id` = :id");
            //bind parameter
            $stmt->bindParam(':id', $id);
            //executes statement
            $unsuspend = $stmt->execute();

            //returns true or false if user active row has been set to 0
            if ($unsuspend) {
                Log::info("Exiting AdminDataService.unsuspendUser() with false");
                return true;
            }

            else {
                Log::info("Exiting AdminDataService.unsuspendUser() with false");
                return false;
            }
        }

        catch (PDOException $e){
            //log and throw custom exception
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
}
