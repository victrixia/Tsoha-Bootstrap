<?php

function check_logged_in(){
    BaseController::check_logged_in();
}


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

$routes->get('/viini/new', 'check_logged_in', function () {

    ViiniController::create();
});

$routes->get('/viini/:id', function ($id) {
    ViiniController::show($id);

});

$routes->post('/viini/:id/destroy', 'check_logged_in', function($id){
   ViiniController::destroy($id);
});

$routes->post('/rypale', 'check_logged_in', function(){
   RypaleController::store();

});

$routes->get('/rypale', function(){
   RypaleController::index();

});

$routes->get('/rypale/new', 'check_logged_in', function () {

    RypaleController::create();
});

$routes->get('/rypale/:id', function ($id) {
    RypaleController::show($id);

});

$routes->get('/rypale/:id/edit', 'check_logged_in', function($id){

   RypaleController::edit($id);
});

$routes->post('/rypale/:id/edit', function($id){

    RypaleController::update($id);
});

$routes->post('/rypale/:id/destroy', 'check_logged_in', function($id){

    RypaleController::destroy($id);
});

$routes->post('/viini/:viini_id/:rypale_id/destroy', 'check_logged_in', function($viini_id, $rypale_id){

    ViininRypaleetController::destroy($viini_id, $rypale_id);
});

$routes->get('/viini/:id/rypaleet', function($id){

    ViiniController::edit_grapes($id);
});

$routes->post('/viini/rypaleet', 'check_logged_in', function(){

    ViininRypaleetController::store();
});

$routes->get('/viini/:id/edit', 'check_logged_in', function ($id) {
    ViiniController::edit($id);
});

$routes->post('/viini/:id/edit', 'check_logged_in', function ($id) {
    ViiniController::update($id);
});

$routes->get('/kotimaa/new', 'check_logged_in', function(){
   KotimaaController::create();
});

$routes->post('/kotimaa', function(){
    KotimaaController::store();

});

$routes->get('/kotimaa', function(){

    KotimaaController::index();
});

$routes->get('/login', function () {
    UserController::login();


});

$routes->post('/login', function(){
    UserController::handle_login();
});

$routes -> post('/logout', function(){
    UserController::logout();
});

