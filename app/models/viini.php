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
}

