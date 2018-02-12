 <?php
session_start();

$response = array();

if (!empty($_POST)) {
  if ($_SERVER['HTTP_HOST'] == "localhost" || $_SERVER['HTTP_HOST'] == "localhost:8080") {
    require_once($_SERVER['DOCUMENT_ROOT']."/SideProjects/SocialMedia/classes/Account.class.php");
  } else {
    require_once($_SERVER['DOCUMENT_ROOT']."/classes/Account.class.php");
  }

  $account = new \JRocaberte\Account();

  $loginCheck = $account->Login($_POST);

  if($loginCheck["success"]) {
    $_SESSION["userData"] = $loginCheck;
    $_SESSION["KEEP_SIGNED_IN"] = $loginCheck["keep_signed_in"];
    $_SESSION["timeOfLogin"] = time();
    $response = array("success" => true, "sesh" => $_SESSION);
  } else {
    $response = $loginCheck;
  }

} else {
    $response = array("success" => false, "message" => 'Blank');
}

echo json_encode($response);
?>
