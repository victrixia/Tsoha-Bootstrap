<?php

Class Viini extends BaseModel
{

    public $id, $viinityyppi_id, $kotimaa_id, $nimi, $vuosikerta, $alkoholi, $happo, $makeus, $uutos, $kuvaus;

    public function __construct($attributes)
    {
        parent::__construct($attributes);
        $this->validators = array('validate_name', 'validate_numeric_fields', 'validate_fields_are_not_empty');

    }

    public function tyyppi()
    {

        if ($this->viinityyppi_id == 1) {
            return "Punaviini";
        } else if ($this->viinityyppi_id == 2) {
            return "Valkoviini";
        } else if ($this->viinityyppi_id == 3) {
            return "Kuohuviini";
        } else if ($this->viinityyppi_id == 4) {
            return "Roseeviini";
        } else if ($this->viinityyppi_id == 5) {
            return "Jälkiruokaviini";
        } else if ($this->viinityyppi_id == 6) {
            return "Shampanja";
        } else {
            return "Tuntematon";
        }
    }

    public function onPunaviini()
    {
        return $this->viinityyppi_id == 1;
    }

    public function hapokkuus()
    {
        $hapokas = "hapokas";

        if ($this->onPunaviini()) {
            $hapokas = "tanniininen";
        }

        if ($this->happo <= 3) {
            $luonnehdinta = "vähä";
        } else if ($this->happo <= 5) {
            $luonnehdinta = "keski";
        } else if ($this->happo <= 7) {
            $luonnehdinta = "";
        } else {
            $luonnehdinta = "erittäin ";
        }

        return $luonnehdinta . $hapokas;

    }

    public function makeus()
    {

        if ($this->makeus <= 4) {
            $luonnehdinta = "";
        } else if ($this->makeus <= 10) {
            $luonnehdinta = "kuiva";
        } else if ($this->makeus <= 20) {
            $luonnehdinta = "puolikuiva";

        } else if ($this->makeus <= 35) {
            $luonnehdinta = "puolimakea";
        } else {
            $luonnehdinta = "makea";
        }

        return $luonnehdinta;
    }

    public function taytelaisyys()
    {

        if ($this->uutos <= 10) {
            $luonnehdinta = "Kevyt";
        } else if ($this->uutos <= 20) {
            $luonnehdinta = "Keskitäyteläinen";
        } else if ($this->uutos <= 30) {
            $luonnehdinta = "Täyteläinen";

        } else {
            $luonnehdinta = "Erittäin täyteläinen";
        }

        return $luonnehdinta;
    }

    public static function newest($tyyppi)
    {


        $query = DB::connection()->prepare(' SELECT * FROM viini WHERE viinityyppi_id = ' . $tyyppi . ' ORDER BY id desc LIMIT 3');

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
                'uutos' => $row['uutos'],
                'kuvaus' => $row['kuvaus']
            ));

        }

        return $viinit;
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
                'uutos' => $row['uutos'],
                'kuvaus' => $row['kuvaus']
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
                'uutos' => $row['uutos'],
                'kuvaus' => $row['kuvaus']
            ));


            return $viini;
        }
        return null;
    }


    public function save()
    {
        $query = DB::connection()->prepare('INSERT INTO viini (viinityyppi_id, kotimaa_id, nimi, vuosikerta, alkoholi, happo, makeus, uutos) VALUES (:viinityyppi_id, :kotimaa_id, :nimi, :vuosikerta, :alkoholi, :happo, :makeus, :uutos, :kuvaus) RETURNING id');

        $query->execute(array('viinityyppi_id' => $this->viinityyppi_id, 'kotimaa_id' => $this->kotimaa_id, 'nimi' => $this->nimi, 'vuosikerta' => $this->vuosikerta, 'alkoholi' => $this->alkoholi, 'happo' => $this->happo, 'makeus' => $this->makeus, 'uutos' => $this->uutos, 'kuvaus' => $this->kuvaus));


        $row = $query->fetch();

        $this->id = $row['id'];

    }

    public function update()
    {
        $query = DB::connection()->prepare('UPDATE viini SET viinityyppi_id = :viinityyppi_id, nimi = :nimi, vuosikerta = :vuosikerta, alkoholi = :alkoholi, happo = :happo, makeus = :makeus, uutos = :uutos, kuvaus = :kuvaus WHERE id = :id RETURNING id');


        $query->execute(array('viinityyppi_id' => $this->viinityyppi_id, 'nimi' => $this->nimi, 'vuosikerta' => $this->vuosikerta, 'alkoholi' => $this->alkoholi, 'happo' => $this->happo, 'makeus' => $this->makeus, 'uutos' => $this->uutos, 'kuvaus' => $this->kuvaus, 'id' => $this->id));
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


    public function validate_fields_are_not_empty()
    {
        $errors = $this->number_is_not_empty($this->alkoholi);
        $errors = array_merge($errors, $this->number_is_not_empty($this->uutos));

        $errors = array_merge($errors, $this->number_is_not_empty($this->happo));

        $errors = array_merge($errors, $this->number_is_not_empty($this->makeus));

        $errors = array_merge($errors, $this->number_is_not_empty($this->vuosikerta));


        return $errors;

    }


}

