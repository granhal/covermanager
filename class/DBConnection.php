<?php
// header('Access-Control-Allow-Origin: *');
// header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
// header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

// Database Connection
class DBConnection {
    private $_dbHostname = "localhost";
    private $_dbName = "covermanager";
    private $_dbUsername = "root";
    private $_dbPassword = "root";
    private $_con;
 
    public function __construct() {
    	try {
        	$this->_con = new PDO("mysql:host=$this->_dbHostname;dbname=$this->_dbName", $this->_dbUsername, $this->_dbPassword);    
        	$this->_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    } catch(PDOException $e) {
			echo "Connection failed: " . $e->getMessage();
		}
 
    }
    // return Connection
    public function returnConnection() {
        return $this->_con;
    }
}
?>