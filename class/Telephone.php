<?php
include("DBConnection.php");
class  Telephone
{
    protected $db;
    private $_id_telephone;
    private $_number;
    private $_id_student;

    public function setId($ID) {
        $this->_id_telephone = $ID;
    }
    public function setNumber($number) {
        $this->_number = $number;
    }
    public function setIdStudent($id_student) {
        $this->_id_student = $id_student;
    }

    public function __construct() {
        $this->db = new DBConnection();
        $this->db = $this->db->returnConnection();
    }

    // create 
    public function create() {
		try {
    		$sql = 'INSERT INTO telephones (number, id_student)  VALUES (:number, :id_student)';
    		$data = [
			    'number' => $this->_number,
			    'id_student' => $this->_id_student
			];
	    	$stmt = $this->db->prepare($sql);
	    	$stmt->execute($data);
			$status = $stmt->rowCount();
            return $status;

		} catch (Exception $e) {
    		die("Oh noes! There's an error in the query!");
		}

    }

    // update 
    public function update() {
        try {
		    $sql = "UPDATE telephones SET number=:number, id_student=:id_student, Email=:email WHERE number=:number";
		    $data = [
			    'number' => $this->_number,
			    'id_student' => $this->_address,
			    'id_telephone' => $this->_id_telephone
			];
			$stmt = $this->db->prepare($sql);
			$stmt->execute($data);
			$status = $stmt->rowCount();
            return $status;
		} catch (Exception $e) {
			die("Oh noes! There's an error in the query!");
		}
    }
   
    // getAll 
    public function getAll() {
    	try {
    		$sql = "SELECT * FROM telephones";
		    $stmt = $this->db->prepare($sql);

		    $stmt->execute();
		    $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
		} catch (Exception $e) {
		    die("Oh noes! There's an error in the query!");
		}
    }

    // get 
    public function get() {
    	try {
    		$sql = "SELECT * FROM telephones WHERE id_telephone=:id_telephone";
		    $stmt = $this->db->prepare($sql);
		    $data = [
		    	'id_telephone' => $this->_id_telephone
			];
		    $stmt->execute($data);
		    $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $result;
		} catch (Exception $e) {
		    die("Oh noes! There's an error in the query!");
		}
    }

    // delete 
    public function delete() {
    	try {
	    	$sql = "DELETE FROM telephones WHERE number=:number";
		    $stmt = $this->db->prepare($sql);
		    $data = [
		    	'number' => $this->_number
			];
	    	$stmt->execute($data);
            $status = $stmt->rowCount();
            return $status;
	    } catch (Exception $e) {
		    die("Oh noes! There's an error in the query!");
		}
    }


}
?>	