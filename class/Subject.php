<?php
include("DBConnection.php");
class Subject
{
    protected $db;
    private $_id_subject;
    private $_name;
    private $_note;
    private $_id_expedient;

    public function setId($ID) {
        $this->_id_subject = $ID;
    }
    public function setName($name) {
        $this->_name = $name;
    }
    public function setNote($note) {
        $this->_note = $note;
    }
    public function setIdExpedient($id_expedient) {
        $this->_id_expedient = $id_expedient;
    }

    public function __construct() {
        $this->db = new DBConnection();
        $this->db = $this->db->returnConnection();
    }

    // create 
    public function create() {
		try {
    		$sql = 'INSERT INTO subjects (name, note, id_expedient)  VALUES (:name, :note, :id_expedient)';
    		$data = [
			    'name' => $this->_name,
			    'note' => $this->_note,
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

    // update 
    public function update() {
        try {
		    $sql = "UPDATE subjects SET name=:name, note=:note, id_expedient=:id_expedient WHERE id_subject=:_id";
		    $data = [
			    'name' => $this->_name,
			    'note' => $this->_note,
			    'id_expedient' => $this->_id_expedient,
			    '_id' => $this->_id_subject
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
    		$sql = "SELECT * FROM subjects";
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
    		$sql = "SELECT * FROM subjects WHERE id_expedient=:_id";
		    $stmt = $this->db->prepare($sql);
		    $data = [
		    	'_id' => $this->_id_subject
			];
		    $stmt->execute($data);
		    $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
		} catch (Exception $e) {
		    die("Oh noes! There's an error in the query!");
		}
    }

    // delete 
    public function delete() {
    	try {
	    	$sql = "DELETE FROM subjects WHERE id_subject=:_id";
		    $stmt = $this->db->prepare($sql);
		    $data = [
		    	'_id' => $this->_id_subject
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