<?php
namespace App\Services\Data;

use PDO;
use App\Models\CredentialsModel;
use App\Models\UserModel;
use App\Services\Utility\AppLogger;
use App\Services\Utility\DatabaseException;
use PDOException;

//Database interacts with the data from the Recipe class
class UserDataService {
    private $conn = null;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Method to add user to database
    public function createUser(UserModel $user) {
        AppLogger::info("Entering UserDataService.createUser()");

        try{
            //select variables and see if the row exists
            $firstName = $user->getFirstName();
            $lastName = $user->getLastName();
            $email = $user->getEmail();
            $username = $user->getUsername();
            $password = $user->getPassword();
            $role = $user->getRole();
            $active = $user->getActive();

            //prepared statements is created
            $stmt = $this->conn->prepare("INSERT INTO `users` (`firstName`, `lastName`, `email`, `username`, `password`, `role`, `active`) VALUES (:firstName, :lastName, :email, :username, :password, :role, :active)");
            //binds parameters
            $stmt->bindParam(':firstName', $firstName);
            $stmt->bindParam(':lastName', $lastName);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':role', $role);
            $stmt->bindParam(':active', $active);

            /*see if user existed and return true if found
            else return false if not found*/
            if ($stmt->execute() >= 1) {
                AppLogger::info("Exit UserDataService.createUser() with true");
                return true;
            }

            else {
                AppLogger::info("Exit UserDataService.createUser() with false");
                return false;
            }
        }

        catch (PDOException $e){
            //log exception and throw custom exception
            AppLogger::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Finds user in database in order to log in
     * @param UserModel $user
     * @return NULL
     */
    public function findByUser(CredentialsModel $user) {
        AppLogger::info("Entering UserDataService.findByUser()");

        try{
            //select username and password and see if the row exists
            $username = $user->getUsername();
            $password = $user->getPassword();
            $active = $user->getActive();

            $stmt = $this->conn->prepare('SELECT * FROM users WHERE BINARY username = :username AND password = :password AND active = :active');
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':active', $active);

            $stmt->execute();

            /*see if user existed and return true if found
                else return false if not found*/
            if ($stmt->rowCount() == 1) {
                $user = $stmt->fetch(\PDO::FETCH_ASSOC);
                AppLogger::info("Exit UserDataService.findByUser() with true");
                return $user['id'];
            }

            else {
                AppLogger::info("Exit UserDataService.findByUser() with false");
                return null;
            }
        }

        catch (PDOException $e){
            //log exception and throw custom exception
            AppLogger::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
}
