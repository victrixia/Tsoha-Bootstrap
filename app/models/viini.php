<?php

Class Viini extends BaseModel
{

    public $id, $viinityyppi_id, $kotimaa_id, $nimi, $vuosikerta, $alkoholi, $happo, $makeus, $uutos, $rypaleet;

    public function __construct($attributes)
    {
        parent::__construct($attributes);
        $this->validators = array('validate_name', 'validate_numeric_fields', 'validate_fields_are_not_empty');
        $this->rypaleet = array();
    }

    public static function all()
    {
        $query = DB::connection()->prepare('SELECT * FROM viini');

        $query->execute();

        $rows = $query->fetchAll();
        $viinit = array();

        //käydään rivit läpi
        foreach ($rows as $row) {


            $viinit[] = new Viini(array(
                'id' => $row['id'],
                'viinityyppi_id' => $row['viinityyppi_id'],
                'kotimaa_id' => $row['kotimaa_id'],
                'nimi' => $row['nimi'],
                'vuosikerta' => $row['vuosikerta'],
                'alkoholi' => $row['alkoholi'],
                'happo' => $row['happo'],
                'makeus' => $row['makeus'],
                'uutos' => $row['uutos']
            ));

        }

        return $viinit;
    }

    public static function find($id)
    {

        $query = DB::connection()->prepare('SELECT * FROM viini WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $viini = new Viini(array(
                'id' => $row['id'],
                'viinityyppi_id' => $row['viinityyppi_id'],
                'kotimaa_id' => $row['kotimaa_id'],
                'nimi' => $row['nimi'],
                'vuosikerta' => $row['vuosikerta'],
                'alkoholi' => $row['alkoholi'],
                'happo' => $row['happo'],
                'makeus' => $row['makeus'],
                'uutos' => $row['uutos']
            ));

            return $viini;
        }
        return null;
    }


    public function save()
    {
        $query = DB::connection()->prepare('INSERT INTO viini (viinityyppi_id, kotimaa_id, nimi, vuosikerta, alkoholi, happo, makeus, uutos) VALUES (:viinityyppi_id, :kotimaa_id, :nimi, :vuosikerta, :alkoholi, :happo, :makeus, :uutos) RETURNING id');

        $query->execute(array('viinityyppi_id' => $this->viinityyppi_id, 'kotimaa_id' => $this->kotimaa_id, 'nimi' => $this->nimi, 'vuosikerta' => $this->vuosikerta, 'alkoholi' => $this->alkoholi, 'happo' => $this->happo, 'makeus' => $this->makeus, 'uutos' => $this->uutos));


        $row = $query->fetch();

        $this->id = $row['id'];

        $viinijarypalequery = DB::connection()->prepare('INSERT INTO viinin_rypaleet(viini_id, rypale_id) VALUES (:viini_id,:rypale_id)');

        foreach ($this->rypaleet as $rypale){
            $viinijarypalequery->execute(array('viini_id' => $this->id, 'rypale_id' => $rypale->id));

        }


    }

    public function update()
    {
        $query = DB::connection()->prepare('UPDATE viini SET viinityyppi_id = :viinityyppi_id, nimi = :nimi, vuosikerta = :vuosikerta, alkoholi = :alkoholi, happo = :happo, makeus = :makeus, uutos = :uutos WHERE id = :id RETURNING id');


        $query->execute(array('viinityyppi_id' => $this->viinityyppi_id, 'nimi' => $this->nimi, 'vuosikerta' => $this->vuosikerta, 'alkoholi' => $this->alkoholi, 'happo' => $this->happo, 'makeus' => $this->makeus, 'uutos' => $this->uutos, 'id' => $this->id));
        $row = $query->fetch();

        $this->id = $row['id'];

    }


    public function destroy()
    {
        $query = DB::connection()->prepare('DELETE FROM viini WHERE id = :id RETURNING id');


        $query->execute(array('id' => $this->id));
        $row = $query->fetch();

        $this->id = $row['id'];

    }

    public function validate_name()
    {
        $errors = $this->validate_string_length($this->nimi, 3);

        return $errors;

    }

    public function validate_numeric_fields()
    {
        $errors = $this->validate_is_a_number($this->alkoholi);
        $errors = array_merge($errors, $this->validate_is_a_number($this->uutos));

        $errors = array_merge($errors, $this->validate_is_a_number($this->happo));

        $errors = array_merge($errors, $this->validate_is_a_number($this->makeus));

        $errors = array_merge($errors, $this->validate_is_a_number($this->vuosikerta));


        return $errors;

    }



    public function validate_fields_are_not_empty(){
        $errors = $this->number_is_not_empty($this->alkoholi);
        $errors = array_merge($errors, $this->number_is_not_empty($this->uutos));

        $errors = array_merge($errors, $this->number_is_not_empty($this->happo));

        $errors = array_merge($errors, $this->number_is_not_empty($this->makeus));

        $errors = array_merge($errors, $this->number_is_not_empty($this->vuosikerta));


        return $errors;

    }


}

