<?php
$requestMethod = $_SERVER["REQUEST_METHOD"];
include('../../class/Telephone.php');
$telephone = new telephone();
switch($requestMethod) {
	case 'GET':

		if($_GET['id']) {
			$telephoneID = $_GET['id'];
			$telephone->setId($telephoneID);
			$telephoneInfo = $telephone->getOne();
		} else {
			$telephoneInfo = $telephone->getAll();
		}
		if(!empty($telephoneInfo)) {
	      $js_encode = json_encode(array('status'=>TRUE, 'telephoneInfo'=>$telephoneInfo), true);
        } else {
            $js_encode = json_encode(array('status'=>FALSE, 'message'=>'There is no record yet.'), true);
        }
		header('Content-Type: application/json');
		echo $js_encode;
		break;
	default:
	header("HTTP/1.0 405 Method Not Allowed");
	break;
}
?>	