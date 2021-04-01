<?php
namespace App\Services\Data;

use PDO;
use App\Models\ProfileModel;
use App\Models\UserTravelModel;
use App\Services\Utility\AppLogger;
use App\Services\Utility\DatabaseException;
use PDOException;

//Database interacts with the data from the Profile class
class ProfileDataService {
    private $conn = null;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Method to add user to database
    public function createProfile(ProfileModel $profile) {
        AppLogger::info("Entering ProfileDataService.createProfile()");

        try{
            //select variables and see if the row exists
            $name = $profile->getName();
            $country = $profile->getCountry();
            $about = $profile->getAbout();
            $user_id = $profile->getUser_id();


            //prepared statements is created
            $stmt = $this->conn->prepare("INSERT INTO `profile` (`name`, `country`, `about`, `users_id`) VALUES (:name, :country, :about, :user_id)");
            //binds parameters
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':country', $country);
            $stmt->bindParam(':about', $about);
            $stmt->bindParam(':user_id', $user_id);

            /*see if user existed and return true if found
            else return false if not found*/
            if ($stmt->execute()) {
                AppLogger::info("Exit ProfileDataService.createProfile() with true");
                return true;
            }

            else {
                AppLogger::info("Exit ProfileDataService.createProfile() with false");
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
     * Finds the profile by user id
     * @param  $id
     * @return array
     */
    public function findProfileByUserID($id) {
        AppLogger::info("Entering ProfileDataService.findProfileByUserID()");
        try{
            //prepared statement is created and user id is binded
            $stmt = $this->conn->prepare('SELECT * FROM profile WHERE users_id = :id');
            $stmt->bindParam(':id', $id);

            //list array is created and statement is executed
            $list = array();
            $stmt->execute();

            //loops through table  using stmt->fetch
            for ($i = 0; $row = $stmt->fetch(); $i++) {
                //post model is created
                $profileSearch = new ProfileModel($row['id'], $row['name'], $row['country'], $row['about'], $id);
                //inserts variables into end of array
                array_push($list, $profileSearch);
            }
            //return list array that holds job variables
            AppLogger::info("Exiting ProfileDataService.findProfileByUserID() with true");
            return $list;
        }

        catch (PDOException $e) {
            //log and throw custom exception
            AppLogger::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Updates user profile info in database
     * @param ProfileModel $profileInfo
     * @throws DatabaseException
     * @return boolean
     */
    public function updateProfileInfo(ProfileModel $profileInfo)
    {
        AppLogger::info("Entering ProfileDataService.updateProfileInfo()");
        try {
            // select variables and see if the row exists
            $id = $profileInfo->getId();
            $name = $profileInfo->getName();
            $country = $profileInfo->getCountry();
            $about = $profileInfo->getAbout();

            // prepared statements is created
            $stmt = $this->conn->prepare("UPDATE profile SET `name` = :name, `country` = :country, `about` = :about WHERE `id` = :profile_id");
            // binds parameters
            $stmt->bindParam(':profile_id', $id);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':country', $country);
            $stmt->bindParam(':about', $about);
            $stmt->execute();

            /*
             * return true if data was inserted
             * else return false if unsuccessful
             */
            if ($stmt->rowCount() == 1) {
                AppLogger::info("Exit ProfileDataService.updateProfileInfo() with true");
                return true;
            } else {
                AppLogger::info("Exit ProfileDataService.updateProfileInfo() with false");
                return false;
            }
        } catch (PDOException $e) {
            //log and throw custom exception
            AppLogger::error("Exception: ", array(
                "message" => $e->getMessage()
            ));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }

    // Method to add recent travels
    public function createRecentTravel(UserTravelModel $travel) {
        AppLogger::info("Entering ProfileDataService.createRecentTravel()");

        try{
            //select variables and see if the row exists
            $destination = $travel->getDestination();
            $departure = $travel->getDeparture();
            $return = $travel->getReturn();
            $image = $travel->getImage();
            $user_id = $travel->getUser_id();

            //prepared statements is created
            $stmt = $this->conn->prepare("INSERT INTO `recent_travels` (`destination`, `departure`, `return`, `image`, `users_id`) VALUES (:destination, :departure, :return, :image, :user_id)");
            //binds parameters
            $stmt->bindParam(':destination', $destination);
            $stmt->bindParam(':departure', $departure);
            $stmt->bindParam(':return', $return);
            $stmt->bindParam(':image', $image);
            $stmt->bindParam(':user_id', $user_id);

            /*see if user existed and return true if found
            else return false if not found*/
            if ($stmt->execute()) {
                AppLogger::info("Exit ProfileDataService.createRecentTravel() with true");
                return true;
            }

            else {
                AppLogger::info("Exit ProfileDataService.createRecentTravel() with false");
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
     * Finds the recent travel by user id
     * @param  $id
     * @return array
     */
    public function findTravelByUserID($id) {
        AppLogger::info("Entering ProfileDataService.findTravelByUserID()");
        try{
            //prepared statement is created and user id is binded
            $stmt = $this->conn->prepare('SELECT * FROM recent_travels WHERE users_id = :id');
            $stmt->bindParam(':id', $id);

            //list array is created and statement is executed
            $list = array();
            $stmt->execute();

            //loops through table  using stmt->fetch
            for ($i = 0; $row = $stmt->fetch(); $i++) {
                //post model is created
                $travelSearch = new UserTravelModel($row['id'], $row['destination'], $row['departure'], $row['return'], $row['image'], $id);
                //inserts variables into end of array
                array_push($list, $travelSearch);
            }
            //return list array that holds job variables
            AppLogger::info("Exiting ProfileDataService.findTravelByUserID() with true");
            return $list;
        }

        catch (PDOException $e) {
            //log and throw custom exception
            AppLogger::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
}
