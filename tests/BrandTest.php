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
    class BrandTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
          Brand::deleteAll();
          Store::deleteAll();
        }

        function testSave()
        {
            //Arrange
            $name = "Vans";
            $test_brand = new Brand($name);
            $test_brand->save();
            //Act
            $result = Brand::getAll();
            //Assert
            $this->assertEquals($test_brand, $result[0]);
        }

        function testGetAll()
        {
            //Arrange
            $name = "Vans";
            $test_brand = new Brand($name);
            $test_brand->save();

            $name2 = "Chacos";
            $test_brand2 = new Brand($name2);
            $test_brand2->save();
            //Act
            $result = Brand::getAll();
            //Assert
            $this->assertEquals([$test_brand, $test_brand2], $result);
        }

        function testDeleteAll()
        {
            //Arrange
            $name = "Vans";
            $test_brand = new Brand($name);
            $test_brand->save();

            $name2 = "Chacos";
            $test_brand2 = new Brand($name2);
            $test_brand2->save();
            //Act
            Brand::deleteAll();
            //Assert
            $result = Brand::getAll();
            $this->assertEquals([], $result);
        }

        function testFind()
        {
            //Arrange
            $name = "Vans";
            $test_brand = new Brand($name);
            $test_brand->save();

            $name2 = "Chacos";
            $test_brand2 = new Brand($name2);
            $test_brand2->save();
            //Act
            $result = Brand::find($test_brand->getId());
            //Assert
            $this->assertEquals($test_brand, $result);
        }

        function test_getStores()
        {
            //Arrange
            $name = "Vans";
            $test_brand = new Brand($name);
            $test_brand->save();

            $store_name = "REI";
            $location = "Seattle, WA";
            $test_store = new Store($store_name, $location);
            $test_store->save();

            $store_name2 = "Payless";
            $location2 = "Olympia, WA";
            $test_store2 = new Store($store_name2, $location2);
            $test_store2->save();

            //Act
            $test_brand->addStore($test_store->getId());
            $test_brand->addStore($test_store2->getId());
            $result = $test_brand->getStores();
            //Assert
            $this->assertEquals([$test_store, $test_store2], $result);
        }

        function test_addStore()
        {
            //Arrange
            $name = "Vans";
            $test_brand = new Brand($name);
            $test_brand->save();

            $store_name = "REI";
            $location = "Seattle, WA";
            $test_store = new Store($store_name, $location);
            $test_store->save();
            //Act
            $test_brand->addStore($test_store->getId());
            //Assert
            $this->assertEquals($test_brand->getStores(), [$test_store]);
        }

    }
?>
