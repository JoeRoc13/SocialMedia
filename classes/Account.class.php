<?php

/**
 *
 */

namespace JRocaberte;

use PDO;
use PDOException;
use Exception;

class Account
{
  private $_db;

  public function __construct()
  {
    try
    {
      if ($_SERVER['HTTP_HOST'] == "localhost" || $_SERVER['HTTP_HOST'] == "localhost:8080")
      {
        require_once($_SERVER['DOCUMENT_ROOT']."/SideProjects/SocialMedia/classes/Database.class.php");
        require_once($_SERVER['DOCUMENT_ROOT']."/SideProjects/SocialMedia/includes/helpers.php");
      }
      else
      {
        require_once($_SERVER['DOCUMENT_ROOT']."/classes/Database.class.php");
        require_once($_SERVER['DOCUMENT_ROOT']."/includes/helpers.php");
      }

      $this->_db = new \JRocaberte\Database();
    }
    catch (PDOException $e)
    {
      echo json_encode([
        "error" => [
          "message" => $e->getMessage()
        ]
      ]);
    }
    catch (Exception $e)
    {
      echo json_encode([
        "error" => [
          "message" => $e->getMessage()
        ]
      ]);
    }
  }

  public function Create($params = array())
  {
    try
    {
      $result = [];
      $name = $params["name"];
      $username = $params["username"];
      $email = $params["email"];
      $password = $params["password"];
      $userIP = get_real_ip();

      $sql = $this->_db->QueryWithBinds("SELECT * FROM users WHERE EMAIL = ?", array($email));
      if($sql->rowCount() > 0) {
        $result = array("success" => false, "message" => "Email exists");
      } else {
        $sql = $this->_db->QueryWithBinds("SELECT * FROM users WHERE USERNAME = ?", array($username));
        if($sql->rowCount() > 0) {
          $result = array("success" => false, "message" => "Username taken");
        } else {
          $hashed = password_hash($_POST['password'], PASSWORD_DEFAULT);
    			$sql = $this->_db->QueryWithBinds("INSERT INTO users (NAME, USERNAME, EMAIL, PASSWORD, IP) VALUES (?, ?, ?, ?, ?)", array($name, $username, $email, $hashed, $userIP));
          if($sql->rowCount() > 0) {
    				$result = array("success" => true);
    			}
        }
      }

      return $result;
    }
    catch (PDOException $e)
    {
      echo json_encode([
        "error" => [
          "message" => $e->getMessage()
        ]
      ]);
    }
    catch (Exception $e)
    {
      echo json_encode([
        "error" => [
          "message" => $e->getMessage()
        ]
      ]);
    }
  }

  public function Login($params = array())
  {
    try
    {
      $result = [];
      $email = $params["login_email"];
      $password = $params["login_password"];
      $userIP = get_real_ip();
      if(isset($params["keep_signed_in"])) {
        $keep_logged_in = $params["keep_signed_in"];
      }

      $sql = $this->_db->QueryWithBinds("SELECT * FROM users WHERE EMAIL = ?", array($email));
      if($sql->rowCount() > 0) {
        $getData = $sql->fetch(PDO::FETCH_ASSOC);
        $hashedPassword = password_verify($password, $getData["PASSWORD"]);
        if($hashedPassword) {
          $parsedName = split_name($getData["NAME"]);
          $sql = $this->_db->QueryWithBinds("UPDATE users SET LASTLOGGEDIN = ? WHERE EMAIL = ?", array(date("Y-m-d H:i:s"), $email));
          if(isset($keep_logged_in)) {
            $sql = $this->_db->QueryWithBinds("UPDATE users SET KEEP_SIGNED_IN = ?", array(1));
          } else {
            $sql = $this->_db->QueryWithBinds("UPDATE users SET KEEP_SIGNED_IN = ?", array(0));
          }
          $sql = $this->_db->QueryWithBinds("INSERT INTO history (USERID, DATE, IP) VALUES (?, ?, ?)", array($getData["ID"], date("Y-m-d H:i:s"), $userIP));
          $result = array(
            "success" => true,
            "id" => $getData["ID"],
            "fullname" => $getData["NAME"],
            "first_name" => $parsedName["first_name"],
            "middle_name" => $parsedName["middle_name"],
            "last_name" => $parsedName["last_name"],
            "username" => $getData["USERNAME"],
            "keep_signed_in" => $getData["KEEP_SIGNED_IN"]
        );
        } else {
          $result = array("success" => false, "message" => "Incorrect email or password");
        }
      } else {
        $result = array("success" => false, "message" => "Incorrect email or password");
      }

      return $result;
    }
    catch (PDOException $e)
    {
      echo json_encode([
        "error" => [
          "message" => $e->getMessage()
        ]
      ]);
    }
    catch (Exception $e)
    {
      echo json_encode([
        "error" => [
          "message" => $e->getMessage()
        ]
      ]);
    }
  }
}
