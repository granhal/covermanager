<?php
$requestMethod = $_SERVER["REQUEST_METHOD"];
include('../../class/Subject.php');
$subject = new Subject();
switch($requestMethod) {	
	case 'POST':
		$subjectID = $_POST['id'];
		$note = $_POST['note'];
		$name = $_POST['name'];
		$id_expedient = $_POST['id_expedient'];

	    $subject->setName($name);
	    $subject->setNote($note);
	    $subject->setIdExpedient($id_expedient);
		$subject->setId($subjectID);

		$subjectInfo = $subject->update();
		if(!empty($subjectInfo)) {
	      $js_encode = json_encode(array('status'=>TRUE, 'message'=>'subject updated Successfully'), true);
        } else {
            $js_encode = json_encode(array('status'=>FALSE, 'message'=>'subject updation failed.'), true);
        }
		header('Content-Type: application/json');
		echo $js_encode;
	break;
	default:
	header("HTTP/1.0 405 Method Not Allowed");
	break;
}
?>	