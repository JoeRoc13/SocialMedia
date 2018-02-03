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
        try {
            if ($_SERVER['HTTP_HOST'] == "localhost") {
                require_once($_SERVER['DOCUMENT_ROOT']."/SideProjects/SocialMedia/classes/Database.class.php");
            } else {
                require_once($_SERVER['DOCUMENT_ROOT']."/classes/Database.class.php");
            }
        } catch (Exception $e) {
        }
    }
}
