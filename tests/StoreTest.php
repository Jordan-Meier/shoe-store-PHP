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
            $test_store2->save();
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
            $test_store2->save();
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
            $test_store2->save();
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
            $this->assertEquals(["Imeldas", "Portland, OR"], [$test_store->getStoreName(),   $test_store->getLocation()]);
        }

        function testDelete()
        {
            //Arrange
            $store_name = "REI";
            $location = "Seattle, WA";
            $test_store = new Store($store_name, $location);
            $test_store->save();

            $name = "Chacos";
            $test_brand = new Brand($name);
            $test_brand->save();

            //Act
            $test_store->addBrand($test_brand);
            $test_store->delete();
            //Assert
            $this->assertEquals([], $test_brand->getStores());
        }

        function test_getBrands()
        {
            //Arrange
            $store_name = "REI";
            $location = "Seattle, WA";
            $test_store = new Store($store_name, $location);
            $test_store->save();

            $name = "Vans";
            $test_brand = new Brand($name);
            $test_brand->save();

            $name2 = "Chacos";
            $test_brand2 = new Brand($name2);
            $test_brand2->save();
            //Act
            $test_store->addBrand($test_brand);
            $test_store->addBrand($test_brand2);
            //Assert
            $this->assertEquals($test_store->getBrands(), [$test_brand, $test_brand2]);
        }
        function test_addBrand()
        {
            //Arrange
            $store_name = "REI";
            $location = "Seattle, WA";
            $test_store = new Store($store_name, $location);
            $test_store->save();

            $name = "Chacos";
            $test_brand = new Brand($name);
            $test_brand->save();
            //Act
            $test_store->addBrand($test_brand);
            //Assert
            $this->assertEquals($test_store->getBrands(), [$test_brand]);
        }

    }
?>
