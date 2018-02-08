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

  $creation = $account->Create($_POST);

  if($creation["success"]) {
    $response = array("success" => true);
  } else {
    $response = $creation;
  }

} else {
    $response = array("success" => false, "message" => 'Blank');
}

echo json_encode($response);
?>
