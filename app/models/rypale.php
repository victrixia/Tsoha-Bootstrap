<?php

Class Rypale extends BaseModel{

    public $id, $nimi, $vari, $kuvaus;

    public function __construct($attributes)
    {
        parent::__construct($attributes);
        $this->validators = array('validate_name','validate_colour_is_a_number','validate_colour_is_one_or_two');
    }

    public static function all()
    {
        $query = DB::connection()->prepare('SELECT * FROM rypale');

        $query->execute();

        $rows = $query->fetchAll();
        $rypaleet = array();

        //käydään rivit läpi
        foreach ($rows as $row) {


            $rypaleet[] = new Rypale(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'vari' => $row['vari'],
                'kuvaus' => $row['kuvaus']
            ));

        }

        return $rypaleet;
    }


    public static function find($id)
    {

        $query = DB::connection()->prepare('SELECT * FROM rypale WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $rypale = new Viini(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'vari' => $row['vari'],
                'kuvaus' => $row['kuvaus']
            ));

            return $rypale;
        }
        return null;
    }

    public function save(){
        $query = DB::connection()->prepare('INSERT INTO rypale (nimi, vari, kuvaus) VALUES (:nimi, :vari, :kuvaus) RETURNING id');

        $query -> execute(array('nimi' => $this->nimi, 'vari' => $this->vari, 'kuvaus'=>$this->kuvaus));
        $row = $query->fetch();

        $this->id = $row['id'];

    }

    public function update(){
        $query = DB::connection()->prepare('INSERT INTO rypale (nimi, vari, kuvaus) VALUES (:nimi, :vari, :kuvaus) RETURNING id');

        $query -> execute(array('nimi' => $this->nimi, 'vari' => $this->vari, 'kuvaus'=>$this->kuvaus));
        $row = $query->fetch();

        $this->id = $row['id'];

    }

    public static function vari(){

        if ('vari' == 1){
            return "Punainen";
        }
        return "Valkoinen";
    }

    public function validate_name(){
        $errors = $this->validate_string_length($this->nimi,3);

        return $errors;

    }

    public function validate_colour_is_a_number(){
        $errors = $this->validate_is_a_number($this->vari);

       return $errors;

    }

    public function validate_colour_is_one_or_two(){

        $errors = array();

        if ($this->vari != 1 || $this->vari != 2){
            $errors[] = 'Eipäs yritetä syöttää muuta kuin 1 tai 2';
        }
    }
}

