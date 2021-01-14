<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Services\Business\UserBusinessService;

class RegisterController extends Controller {
    //add a user
    public function index(Request $request){
        //recieves data inputed from user
        $firstName = $request->input('firstName');
        $lastName = $request->input('lastName');
        $email = $request->input('email');
        $username = $request->input('username');
        $password = $request->input('password');

        //2. create object model
        //save posted form data in user object model
        $user = new UserModel(-1, $firstName, $lastName, $email, $username, $password);

        //3. execute business service
        //call user business service
        $service = new UserBusinessService();
        $status = $service->create($user);

        //4. process results from business service (navigation)
        //render a failed or success response view and pass the user model to it
        if ($status) {
            return view("registerSuccess");
        }

        else {
            return view("registerFail");
        }
    }
}
