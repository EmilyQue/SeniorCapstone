<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Services\Business\UserBusinessService;
use Illuminate\Validation\ValidationException;
use App\Services\Utility\AppLogger;
use Exception;

class RegisterController extends Controller {
    //add a user
    public function index(Request $request){
        AppLogger::info("Entering RegisterController.index()");

        try{
            $this->validateForm($request);

            //recieves data inputed from user
            $firstName = $request->input('firstName');
            $lastName = $request->input('lastName');
            $email = $request->input('email');
            $username = $request->input('username');
            $password = $request->input('password');

            //2. create object model
            //save posted form data in user object model
            $user = new UserModel(-1, $firstName, $lastName, $email, $username, $password, 0, 0);

            //3. execute business service
            //call user business service
            $service = new UserBusinessService();
            $status = $service->create($user);

            //4. process results from business service (navigation)
            //render a failed or success response view and pass the user model to it
            if ($status) {
                return redirect('/login');
            }

            else {
                return view("registerFail");
            }
        }
        catch (ValidationException $e1) {
            throw $e1;
        }

        catch (Exception $e){
            //log exception and display exception view
            AppLogger::error("Exception: ", array("message" => $e->getMessage()));
            return view("registerFail");
        }
    }

    private function validateForm(Request $request){
        $rules = ['email' => 'email', 'username' => 'unique:users'];

        $customMessage = ['unique' => '*Username already exists', 'email' => '*Must be a valid email address'];

        //run data validation rules
        $this->validate($request, $rules, $customMessage);
    }
}
