<?php

class ViiniController extends BaseController
{

    public static function index()
    {

        $viinit = Viini::all();
        View::make('viini/index.html', array('viinit' => $viinit));
    }

    public static function show($id)
    {

        $viini = Viini::find($id);
        View::make('viini/show.html', array('viini' => $viini));
//        Kint::dump($viini);
    }

    public static function store()
    {
        $params = $_POST;
        $rypaleet = $params['rypaleet'];

        $attributes = array(
            'nimi' => $params['nimi'],
            'viinityyppi_id' => (int)$params['tyyppi'],
            'makeus' => (is_numeric($params['makeus']) ? (int)($params['makeus']) : 0),
            'happo' => (is_numeric($params['happo']) ? (real)($params['happo']) : 0),
            'vuosikerta' => (int)$params['vuosikerta'],
            'alkoholi' => (is_numeric($params['alkoholi']) ? (real)($params['alkoholi']) : 0),
            'kotimaa_id' => (int)$params['kotimaa_id'],
            'uutos' => (is_numeric($params['uutos']) ? (real)($params['uutos']) : 0),
            'rypaleet' => $rypaleet
        );


        $viini = new Viini($attributes);


//        Kint::dump($params);
//        Kint::trace();
//
        $errors = $viini->errors();

        if (count($errors) == 0) {
            //jes jes
            $viini->save();

            Redirect::to('/viini/' . $viini->id, array('message' => 'Viini lisätty onnistuneesti!'));
        } else {

            View::make('viini/new.html', array('errors' => $errors, 'attributes' => $attributes, 'rypaleet' => $rypaleet));
        }

    }

    public static function create()
    {

        $rypaleet = Rypale::all();
        View::make('viini/new.html', array('rypaleet' => $rypaleet));
    }

    public static function edit($id)
    {


        $viini = Viini::find($id);
        $rypaleet = Rypale::all();
        View::make('viini/edit.html', array('attributes' => $viini, 'rypaleet' => $rypaleet));
    }

    public static function update($id)
    {

        $params = $_POST;

        $attributes = array(
            'id' => $id,
            'nimi' => $params['nimi'],
            'viinityyppi_id' => $params['tyyppi'],
            'makeus' => $params['makeus'],
            'happo' => $params['happo'],
            'vuosikerta' => $params['vuosikerta'],
            'alkoholi' => $params['alkoholi'],
            'kotimaa_id' => $params['kotimaa_id'],
            'uutos' => $params['uutos']
        );

        $viini = new Viini($attributes);
        $errors = $viini->errors();

        if (count($errors) > 0) {

            View::make('viini/edit.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $viini->update();
            Redirect::to('/viini/' . $viini->id, array('message' => 'Muokkaus onnistui!'));
        }

    }

    public static function destroy($id)
    {


        $viini = new Viini(array('id' => $id));

        $viini->destroy();

        // Ohjataan käyttäjä viinien listaussivulle ilmoituksen kera
        Redirect::to('/viini', array('message' => 'Rypäle on poistettu onnistuneesti!'));
    }

}