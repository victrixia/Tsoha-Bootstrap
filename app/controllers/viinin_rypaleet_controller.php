<?php

class ViininRypaleetController extends BaseController
{



        public static function store()
    {
        $params_viini = $_POST['viini_id'];
        $params_rypale = $_POST['rypaleet'];

//        Kint::dump($params_rypale);
//        Kint::dump($params_viini);

        $attributes = array(
            'viini_id' => (int)$params_viini['viini_id'],
            'rypale_id' => $params_rypale
        );

        foreach ($params_rypale as $rypale) {

            $idt = array('viini_id' => (int)$params_viini, 'rypale_id' => (int)$rypale);
            $pari = new ViininRypaleet($idt);
            $errors = $pari->errors();
            if (count($errors) == 0) {
                //jes jes
                $pari->save();


            } else {
                $rypaleet = Rypale::all();
                $viini = Viini::find($params_viini);
                $viinin_rypaleet = ViininRypaleetController::find_rypaleet($params_viini);
                View::make('viini/new_grapes.html', array('errors' => $errors, 'attributes' => $attributes, 'rypaleet' => $rypaleet, 'viini' => $viini, 'viinin_rypaleet' => $viinin_rypaleet));
            }
        }
        Redirect::to('/viini/' . $params_viini, array('message' => 'Rypäleet lisätty onnistuneesti!'));

    }


    public static function find_rypaleet($id)
    {
        $parit = ViininRypaleet::find_viinin_rypaleet($id);
        $rypaleet = array();

        foreach ($parit as $key => $rypale_id) {
            $rypale = Rypale::find((int)$parit[$key]);
            array_push($rypaleet, $rypale);
        }
        return $rypaleet;

    }

    public static function find_viinit($id){
        $parit = ViininRypaleet::find_rypaleen_viinit($id);
        $viinit = array();

        foreach ($parit as $key => $viini_id){
            $viini = Viini::find((int)$parit[$key]);
            array_push($viinit, $viini);

            return $viinit;
        }
    }


    public static function destroy($viini_id, $rypale_id)
    {

        $rypale = new ViininRypaleet(array('viini_id' => $viini_id, 'rypale_id' => $rypale_id));

        $rypale->destroy();

        Redirect::to('/viini/'.$viini_id, array('message' => 'Rypäle on poistettu onnistuneesti!'));
    }
}