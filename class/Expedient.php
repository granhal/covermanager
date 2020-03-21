<?php
include("DBConnection.php");
class Expedient 
{
	protected $db;
	
    private $_id_expedient;
	private $_expedient_number;
	private $_id_student;

    public function setId($id) {
        $this->_id_expedient = $id;
    }
    public function setExpedientNumber($number) {
        $this->_expedient_number = $number;
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
    		$sql = 'INSERT INTO expedients (expedient_number, id_student)  VALUES (:expedient_number, :id_student)';
    		$data = [
			    'expedient_number' => $this->_expedient_number,
			    'id_student' => $this->_id_student,
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
		    $sql = "UPDATE expedients SET expedient_number=:expedient_number, id_student=:id_student WHERE id_expedient=:id_expedient";
		    $data = [
			    'expedient_number' => $this->_expedient_number,
				'id_student' => $this->_id_student,
				'id_expedient' => $this->_id_expedient
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
    		$sql = "SELECT * FROM expedients";
		    $stmt = $this->db->prepare($sql);

		    $stmt->execute();
		    $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
		} catch (Exception $e) {
		    die("Oh noes! There's an error in the query!");
		}
    }

    // get
    public function getOne() {
    	try {
    		$sql = "SELECT * FROM expedients WHERE id_expedient=:id_expedient";
		    $stmt = $this->db->prepare($sql);
		    $data = [
		    	'id_expedient' => $this->_id_expedient
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
	    	$sql = "DELETE FROM expedients WHERE id_expedient=:id_expedient";
		    $stmt = $this->db->prepare($sql);
		    $data = [
		    	'id_expedient' => $this->_id_expedient
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