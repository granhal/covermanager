<?php
$requestMethod = $_SERVER["REQUEST_METHOD"];
include('../../class/Telephone.php');
$telephone = new telephone();
switch($requestMethod) {	
	case 'POST':
		$telephoneID = $_POST['id'];
		$number = $_POST['number'];
		$id_student = $_POST['id_student'];

	    $telephone->setNumber($number);
	    $telephone->setIdStudent($id_student);
		$telephone->setId($telephoneID);

		$telephoneInfo = $telephone->update();
		if(!empty($telephoneInfo)) {
	      $js_encode = json_encode(array('status'=>TRUE, 'message'=>'telephone updated Successfully'), true);
        } else {
            $js_encode = json_encode(array('status'=>FALSE, 'message'=>'telephone updation failed.'), true);
        }
		header('Content-Type: application/json');
		echo $js_encode;
	break;
	default:
	header("HTTP/1.0 405 Method Not Allowed");
	break;
}
?>	