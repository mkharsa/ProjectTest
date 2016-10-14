<?php
 
/**
 * A class file to connect to database
 */
class DB_CONNECT {
 
    // constructor
    function __construct() {
        // connecting to database
        $this->connect();
    }
 
    // destructor
    function __destruct() {
        // closing db connection
        $this->close();
    }
 
    /**
     * Function to connect with database
     */
    function connect() {
        // import database connection variables
        require_once __DIR__ . '/db_config.php';
 
        // Connecting to mysql database
        $db = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD,DB_DATABASE) ;
        if (!$db) {
        	echo "Error: Unable to connect to MySQL." . PHP_EOL;
        	echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        	echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        	exit;
        }
        

        // Selecing database
        //$db = mysqli_select_db(DB_DATABASE) or die(mysqli_error()) or die(mysqli_error());
 
        // returing connection cursor
        return $db;
    }
 
    /**
     * Function to close db connection
     */
    function close() {
        // closing db connection
        //mysql_close();
    }
 
}
 
?>