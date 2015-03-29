<?php
require 'app/models/viini.php';

class ViiniController extends BaseController
{

    public static function index()
    {

        $viinit = viini::all();
        View::make('viini/index.html', array('viinit' => $viinit));
    }

    public static function show($id)
    {

        $tama_viini = viini::find($id);
        View::make('viini/show.html', array('viini' => $tama_viini));
//        Kint::dump($tama_viini);
    }

}