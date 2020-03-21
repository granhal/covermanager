<?php
include("DBConnection.php");
class Student 
{
    protected $db;
    private $_id_student;
    private $_name;
    private $_address;
    private $_email;

    public function setId($id) {
        $this->_id_student = $id;
    }
    public function setName($name) {
        $this->_name = $name;
    }
    public function setAddress($address) {
        $this->_address = $address;
    }
    public function setEmail($email) {
        $this->_email = $email;
    }

    public function __construct() {
        $this->db = new DBConnection();
        $this->db = $this->db->returnConnection();
    }

    // create
    public function create() {
		try {
    		$sql = 'INSERT INTO students (name, address, email)  VALUES (:name, :address, :email)';
    		$data = [
			    'name' => $this->_name,
			    'address' => $this->_address,
			    'email' => $this->_email
			];
	    	$stmt = $this->db->prepare($sql);
	    	$stmt->execute($data);
			$status = $stmt->rowCount();
            return $this->db->lastInsertId();

		} catch (Exception $e) {
    		die("Oh noes! There's an error in the query!");
		}

    }

    // update
    public function update() {
        try {
		    $sql = "UPDATE students SET name=:name, address=:address, email=:email WHERE id_student=:id_student";
		    $data = [
			    'name' => $this->_name,
			    'address' => $this->_address,
			    'email' => $this->_email,
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
   
    // getAll
    public function getAll() {
    	try {
			$sql = "SELECT s.*, AVG(note) as avg_notes, Group_Concat(DISTINCT e.id_expedient) AS expedients, Group_Concat(DISTINCT number) as numbers  FROM students AS s  LEFT JOIN expedients AS e ON s.id_student = e.id_student LEFT JOIN telephones AS t ON s.id_student = t.id_student  LEFT JOIN subjects AS su ON e.id_expedient = su.id_expedient  GROUP BY id_student";
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
    		$sql = "SELECT * FROM students WHERE id_student=:id_student";
		    $stmt = $this->db->prepare($sql);
		    $data = [
		    	'id_student' => $this->_id_student
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
	    	$sql = "DELETE FROM students WHERE id_student=:id_student";
		    $stmt = $this->db->prepare($sql);
		    $data = [
		    	'id_student' => $this->_id_student
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