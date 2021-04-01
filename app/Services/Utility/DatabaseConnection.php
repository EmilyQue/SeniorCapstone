<?php
namespace App\Services\Utility;

use App\Services\Utility\AppLogger;
use PDO;
use Exception;

class DatabaseConnection extends PDO{
    function __construct() {
        try {
            //get credentials for accessing the database
            $servername = config("database.connections.mysql.host");
            $username = config("database.connections.mysql.username");
            $password = config("database.connections.mysql.password");
            $dbname = config("database.connections.mysql.database");

            //create connection to database
            parent::__construct("mysql:host=$servername;dbname=$dbname", $username, $password);
            parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (Exception $e){
            AppLogger::error("Exception: ", array("message" => $e->getMessage()));
        }
    }
}
