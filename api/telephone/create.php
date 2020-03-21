<?php
$requestMethod = $_SERVER["REQUEST_METHOD"];
include('../../class/Telephone.php');
$telephone = new telephone();
switch($requestMethod) {
	case 'POST':

		$number = $_POST['number'];
		$id_student = $_POST['id_student'];

	    $telephone->setNumber($number);
	    $telephone->setIdStudent($id_student);
		$telephoneInfo = $telephone->create();

		if(!empty($telephoneInfo)) {
	      $js_encode = json_encode(array('status'=>TRUE, 'message'=>'telephone created Successfully'), true);
        } else {
            $js_encode = json_encode(array('status'=>FALSE, 'message'=>'telephone creation failed.'), true);
        }
		header('Content-Type: application/json');
		echo $js_encode;	
		break;
	default:
	header("HTTP/1.0 405 Method Not Allowed");
	break;
}
?>	