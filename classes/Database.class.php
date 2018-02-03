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
            if ($_SERVER['HTTP_HOST'] == "localhost") {
                require_once($_SERVER['DOCUMENT_ROOT']."/SideProjects/SocialMedia/includes/config.php");
            } else {
                require_once($_SERVER['DOCUMENT_ROOT']."/includes/config.php");
            }
        } catch (PDOException $e) {
            echo json_encode([
              "error" => [
              "message" => $e->getMessage()
            ]
          ]);
            exit();
        }
    }
}
