<?php

Class ViininRypaleet extends BaseModel
{

    public $viini_id, $rypale_id;

    public function __construct($attributes)
    {
        parent::__construct($attributes);
        $this->validators = array('validate_numeric_fields', 'validate_fields_are_not_empty');

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
        $rows = $query->fetch();
        $rypale_idt= array();

        if ($rows) {
            foreach ($rows as $row){
                $rypale_idt[] = $row['rypale_id'];

            }

            Kint::dump($rypale_idt);

        }
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
}