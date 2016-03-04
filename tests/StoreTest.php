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

       function testUpdate()
      {
          //Arrange
          $store_name = "REI";
          $location = "Seattle, WA";
          $test_store = new Store($store_name, $location);
          $test_store->save();

          $new_store_name = "Imeldas";
          $new_location = "Portland, OR";
          //Act
          $test_store->update($new_store_name, $new_location);
          //Assert
          $this->assertEquals(["Imeldas", "Portland, OR"], [$test_store->getStoreName(), $test_store->getLocation()]);
      }

      function testUpdate()
      {
          //Arrange
          $description = "Wash the dog";
          $id = 1;
          $due_date = "2016-03-01";
          $completion = 0;
          $test_task = new Task($description, $due_date, $completion, $id);
          $test_task->save();
          $new_description = "Clean the dog";
          $new_due_date = "2016-03-05";
          $new_completion = 1;
          //Act
          $test_task->update($new_description, $new_due_date, $new_completion);
          //Assert
          $this->assertEquals(["Clean the dog", "2016-03-05", 1], [$test_task->getDescription(), $test_task->getDueDate(), $test_task->getCompletion()]);
      }


    }
?>
