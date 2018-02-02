<?php 

$response = array();

if(!empty($_POST)) {
	include('../includes/dbconnect.php');

	$query = $handler->query("SELECT * FROM users WHERE EMAIL = '" . $_POST['email'] . "'");
	if($query->rowCount() > 0) {
		$response = array("success" => false, "message" => "Email exists");
	} else {
		$query = $handler->query("SELECT * FROM users WHERE USERNAME = '" . $_POST['username'] . "'");
		if($query->rowCount() > 0) {
			$response = array("success" => false, "message" => "Username taken");
		} else {
			$query = $handler->query("INSERT INTO users (NAME, USERNAME, EMAIL, PASSWORD) VALUES ('" . $_POST['name'] . "', '" . $_POST['username'] . "', '" . $_POST['email'] . "', '" . $_POST['password'] . "')");
			if($query->rowCount() > 0) {
				$response = array("success" => true);
			}
		}
	}

} else {
	$response = array("success" => false, "message" => 'Blank');
}


echo json_encode($response);
?>