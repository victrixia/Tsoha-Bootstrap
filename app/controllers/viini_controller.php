<?php

class ViiniController extends BaseController
{

    public static function index()
    {

        $viinit = Viini::all();
        $maat = Kotimaa::all();

        View::make('viini/index.html', array('viinit' => $viinit, 'maat' => $maat));
    }

    public static function show($id)
    {

        $viini = Viini::find($id);
        $rypaleet = ViininRypaleetController::find_rypaleet($id);
        $kotimaa = Kotimaa::find($viini->kotimaa_id);
        View::make('viini/show.html', array('viini' => $viini, 'kotimaa' => $kotimaa, 'rypaleet' => $rypaleet));
//        Kint::dump($viini);
//        Kint::dump($rypaleet);
    }

    public static function store()
    {
        $params = $_POST;


        $attributes = array(
            'nimi' => $params['nimi'],
            'viinityyppi_id' => (int)$params['tyyppi'],
            'makeus' => (is_numeric($params['makeus']) ? (int)($params['makeus']) : 0),
            'happo' => (is_numeric($params['happo']) ? (real)($params['happo']) : 0),
            'vuosikerta' => (int)$params['vuosikerta'],
            'alkoholi' => (is_numeric($params['alkoholi']) ? (real)($params['alkoholi']) : 0),
            'kotimaa_id' => (int)$params['kotimaa_id'],
            'uutos' => (is_numeric($params['uutos']) ? (real)($params['uutos']) : 0),
            'kuvaus' => $params['kuvaus']
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

            $kaikkirypaleet = Rypale::all();
            $maat = Kotimaa::all();
            View::make('viini/new.html', array('errors' => $errors, 'attributes' => $attributes, 'rypaleet' => $kaikkirypaleet, 'maat' => $maat));
        }

    }

    public static function edit_grapes($id){

        $rypaleet = Rypale::all();
        $viini = Viini::find($id);
        $viinin_rypaleet = ViininRypaleetController::find_rypaleet($id);

        View::make('viini/new_grapes.html', array('rypaleet' => $rypaleet, 'viini' => $viini, 'viinin_rypaleet' => $viinin_rypaleet));
    }

    public static function create()
    {

        $maat = Kotimaa::all();
        $rypaleet = Rypale::all();
        View::make('viini/new.html', array('rypaleet' => $rypaleet, 'maat' => $maat));
    }

    public static function edit($id)
    {


        $viini = Viini::find($id);
        $rypaleet = Rypale::all();
        $maat = Kotimaa::all();
        View::make('viini/edit.html', array('attributes' => $viini, 'rypaleet' => $rypaleet, 'maat' => $maat));
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
            'uutos' => $params['uutos'],
            'kuvaus' => $params['kuvaus']
        );

        Kint::dump($attributes);

        $viini = new Viini($attributes);
        $errors = $viini->errors();

        if (count($errors) > 0) {

            View::make('viini/edit.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $viini->update();
            Redirect::to('/viini/' . $viini->id, array('message' => 'Muokkaus todellakin onnistui!'));
        }

    }

    public static function destroy($id)
    {


        $viini = new Viini(array('id' => $id));

        $viini->destroy();

        // Ohjataan käyttäjä viinien listaussivulle ilmoituksen kera
        Redirect::to('/viini', array('message' => 'Viini on poistettu onnistuneesti!'));
    }

}