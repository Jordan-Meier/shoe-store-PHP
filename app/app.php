<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Store.php";
    require_once __DIR__."/../src/Brand.php";

    $app = new Silex\Application();
    // $app['debug'] = true;

    $server = 'mysql:host=localhost;dbname=shoes';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig');
    });

    $app->get("/stores", function() use ($app) {
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
    });

    $app->get("/brands", function() use ($app) {
        return $app['twig']->render('brands.html.twig', array('brands' => Brand::getAll()));
    });


    ////////////////////////
    ///////STORES//////////
    ///////////////////////


    //CREATE store
    $app->post("/stores", function() use ($app) {
        $store_name = $_POST['store_name'];
        $location = $_POST['location'];
        $store = new Store($store_name, $location);
        $store->save();
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
    });

    //Deletes all stores and returns homepage
    $app->post("/delete_stores", function() use ($app) {
        Store::deleteAll();
        return $app['twig']->render('index.html.twig');
    });

    //Gets page for an individual store with it's brands and the ability to add brands to the store
    $app->get("/stores/{id}", function($id) use ($app) {
        $store = Store::find($id);
        return $app['twig']->render('store.html.twig', array('store' => $store, 'brands' =>
            $store->getBrands(), 'all_brands' => Brand::getAll()));
    });

    //gets the page to edit a store name and location
    $app->get("/store/{id}/edit", function($id) use ($app) {
        $store = Store::find($id);
        return $app['twig']->render('store_edit.html.twig', array('store' => $store));
    });

    //PATCH routes
    $app->patch("/store/{id}", function($id) use ($app) {
        $store_name = $_POST['store_name'];
        $location = $_POST['location'];
        $store = Store::find($id);
        $store->update($store_name, $location);
        return $app['twig']->render('store.html.twig', array('store' => $store, 'brands' => $store->getBrands(), 'all_brands' => Brand::getAll()));
    });

    //add stores to brands
    $app->post("/add_stores", function() use ($app) {
        $store = Store::find($_POST['store_id']);
        $brand = Brand::find($_POST['brand_id']);
        $brand->addStore($store);
        return $app['twig']->render('brand.html.twig', array('brand' => $brand, 'brands' =>
        Brand::getAll(), 'stores' => $brand->getStores(), 'all_stores' => Store::getAll()));
    });

    //DELETE singular store
    $app->delete("/stores/{id}", function($id) use ($app) {
        $store = Store::find($id);
        $store->delete();
        return $app['twig']->render('index.html.twig', array('stores' => Store::getAll()));
    });


    ////////////////////////
    ///////BRANDS//////////
    ///////////////////////

    //CREATE brand
    $app->post("/brands", function() use ($app) {
        $name = $_POST['name'];
        $brand = new Brand($name);
        $brand->save();
        return $app['twig']->render('brands.html.twig', array('brands' => Brand::getAll()));
    });

    //Gets page for an individual brand
    $app->get("/brands/{id}", function($id) use ($app) {
        $brand = Brand::find($id);
        return $app['twig']->render('brand.html.twig', array('brand' => $brand, 'stores' =>
            $brand->getStores(), 'all_stores' => Store::getAll()));
    });

    //CREATE add brands to stores
    $app->post("/add_brands", function() use ($app) {
        $store = Store::find($_POST['store_id']);
        $brand = Brand::find($_POST['brand_id']);
        $store->addBrand($brand);
        return $app['twig']->render('store.html.twig', array('store' => $store, 'stores' =>
            Store::getAll(), 'brands' => $store->getBrands(), 'all_brands' => Brand::getAll()));
    });

    return $app;
?>
