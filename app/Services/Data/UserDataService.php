<?php
namespace App\Services\Data;

use App\Models\UserModel;

//Database interacts with the data from the Recipe class
class UserDataService {
    private $conn = null;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Method to add user to database
    public function createUser(UserModel $user) {
        //select variables and see if the row exists
        $firstName = $user->getFirstName();
        $lastName = $user->getLastName();
        $email = $user->getEmail();
        $username = $user->getUsername();
        $password = $user->getPassword();

        //prepared statements is created
        $stmt = $this->conn->prepare("INSERT INTO `users` (`firstName`, `lastName`, `email`, `username`, `password`) VALUES (:firstName, :lastName, :email, :username, :password)");
        //binds parameters
        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':lastName', $lastName);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);

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
     * Finds user in database in order to log in
     * @param UserModel $user
     * @return NULL
     */
    public function findByUser(UserModel $user) {
        //select username and password and see if the row exists
        $username = $user->getUsername();
        $password = $user->getPassword();

        $stmt = $this->conn->prepare('SELECT * FROM users WHERE BINARY username = :username AND password = :password');
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        /*see if user existed and return true if found
            else return false if not found*/
        if ($stmt->rowCount() == 1) {
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $user['id'];
        }

        else {
            return null;
        }
    }
}
