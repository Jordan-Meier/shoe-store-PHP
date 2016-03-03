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

        function testSave()
        {
            //Arrange
            $store_name = "REI";
            $location = "Seattle, WA";
            $test_store = new Store($store_name, $location);
            $test_store->save();
            //Act
            $result = Store::getAll();
            //Assert
            $this->assertEquals($test_store, $result[0]);
        }

        function testGetAll()
        {
            //Arrange
            $store_name = "REI";
            $location = "Seattle, WA";
            $test_store = new Store($store_name, $location);
            $test_store->save();

            $store_name2 = "Payless";
            $location2 = "Olympia, WA";
            $test_store2 = new Store($store_name2, $location2);
            $test_store->save();
            //Act
            $result = Store::getAll();
            //Assert
            $this->assertEquals([$test_store, $test_store2], $result);
        }

        function testDeleteAll()
        {
            //Arrange
            $store_name = "REI";
            $location = "Seattle, WA";
            $test_store = new Store($store_name, $location);
            $test_store->save();

            $store_name2 = "Payless";
            $location2 = "Olympia, WA";
            $test_store2 = new Store($store_name2, $location2);
            $test_store->save();
            //Act
            Store::deleteAll();
            //Assert
            $result = Store::getAll();
            $this->assertEquals([], $result);
        }

        function testFind()
       {
           //Arrange
           $store_name = "REI";
           $location = "Seattle, WA";
           $test_store = new Store($store_name, $location);
           $test_store->save();

           $store_name2 = "Payless";
           $location2 = "Olympia, WA";
           $test_store2 = new Store($store_name2, $location2);
           $test_store->save();
           //Act
           $result = Store::find($test_store->getId());
           //Assert
           $this->assertEquals($test_store, $result);
       }


    }
?>
