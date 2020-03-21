<?php
$requestMethod = $_SERVER["REQUEST_METHOD"];
include('../../class/Student.php');
$student = new Student();
switch($requestMethod) {
	case 'POST':
		$name = $_POST['name'];
		$address = $_POST['address'];
		$email = $_POST['email'];

	    $student->setName($name);
	    $student->setAddress($address);
	    $student->setEmail($email);
		$studentInfo = $student->create();

		if(!empty($studentInfo)) {
	      $js_encode = json_encode(array('status'=>TRUE, 'message'=>'Student created Successfully', 'id'=>$studentInfo), true);
        } else {
            $js_encode = json_encode(array('status'=>FALSE, 'message'=>'Student creation failed.'), true);
        }
		header('Content-Type: application/json');
		echo $js_encode;	
		break;
	default:
	header("HTTP/1.0 405 Method Not Allowed");
	break;
}
?>	