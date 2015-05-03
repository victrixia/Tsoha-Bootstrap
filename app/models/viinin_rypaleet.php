<?php

Class ViininRypaleet extends BaseModel
{

    public $viini_id, $rypale_id;

    public function __construct($attributes)
    {
        parent::__construct($attributes);
        $this->validators = array('validate_numeric_fields', 'validate_fields_are_not_empty', 'validate_grape_not_twice_in_same_wine');

    }



    public function save()
    {
        $query = DB::connection()->prepare('INSERT INTO viinin_rypaleet(viini_id, rypale_id) VALUES (:viini_id, :rypale_id)');

        $query->execute(array('viini_id' => $this->viini_id, 'rypale_id' => $this->rypale_id));


    }

    public function destroy()
    {
        $query = DB::connection()->prepare('DELETE FROM viinin_rypaleet WHERE viini_id = :viini_id AND rypale_id = :rypale_id RETURNING viini_id, rypale_id');


        $query->execute(array('viini_id' => $this->viini_id, 'rypale_id' => $this->rypale_id));
    }

    public static function find_viinin_rypaleet($viini_id){

        $query = DB::connection()->prepare('SELECT rypale_id FROM viinin_rypaleet WHERE viini_id = :viini_id');
        $query->execute(array('viini_id' => $viini_id));
        $rows = $query->fetchAll();
//        Kint::dump($rows);
        $rypale_idt = array();
        foreach ($rows as $row){
            $rypale_idt[] = $row['rypale_id'];

        }
//        Kint::dump($rypale_idt);
        return $rypale_idt;

        return null;
    }

    public static function find_rypaleen_viinit($rypale_id){
        $query = DB::connection()->prepare('SELECT viini_id FROM viinin_rypaleet WHERE rypale_id = :rypale_id');
        $query->execute(array('rypale_id' => $rypale_id));
        $rows = $query->fetchAll();
//        Kint::dump($rows);
        $viini_idt = array();
        foreach ($rows as $row){
            $viini_idt[] = $row['viini_id'];

        }
//        Kint::dump($viini_idt);
        return $viini_idt;

        return null;

    }

    public function validate_numeric_fields()
    {
        $errors = $this->validate_is_a_number($this->viini_id);
        $errors = array_merge($errors, $this->validate_is_a_number($this->rypale_id));

        return $errors;
    }

    public function validate_fields_are_not_empty()
    {
        $errors = $this->number_is_not_empty($this->viini_id);
        $errors = array_merge($errors, $this->number_is_not_empty($this->rypale_id));


        return $errors;

    }

    public function validate_grape_not_twice_in_same_wine(){
        $rypaleet = ViininRypaleet::find_viinin_rypaleet($this->viini_id);

        $errors = array();
        if (in_array($this->rypale_id, $rypaleet)){
            $errors[] = 'Et voi lisätä samaa rypälettä useampaan kertaan!';

        }

        return $errors;

    }
}