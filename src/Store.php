<?php
    class Store
    {
        private $store_name;
        private $location;
        private $id;

        function __construct($store_name, $location, $id = null)
        {
            $this->store_name = $store_name;
            $this->location = $location;
            $this->id = $id;
        }

        function setStoreName($new_store_name)
        {
            $this->store_name = $new_store_name;
        }

        function getStoreName()
        {
            return $this->store_name;
        }

        function setLocation($new_location)
        {
            $this->location = $new_location;
        }

        function getLocation()
        {
            return $this->location;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
              $GLOBALS['DB']->exec("INSERT INTO stores (store_name, location) VALUES ('{$this->getStoreName()}', '{$this->getLocation()}');");
              $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
       {
           $returned_stores = $GLOBALS['DB']->query("SELECT * FROM stores;");
           $stores = array();
           foreach($returned_stores as $store) {
               $store_name = $store['store_name'];
               $location = $store['location'];
               $id = $store['id'];
               $new_store = new Store($store_name, $location, $id);
               array_push($stores, $new_store);
           }
           return $stores;
       }

       static function deleteAll()
       {
         $GLOBALS['DB']->exec("DELETE FROM stores;");
       }

       static function find($search_id)
       {
           $found_store = null;
           $stores = Store::getAll();
           foreach($stores as $store) {
               $store_id = $store->getId();
               if ($store_id == $search_id) {
                 $found_store = $store;
               }
           }
           return $found_store;
       }

    }
?>
