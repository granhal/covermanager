<?php
$requestMethod = $_SERVER["REQUEST_METHOD"];
include('../../class/Expedient.php');
$expedient = new Expedient();
switch($requestMethod) {
	case 'POST':
		$number = $_POST['number'];
		$id_student = $_POST['id_student'];

	    $expedient->setExpedientNumber($number);
		$expedient->setIdStudent($id_student);
		
		$expedientInfo = $expedient->create();
		if(!empty($expedientInfo)) {
	      $js_encode = json_encode(array('status'=>TRUE, 'message'=>'created Successfully'), true);
        } else {
            $js_encode = json_encode(array('status'=>FALSE, 'message'=>'creation failed.'), true);
        }
		header('Content-Type: application/json');
		echo $js_encode;	
		break;
	default:
	header("HTTP/1.0 405 Method Not Allowed");
	break;
}
?>	