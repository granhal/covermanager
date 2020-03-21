<?php
$requestMethod = $_SERVER["REQUEST_METHOD"];
include('../../class/Student.php');
$student = new Student();
switch($requestMethod) {	
	case 'POST':
		$id_student = $_POST['id'];
		$name = $_POST['name'];
		$address = $_POST['address'];
		$email = $_POST['email'];

	    $student->setName($name);
	    $student->setAddress($address);
	    $student->setEmail($email);
		$student->setId($id_student);

		$studentInfo = $student->update();
		if(!empty($studentInfo)) {
	      $js_encode = json_encode(array('status'=>TRUE, 'message'=>'Student updated Successfully'), true);
        } else {
            $js_encode = json_encode(array('status'=>FALSE, 'message'=>'Student updation failed.'), true);
        }
		header('Content-Type: application/json');
		echo $js_encode;
	break;
	default:
	header("HTTP/1.0 405 Method Not Allowed");
	break;
}
?>	