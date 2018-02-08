<?php

/**
 *
 */

namespace JRocaberte;

use PDO;
use PDOException;
use Exception;

class Database
{
  private $_db;

  public function __construct()
  {
    try {
      if ($_SERVER['HTTP_HOST'] == "localhost" || $_SERVER['HTTP_HOST'] == "localhost:8080")
      {
        require_once($_SERVER['DOCUMENT_ROOT']."/SideProjects/SocialMedia/includes/config.php");
      } else
      {
        require_once($_SERVER['DOCUMENT_ROOT']."/includes/config.php");
      }

      $this->_db = new \PDO("mysql:host=".$dbConfig["host"].";dbname=".$dbConfig["database"], $dbConfig["user"], $dbConfig["password"]);

      $this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    } catch (PDOException $e) {
      echo json_encode([
        "error" => [
          "message" => $e->getMessage()
        ]
      ]);
      exit();
    } catch (Exception $e) {
      echo json_encode([
        "error" => [
          "message" => $e->getMessage()
        ]
      ]);
      exit();
    }
  }

  /**
 * Send a query to the database without any paramters / binds
 * @param string $query The query statement to execute
 */
function QueryWithOutBinds($query = "")
{
  try
  {
    $query = $this->_db->prepare($query);
    if($query->execute())
    {
      return $query;
    }
    else
    {
      return array("success" => false, "message" => "Failed to execute query. Admin has been notified.");
    }
    $query = null;
  }
  catch(PDOException $ex)
  {
    echo json_encode(array(
      "error" => array(
        "message" => $ex->getMessage()
      )
    ));
    exit();
  }
  catch(Exception $ex)
  {
    echo json_encode(array(
      "error" => array(
        "message" => $ex->getMessage()
      )
    ));
    exit();
  }

}

function QueryWithBinds($query = "", $bind = array())
  {
    try
    {
      $query = $this->_db->prepare($query);
      $cleanedBind = $this->CleanBind($bind);
      if($query->execute($cleanedBind))
      {
        return $query;
      }
      else
      {
        return array("success" => false, "message" => "Failed to execute query. Admin has been notified.");
      }
      $query = null;
    }
    catch(PDOException $ex)
    {
      echo json_encode(array(
        "error" => array(
          "message" => $ex->getMessage()
        )
      ));
      exit();
    }
    catch(Exception $ex)
    {
      echo json_encode(array(
        "error" => array(
          "message" => $ex->getMessage()
        )
      ));
      exit();
    }

  }

  function CleanBind($bind = array())
  {
    try
    {
      $cleanedBind = array();
      foreach($bind as $value)
      {
        if(is_array($value))
        {
          $cleanedBind = array_merge($cleanedBind, $this->CleanBind($value));
        }
        else
        {
          $clean = is_string($value) ? trim($value) : $value;
          $clean = htmlentities(strip_tags($clean), ENT_QUOTES);
          array_push($cleanedBind, $clean);
        }

      }

      return $cleanedBind;

    }
    catch(PDOException $ex)
    {
      echo json_encode(array(
        "error" => array(
          "message" => $ex->getMessage()
        )
      ));
      exit();
    }
    catch(Exception $ex)
    {
      echo json_encode(array(
        "error" => array(
          "message" => $ex->getMessage()
        )
      ));
      exit();
    }

  }

  function __destruct()
  {
      $this->_db = null;
  }
}
