<?php
$requestMethod = $_SERVER["REQUEST_METHOD"];
include('../../class/Subject.php');
$subject = new Subject();
switch($requestMethod) {
	case 'GET':

		if($_GET['id']) {
			$subjectID = $_GET['id'];
			$subject->setId($subjectID);
			$subjectInfo = $subject->getOne();
		} else {
			$subjectInfo = $subject->getAll();
		}
		if(!empty($subjectInfo)) {
	      $js_encode = json_encode(array('status'=>TRUE, 'subjectInfo'=>$subjectInfo), true);
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