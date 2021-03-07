<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Services\Business\UserBusinessService;
use Illuminate\Validation\ValidationException;
use App\Services\Utility\ILoggerService;
use Illuminate\Support\Facades\Log;
use Exception;

class RegisterController extends Controller {
    /**
     * Uses the logger service to log any messages
     * @param ILoggerService $logger
     */
    public function __construct(ILoggerService $logger) {
        $this->logger = $logger;
    }

    //add a user
    public function index(Request $request){
        try{
            $this->logger->info("Entering RegisterController.index()");
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
            //note: this exception must be caught before exception bc validationexception extends from exception
            //must rethrow this exception in order for laravel to display your submitted page with errors
            //catch and rethrow data validation exception (so we can catch all others in our next exception catch block
            throw $e1;
        }

        catch (Exception $e){
            //log exception and display exception view
            $this->logger->error("Exception: ", array("message" => $e->getMessage()));
            return view("registerFail");
        }
    }

    private function validateForm(Request $request){
        //best practice: centralize your rules so you have a consistent architecture and even reuse your rules
        //bad practice: not using a defined data validation framework, putting rules all over your code, doing only on client side or database
        //setup data validation rules for login form
        $rules = ['email' => 'email', 'username' => 'unique:users'];

        $customMessage = ['unique' => '*Username already exists', 'email' => '*Must be a valid email address'];

        //run data validation rules
        $this->validate($request, $rules, $customMessage);
    }
}
