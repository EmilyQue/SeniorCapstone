<?php

namespace App\Http\Controllers;

use App\Services\Business\AdminBusinessService;
use App\Services\Utility\AppLogger;
use Exception;
use App\Models\DTO;

class UsersRestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        AppLogger::info("Entering UsersRestController.index()");

        try {
            //call service to get all users
            $service = new AdminBusinessService();
            $users = $service->showUsers();

            if ($users != null) {
                $dto = new DTO(0, "OK", $users);

                //return json back to caller

            }
            else {
                $dto = new DTO(-1, "Users Not Found", "");
            }
            //serialize the dto to JSON
            $json = json_encode($users);

            return $json;
        }

        catch (Exception $e1) {
            //log exception
            AppLogger::error("Exception: ", array("message" => $e1->getMessage()));

            //return an error back to the user in the dto
            $dto = new DTO(-2, $e1->getMessage(), "");
            return json_encode($dto);
        }
    }
}
