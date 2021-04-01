<?php
/* Profile module processes the profile logic */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Exception;
use App\Models\ProfileModel;
use App\Models\UserTravelModel;
use App\Services\Business\ProfileBusinessService;
use App\Services\Utility\AppLogger;

class ProfileController extends Controller {
    /**
     * This method creates user profile
     * @param Request $request
     * @throws ValidationException
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index(Request $request) {
        try{
            AppLogger::info("Entering ProfileController.index()");

            //recieves data inputed from user
            $name = $request->input('name');
            $country = $request->input('country');
            $about = $request->input('about');

            if($request->session()->has('user_id')) {
                $user_id = $request->session()->get('user_id');
            }
            //2. create object model
            //save posted form data in profile object model
            $profile = new ProfileModel(-1, $name, $country, $about, $user_id);

            //3. execute business service
            //call post business service
            $service = new ProfileBusinessService();
            $status = $service->create($profile);

            //4. process results from business service (navigation)
            //render a failed or success response view and pass the post model to it
            if ($status) {
                return redirect()->action('App\Http\Controllers\ProfileController@displayUserProfile');
                // return view('userProfile');
            }

            else {
                return view("registerFail");
            }
        }

        catch (Exception $e){
            //log exception and display exception view
            AppLogger::error("Exception: ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
    }

    /**
     * This method is to display user profile
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function displayUserProfile(Request $request) {
        AppLogger::info("Entering ProfileController.displayUserProfile()");

        try{
            //get session user id and username
            $id = session()->get('user_id');
            $username = session()->get('username');

            //call post business service
            $service = new ProfileBusinessService();
            $profile = $service->findProfileByUserID($id);
            $travel = $service->findTravelByUserID($id);

            //render a response view
            return view('userProfile')->with(['profile' => $profile, 'username' => $username, 'travel' => $travel]);
        }

        catch (Exception $e){
            //log exception and display exception view
            AppLogger::error("Exception: ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
    }

/**
     * This method is to find the user's profile
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory|boolean
     */
    public function findProfile() {
        AppLogger::info("Entering ProfileController.findProfile()");

        try {
            //get posted form data
            $id = session()->get('user_id');

            //call security business service
            $service = new ProfileBusinessService();
            $profile = $service->findProfileByUserID($id);

            //process results from business service (navigation)
            //render a failed or edit education view and pass the education model to it

            if ($profile) {
                return view('userProfile')->with('profile', $profile);
            }

            else {
                return false;
            }
        }

        catch (Exception $e){
            //log exception and display exception view
            AppLogger::error("Exception: ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
    }

    /**
     * This method is to update the user's profile info
     * @param Request $request
     * @throws ValidationException
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfileInfo(Request $request) {
        AppLogger::info("Entering ProfileController.updateProfileInfo()");

        try {
            //get posted form data
            $id = $request->input('id');
            $name = $request->input('name');
            $country = $request->input('country');
            $about = $request->input('about');

            if ($request->session()->has('user_id')) {
                $user_id = $request->session()->get('user_id');
            }

            //create object model and save posted form data in contact object model
            $userProfile = new ProfileModel($id, $name, $country, $about, $user_id);

            //execute business service and call security business service
            $service = new ProfileBusinessService();
            $status = $service->editProfileInfo($userProfile);

            //process results from business service (navigation)
            //render a failed or redirect to profile view
            if ($status) {

                return redirect()->action('App\Http\Controllers\ProfileController@displayUserProfile');
            }

            else {
                return view('profileFail');
            }
        }

        catch (ValidationException $e1) {
            throw $e1;
        }

        catch (Exception $e){
            //log exception and display exception view
            AppLogger::error("Exception: ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
    }

    /**
     * This method creates user recent travels
     * @param Request $request
     * @throws ValidationException
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function addRecentTravel(Request $request) {
        AppLogger::info("Entering ProfileController.addRecentTravel()");

        try{
            //recieves data inputed from user
            $destination = $request->input('destination');
            $departure = $request->input('departure_date');
            $return = $request->input('return_date');
            $image = $request->input('image');


            if($request->session()->has('user_id')) {
                $user_id = $request->session()->get('user_id');
            }
            //2. create object model
            //save posted form data in profile object model
            $travel = new UserTravelModel(-1, $destination, $departure, $return, $image, $user_id);

            //3. execute business service
            //call post business service
            $service = new ProfileBusinessService();
            $status = $service->createRecentTravel($travel);

            //4. process results from business service (navigation)
            //render a failed or success response view and pass the post model to it
            if ($status) {
                return redirect()->action('App\Http\Controllers\ProfileController@displayUserProfile');
                // return view('userProfile');
            }

            else {
                return view("registerFail");
            }
        }

        catch (Exception $e){
            //log exception and display exception view
            AppLogger::error("Exception: ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
    }
}
