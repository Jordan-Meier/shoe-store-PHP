<?php

/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/
    require_once "src/Brand.php";
    require_once "src/Store.php";
    $server = 'mysql:host=localhost;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);
    class StoreTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
          Brand::deleteAll();
          Store::deleteAll();
        }

    }
?>
