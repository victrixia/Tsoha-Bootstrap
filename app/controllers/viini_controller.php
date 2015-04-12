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

        $viini = viini::find($id);
        View::make('viini/show.html', array('viini' => $viini));
//        Kint::dump($viini);
    }

    public static function store()
    {
        $params = $_POST;

        $viini = new Viini(array(
            'nimi' => $params['nimi'],
            'viinityyppi_id' => (int)$params['tyyppi'],
            'makeus' => (is_numeric($params['makeus']) ? (int)($params['makeus']) : 0),
            'happo' => (is_numeric($params['happo']) ? (real)($params['happo']) : 0),
            'vuosikerta' => (int)$params['vuosikerta'],
            'alkoholi' =>(is_numeric($params['alkoholi']) ? (real)($params['alkoholi']) : 0),
            'kotimaa_id' =>(int)$params['kotimaa_id'],
            'uutos' => (is_numeric($params['uutos']) ? (real)($params['uutos']) : 0)
        ));

//        Kint::dump($params);
//        Kint::trace();

        $viini->save();

//        Redirect::to('/viini/' . $viini->id, array('message' => 'viini lisätty onnistuneesti!'));

    }

    public static function create()
    {

        View::make('viini/new.html');
    }

}