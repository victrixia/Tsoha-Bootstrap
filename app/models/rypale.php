<?php

Class Rypale extends BaseModel{

    public $id, $nimi, $vari, $kuvaus;

    public function __construct($attributes)
    {
        parent::__construct($attributes);
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

    public static function vari(){

        if ('vari' == 1){
            return "Punainen";
        }
        return "Valkoinen";
    }
}

