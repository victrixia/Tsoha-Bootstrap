<?php
require 'app/models/rypale.php';

class RypaleController extends BaseController
{


    public static function index()
    {

        $rypaleet = rypale::all();
        View::make('rypale/index.html', array('rypaleet' => $rypaleet));
    }

    public static function show($id)
    {

        $rypale = rypale::find($id);
        View::make('rypale/show.html', array('rypale' => $rypale));
//        Kint::dump($rypale);
    }

    public static function store()
    {
        $params = $_POST;

        $rypale = new rypale(array(
            'nimi' => $params['nimi'],
            'vari' => (int)$params['vari'],
            'kuvaus' => $params['kuvaus']
        ));

        Kint::dump($params);

        $rypale->save();

        Redirect::to('/rypale/' . $rypale->id, array('message' => 'Rypäle lisätty onnistuneesti!'));

    }

    public static function create()
    {

        View::make('rypale/new.html');
    }
}