<?php
$requestMethod = $_SERVER["REQUEST_METHOD"];
include('../../class/Expedient.php');
$expedient = new Expedient();
switch($requestMethod) {
	case 'GET':

		if($_GET['id']) {
			$expedientID = $_GET['id'];
			$expedient->setId($expedientID);
		}
		$expedientInfo = $expedient->delete();

		if(!empty($expedientInfo)) {
	      $js_encode = json_encode(array('status'=>TRUE, 'message'=>'expedient deleted Successfully.'), true);
        } else {
            $js_encode = json_encode(array('status'=>FALSE, 'message'=>'expedient delete failed.'), true);
        }
		header('Content-Type: application/json');
		echo $js_encode;
		break;
	default:
	header("HTTP/1.0 405 Method Not Allowed");
	break;
}
?>	