<?php
/* Login module processes the authentication of user credentials */


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Exception;
use App\Models\UserModel;
use App\Services\Business\UserBusinessService;

class LoginController extends Controller
{
    /**
     * This method authenticates the user's credentials
     * @param Request $request
     * @throws ValidationException
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index(Request $request) {
        //1. process form data
        //get posted form data
        $username = $request->input('username');
        $password = $request->input('password');

        //2. create object model
        //save posted form data in user object model
        $user = new UserModel(0, 0, 0, 0, $username, $password);

        //3. execute business service
        //call security business service
        $service = new UserBusinessService();

        $user = $service->login($user);

        //4. process results from business service (navigation)
        //set session variables
        //render a failed or success response view and pass the user model to it

        if ($user) {
            return view('loginSuccess');
        }

        else {
            return view('loginFail');
        }
    }
}
