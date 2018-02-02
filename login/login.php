 <?php

$response = array();

if(!empty($_POST)) {
	include('../includes/dbconnect.php');

	$query = $handler->query("SELECT * FROM users WHERE EMAIL = '" . $_POST['email'] . "'");

	if($query->rowCount() > 0) {
		$r = $query->fetch(PDO::FETCH_ASSOC);
		if($_POST['password'] == $r['PASSWORD']) {
			$response = array("success" => true);
      $query = $handler->prepare("UPDATE users SET LASTLOGGEDIN = ? WHERE EMAIL = '" . $_POST['email'] . "'");
      $query->execute(array(date("Y-m-d H:i:s")));
		} else {
			$response = array("success" => false, "message" => "Incorrect email or password");
		}
	} else {
		$response = array("success" => false, "message" => "Email not on file");
	}
} else {
	$response = array("success" => false, "message" => 'Blank');
}

echo json_encode($response);
?>
