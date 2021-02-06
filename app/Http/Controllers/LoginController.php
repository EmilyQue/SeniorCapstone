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
            $user = new UserModel(0, 0, 0, 0, $username, $password, 0);

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

                return redirect('home');
            }

            else {
                // return view('loginFail');
                return redirect()->back()->with('message', 'Login Failed');
            }

    }

    /**
     * This method is to log the user out
     * @param Request $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request) {
        // try {
            //$request->session()->forget('user_id');
            $request->session()->flush();
            $request->session()->regenerate(true);
            return redirect('/login');
        // }

        // catch (Exception $e){
        //     //best practice: call all exceptions, log the exception, and display a common error page (or use a global exception handler)
        //     //log exception and display exception view
        //     Log::error("Exception: ", array("message" => $e->getMessage()));
        //     $data = ['errorMsg' => $e->getMessage()];
        //     return view('exception')->with($data);
        // }
    }
}
