<?php

Class Kotimaa extends BaseModel
{

    public $id, $nimi, $alue;

    public function __construct($attributes)
    {
        parent::__construct($attributes);
        $this->validators = array('validate_name', 'validate_alue');

    }

    public function toString(){
        return $this->nimi . ', ' . $this->alue;
    }

    public static function all()
    {
        $query = DB::connection()->prepare('SELECT * FROM kotimaa');

        $query->execute();

        $rows = $query->fetchAll();
        $maat = array();

        //käydään rivit läpi
        foreach ($rows as $row) {


            $maat[] = new Kotimaa(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'alue' => $row['alue']
            ));

        }

        return $maat;
    }

    public static function find($id)
    {

        $query = DB::connection()->prepare('SELECT * FROM kotimaa WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $maa = new Kotimaa(array(

                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'alue' => $row['alue']
            ));

            return $maa;
        }
        return null;
    }

    public function save(){
        $query = DB::connection()->prepare('INSERT INTO kotimaa (nimi, alue) VALUES (:nimi, :alue) RETURNING id');

        $query -> execute(array('nimi' => $this->nimi, 'alue' => $this->alue));
        $row = $query->fetch();

        $this->id = $row['id'];

    }

    public function update(){
        $query = DB::connection()->prepare('UPDATE kotimaa SET nimi = :nimi, alue = :alue WHERE id = :id RETURNING id');


        $query -> execute(array('nimi' => $this->nimi, 'alue' => $this->alue, 'id' => $this->id));
        $row = $query->fetch();

        $this->id = $row['id'];
    }

    public function destroy(){
        $query = DB::connection()->prepare('DELETE FROM kotimaa WHERE id = :id RETURNING id');


        $query -> execute(array('id' => $this->id));
        $row = $query->fetch();

        $this->id = $row['id'];

    }

    public function validate_name()
    {
        $errors = $this->validate_string_length($this->nimi, 3);

        return $errors;

    }

    public function validate_alue()
    {
        $errors = $this->validate_string_length($this->alue, 3);

        return $errors;

    }
}