<?php
/* Login module processes the authentication of user credentials */


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Exception;
use App\Models\CredentialsModel;
use App\Services\Business\UserBusinessService;
use Illuminate\Support\Facades\Log;
use App\Services\Utility\ILoggerService;

class LoginController extends Controller {
    /**
     * Uses the logger service to log any messages
     * @param ILoggerService $logger
     */
    public function __construct(ILoggerService $logger) {
        $this->logger = $logger;
     }

    /**
     * This method authenticates the user's credentials
     * @param Request $request
     * @throws ValidationException
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index(Request $request) {
        try{
            $this->logger->info("Entering LoginController.index()");
            //1. process form data
            //get posted form data
            $username = $request->input('username');
            $password = $request->input('password');

            //2. create object model
            //save posted form data in user object model
            $user = new CredentialsModel(0, $username, $password, 0, 0);

            //3. execute business service
            //call security business service
            $service = new UserBusinessService();

            $user_id = $service->login($user);

            //4. process results from business service (navigation)
            //set session variables
            //render a failed or success response view and pass the user model to it

            if ($user != null && $user_id) {
                $request->session()->put('username', $username);
                $request->session()->put('user_id', $user_id);
                $request->session()->put('role', $user_id);
                $request->session()->put('active', $user_id);

                // return redirect('home');
                return redirect()->action('App\Http\Controllers\PostController@displayFeaturedPosts');
            }

            else {
                // return view('loginFail');
                return redirect()->back()->with('message', 'Login Failed');
            }
        }

        catch (Exception $e){
            //log exception and display exception view
            $this->logger->error("Exception: ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
    }

    /**
     * This method is to log the user out
     * @param Request $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request) {
        try {
            //$request->session()->forget('user_id');
            $request->session()->flush();
            $request->session()->regenerate(true);
            return redirect('/login');
        }

        catch (Exception $e){
            //log exception and display exception view
            Log::error("Exception: ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
    }
}
