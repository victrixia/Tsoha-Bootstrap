<?php

Class Viini extends BaseModel
{

    public $id, $viinityyppi_id, $kotimaa_id, $nimi, $vuosikerta, $alkoholi, $happo, $makeus, $uutos;

    public function __construct($attributes)
    {
        parent::__construct($attributes);
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


//    tämä taitaa olla ihan höpöfunktio, mutta korjataan joskus
    public static function onPunaviini(){

        if ('viinityyppi_id' == 1){
            return true;
        }
        return false;
    }

    public function save(){
        $query = DB::connection()->prepare('INSERT INTO viini (viinityyppi_id, kotimaa_id, nimi, vuosikerta, alkoholi, happo, makeus, uutos) VALUES (:viinityyppi_id, :kotimaa_id, :nimi, :vuosikerta, :alkoholi, :happo, :makeus, :uutos) RETURNING id');

        $query -> execute(array('viinityyppi_id' => $this->viinityyppi_id, 'kotimaa_id' => $this->kotimaa_id, 'nimi' => $this->nimi, 'vuosikerta' => $this->vuosikerta, 'alkoholi' => $this->alkoholi, 'happo' => $this->happo, 'makeus' => $this->makeus, 'uutos' => $this->uutos));

        $row = $query->fetch();

        $this->id = $row['id'];

    }
}

