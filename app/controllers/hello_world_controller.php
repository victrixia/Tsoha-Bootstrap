<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('home.html');

    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      View::make('helloworld.html');
    }

    public static function etusivu(){

      View::make('suunnitelmat/etusivu.html');
    }

    public static function viinit(){
      View::make('suunnitelmat/kaikkiviinit.html');
    }

    public static function viini_show(){
      View::make('suunnitelmat/show_wine.html');
    }
  }
