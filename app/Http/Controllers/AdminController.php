<?php
/* Admin controller handles user admin methods */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Services\Business\AdminBusinessService;

class AdminController extends Controller {
    /**
     * This method is to display all users from database
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index(Request $request) {
        //call admin business service
        $service = new AdminBusinessService();
        $users = $service->showUsers();
        //render a response view
        if ($users) {
            return view('displayUsers')->with($users);
        }
    }

    /**
     * This method is to suspend user
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function suspendUser() {
        //GET method for user id
        $id = $_GET['id'];
        //call admin business service
        $service = new AdminBusinessService();
        $suspend = $service->suspendUser($id);
        //renders a success or fail view
        if($suspend) {
            // return view('suspendSuccess');
            return redirect()->back()->with('message', 'Account suspended');
        }

        else {
            return redirect()->back()->with('message', 'Failed to suspend account');
            // return view('suspendFail');
        }
    }

    /**
     * This method is to unsuspend user
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function unsuspendUser() {
        //GET method for user id
        $id = $_GET['id'];
        //calls admin business service
        $service = new AdminBusinessService();
        $unsuspend = $service->unsuspendUser($id);
        //renders a success or fail view
        if($unsuspend) {
            return redirect()->back()->with('message', 'Account was unsuspended');
            // return view('unsuspendSuccess');
        }

        else {
            return redirect()->back()->with('message', 'Failed to unsuspend account');
            // return view('unsuspendFail');
        }
    }
}
