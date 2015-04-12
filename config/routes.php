<?php


$routes->get('/', function () {
    HelloWorldController::index();
});

$routes->get('/hiekkalaatikko', function () {
    HelloWorldController::sandbox();
});

$routes->get('/etusivu', function () {
    HelloWorldController::etusivu();
});

$routes->get('/viini', function () {
    ViiniController::index();
});

//  $routes->get('/viinit/1', function(){
//    HelloWorldController::wine_show();
//  });

$routes->post('/viini', function () {
    ViiniController::store();
});

$routes->get('/viini/new', function () {

    ViiniController::create();
});

$routes->get('/viini/:id', function ($id) {
    ViiniController::show($id);

});

$routes->post('/rypale', function(){
   RypaleController::store();

});

$routes->get('/rypale', function(){
   RypaleController::index();

});

$routes->get('/rypale/new', function () {

    RypaleController::create();
});

$routes->get('/rypale/:id', function ($id) {
    RypaleController::show($id);

});

$routes->get('/rypale/:id/edit', function($id){

   RypaleController::edit($id);
});

$routes->post('/rypale/:id/edit', function($id){

    RypaleController::update($id);
});

$routes->post('/rypale/:id/destroy', function($id){

    RypaleController::destroy($id);
});

$routes->get('/viini/1/edit', function () {
    HelloWorldController::wine_edit();
});


$routes->get('/login', function () {
    UserController::login();


});

$routes->post('/login', function(){
    UserController::handle_login();
});

