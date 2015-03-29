<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/etusivu', function() {
  	HelloWorldController::etusivu();
  });

  $routes->get('/viinit', function() {
    ViiniController::index();
  });

//  $routes->get('/viinit/1', function(){
//    HelloWorldController::wine_show();
//  });

$routes->get('/viini/:id', function($id){
    ViiniController::show($id);

});
  $routes->get('/viinit/1/edit', function(){
      HelloWorldController::wine_edit();
    });

  $routes->get('login', function(){
    HelloWorldController::login();
  });

