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

  $routes->get('viinit', fuction(){
    HelloWorldController::viinit();
  }

  $routes->get('/viinit/1', function(){
    HelloWorldController::viini_show();
  });
