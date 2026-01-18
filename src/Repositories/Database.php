<?php

namespace App\Repositories;

use PDO;
use PDOException;

class Database {
    private static $instance = null;
    private $host = 'localhost';
    private $dbname = 'library';
    private $user = 'root';
    private $pass = '***********';

    private function __construct() {}

    public static function getInstance() 
    {
        if (!self::$instance) 
        {
            $db = new self();
            self::$instance = $db->connect();
        }
        return self::$instance;
    }

    private function connect() {
        try {
            $pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname;charset=utf8", $this->user, $this->pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
}