<?php
$requestMethod = $_SERVER["REQUEST_METHOD"];
include('../../class/Telephone.php');
$telephone = new telephone();
switch($requestMethod) {
	case 'GET':

		if($_GET['id']) {
			$number = $_GET['id'];
			$telephone->setNumber($number);
		}
		$telephoneInfo = $telephone->delete();
		if(!empty($telephoneInfo)) {
	      $js_encode = json_encode(array('status'=>TRUE, 'message'=>'telephone deleted Successfully.'), true);
        } else {
            $js_encode = json_encode(array('status'=>FALSE, 'message'=>'telephone delete failed.'), true);
        }
		header('Content-Type: application/json');
		echo $js_encode;
		break;
	default:
	header("HTTP/1.0 405 Method Not Allowed");
	break;
}
?>	