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
        //call user business service
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
        //call user business service
        $service = new AdminBusinessService();
        $suspend = $service->suspendUser($id);
        //renders a success or fail view
        if($suspend) {
            return view('suspendSuccess');
        }

        else {
            return view('suspendFail');
        }
    }

    /**
     * This method is to unsuspend user
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function unsuspendUser() {
        //GET method for user id
        $id = $_GET['id'];
        //calls user business service
        $service = new AdminBusinessService();
        $unsuspend = $service->unsuspendUser($id);
        //renders a success or fail view
        if($unsuspend) {
            return view('unsuspendSuccess');
        }

        else {
            return view('unsuspendFail');
        }
    }
}