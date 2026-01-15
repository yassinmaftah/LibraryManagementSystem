<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Repositories\Database;
try 
{
    $db = Database::getInstance();    
    if ($db) 
    {
        echo "Connected Done<br>";
        var_dump($db); 
    }
} catch (Exception $e) {echo "Not Connected: " . $e->getMessage();}