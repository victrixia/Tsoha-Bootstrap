<?php

class ViininRypaleetController extends BaseController
{


    public static function store()
    {
        $params_viini = $_POST['viini_id'];
        $params_rypale = $_POST['rypale_id'];

        $attributes = array(
            'viini_id' => (int)$params_viini['viini_id'],
            'rypale_id' => (int)$params_rypale['rypale_id']
        );

        foreach ($params_viini as $key => $viini) {

            $idt = array('viini_id' => $viini, 'rypale_id' => $params_rypale[$key]);
            $pari = new ViininRypaleet($idt);
            $errors = $pari->errors();
            if (count($errors) == 0) {
                //jes jes
                $pari->save();


            } else {

                View::make('rypale/new.html', array('errors' => $errors, 'attributes' => $attributes));
            }
        }
        Redirect::to('/viini/' . $params_viini->viini_id, array('message' => 'Rypäleet lisätty onnistuneesti!'));

    }


    public static function find_rypaleet($id)
    {
        $parit = ViininRypaleet::find_viinin_rypaleet($id);
        $rypaleet = array();
        Kint::dump($parit);

        foreach ($parit as $key => $viini_id) {
            $rypale = Rypale::find($parit[$key]);
            array_push($rypaleet, $rypale);
        }

        return $rypaleet;

    }


    public
    static function edit($id)
    {

        $rypale = Rypale::find($id);
        View::make('rypale/edit.html', array('attributes' => $rypale));
    }

    public static function update($id)
    {

        $params = $_POST;

        $attributes = array(
            'id' => $id,
            'nimi' => $params['nimi'],
            'vari' => (int)$params['vari'],
            'kuvaus' => $params['kuvaus']
        );

        $rypale = new Rypale($attributes);
        $errors = $rypale->errors();

        if (count($errors) > 0) {

            View::make('rypale/edit.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $rypale->update();
            Redirect::to('/rypale/' . $rypale->id, array('message' => 'Muokkaus onnistui!'));
        }

    }

    public static function destroy($id)
    {

        $rypale = new Rypale(array('id' => $id));

        $rypale->destroy();

        // Ohjataan käyttäjä pelien listaussivulle ilmoituksen kera
        Redirect::to('/rypale', array('message' => 'Rypäle on poistettu onnistuneesti!'));
    }
}