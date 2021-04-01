<?php
/*Handles profile business logic and connections to database*/
namespace App\Services\Business;

use App\Models\ProfileModel;
use App\Models\UserTravelModel;
use \PDO;
use App\Services\Data\ProfileDataService;
use App\Services\Utility\AppLogger;
use App\Services\Utility\DatabaseConnection;

class ProfileBusinessService {
/**
     * Create Profile
     * @param ProfileModel $model
     * @return boolean
     */
    public function create(ProfileModel $profile) {
        AppLogger::info("Entering ProfileBusinessService.create()");

        //create connection to database
        $conn = new DatabaseConnection();

        //create a profile service dao with this connection and try to create profile
        $service = new ProfileDataService($conn);
        $flag = $service->createProfile($profile);

        //return the finder results
        AppLogger::info("Exit ProfileBusinessService.create() with " . $flag);
        return $flag;
    }

    /**
     * Finds the profile info by user id
     * @param $id
     * @return array
     */
    public function findProfileByUserID($id) {
        AppLogger::info("Entering ProfileBusinessService.findProfileByUserID()");

        //create connection to database
        $conn = new DatabaseConnection();

        //create a profile dao with this connection and try to find profile by id
        $service = new ProfileDataService($conn);
        $flag = $service->findProfileByUserID($id);

        //return the finder results
        AppLogger::info("Exit ProfileBusinessService.findProfileByUserID() with " . print_r($flag, true));
        return $flag;
    }

    /**
     * Updates the profile info
     * @param ProfileModel $profileInfo
     * @return boolean
     */
    public function editProfileInfo(ProfileModel $profileInfo)
    {
        AppLogger::info("Entering ProfileBusinessService.editProfileInfo()");

        //create connection to database
        $conn = new DatabaseConnection();

        // create a profile dao with this connection and try to update user profile info
        $service = new ProfileDataService($conn);
        $flag = $service->updateProfileInfo($profileInfo);
        // return the finder results
        AppLogger::info("Exit ProfileBusinessService.editProfileInfo() with " . $flag);
        return $flag;
    }

    /**
     * Create Recent Travels
     * @param UserTravelModel $model
     * @return boolean
     */
    public function createRecentTravel(UserTravelModel $travel) {
        AppLogger::info("Entering ProfileBusinessService.create()");

        //create connection to database
        $conn = new DatabaseConnection();

        //create a profile service dao with this connection and try to create profile
        $service = new ProfileDataService($conn);
        $flag = $service->createRecentTravel($travel);

        //return the finder results
        AppLogger::info("Exit ProfileBusinessService.create() with " . $flag);
        return $flag;
    }

    /**
     * Finds the recent travel info by user id
     * @param $id
     * @return array
     */
    public function findTravelByUserID($id) {
        AppLogger::info("Entering ProfileBusinessService.findTravelByUserID()");

        //create connection to database
        $conn = new DatabaseConnection();

        //create a post dao with this connection and try to find blog post by id
        $service = new ProfileDataService($conn);
        $flag = $service->findTravelByUserID($id);

        //return the finder results
        AppLogger::info("Exit ProfileBusinessService.findTravelByUserID() with " . print_r($flag, true));
        return $flag;
    }
}
