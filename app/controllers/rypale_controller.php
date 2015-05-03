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
        $viinit = ViininRypaleetController::find_viinit($id);
        $maat = Kotimaa::all();
        View::make('rypale/show.html', array('rypale' => $rypale, 'viinit' => $viinit, 'maat' => $maat));
//        Kint::dump($rypale);
    }

    public static function store()
    {
        $params = $_POST;

        $attributes = array(
            'nimi' => $params['nimi'],
            'vari' => (int)$params['vari'],
            'kuvaus' => $params['kuvaus']
        );

        $rypale = new Rypale($attributes);
        $errors = $rypale->errors();

        if (count($errors) == 0){
            //jes jes
            $rypale->save();

            Redirect::to('/rypale/' . $rypale->id, array('message' => 'Rypäle lisätty onnistuneesti!'));
        } else {

            View::make('rypale/new.html', array('errors' => $errors, 'attributes' => $attributes));
        }




    }

    public static function create()
    {

        View::make('rypale/new.html');
    }

    public static function edit($id){

        $rypale = Rypale::find($id);
        View::make('rypale/edit.html', array('attributes' => $rypale));
    }

    public static function update($id){

        $params = $_POST;

        $attributes = array(
            'id' => $id,
            'nimi' => $params['nimi'],
            'vari' => (int)$params['vari'],
            'kuvaus' => $params['kuvaus']
        );

        $rypale = new Rypale($attributes);
        $errors = $rypale->errors();

        if (count($errors) > 0){

            View::make('rypale/edit.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $rypale->update();
            Redirect::to('/rypale/' . $rypale->id, array('message' => 'Muokkaus onnistui!'));
        }

    }

    public static function destroy($id){

        $rypale = new Rypale(array('id' => $id));

        $rypale->destroy();

        // Ohjataan käyttäjä pelien listaussivulle ilmoituksen kera
        Redirect::to('/rypale', array('message' => 'Rypäle on poistettu onnistuneesti!'));
    }
}