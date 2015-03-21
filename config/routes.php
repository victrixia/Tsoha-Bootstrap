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
    HelloWorldController::viinit();
  });

  $routes->get('/viinit/1', function(){
    HelloWorldController::wine_show();
  });

  $routes->get('/viinit/1/edit', function(){
      HelloWorldController::wine_edit();
    });

  $routes->get('login', function(){
    HelloWorldController::login();
  });
