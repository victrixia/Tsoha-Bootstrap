<?php

class KotimaaController extends BaseController
{


    public static function index()
    {

        $maat = Kotimaa::all();
        View::make('kotimaa/index.html', array('maat' => $maat));
    }

    public static function show($id)
    {

        $kotimaa = Kotimaa::find($id);
        View::make('kotimaa/show.html', array('kotimaa' => $kotimaa));

    }



    public static function store()
    {
        $params = $_POST;

        $attributes = array(
            'nimi' => $params['nimi'],
            'alue' => $params['alue']
        );

        $kotimaa = new Kotimaa($attributes);
        $errors = $kotimaa->errors();

        if (count($errors) == 0){
            //jes jes
            $kotimaa->save();

            Redirect::to('/kotimaa/' . $kotimaa->id, array('message' => 'Maa ja alue lisätty onnistuneesti!'));
        } else {

            View::make('kotimaa/new.html', array('errors' => $errors, 'attributes' => $attributes));
        }




    }

    public static function create()
    {

        View::make('kotimaa/new.html');
    }

    public static function edit($id){

        $kotimaa = Rypale::find($id);
        View::make('maa/edit.html', array('attributes' => $kotimaa));
    }

    public static function update($id){

        $params = $_POST;

        $attributes = array(
            'id' => $id,
            'nimi' => $params['nimi'],
            'alue' => $params['alue']
        );

        $kotimaa = new Kotimaa($attributes);
        $errors = $kotimaa->errors();

        if (count($errors) > 0){

            View::make('kotimaa/edit.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $kotimaa->update();
            Redirect::to('/kotimaa/' . $kotimaa->id, array('message' => 'Muokkaus onnistui!'));
        }

    }

    public static function destroy($id){

        $kotimaa = new Rypale(array('id' => $id));

        $kotimaa->destroy();

        // Ohjataan käyttäjä pelien listaussivulle ilmoituksen kera
        Redirect::to('/kotimaa', array('message' => 'Maa ja alue on poistettu onnistuneesti!'));
    }
}