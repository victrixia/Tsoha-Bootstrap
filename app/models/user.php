<?php

class User extends BaseModel
{

    public $id, $kayttajanimi, $salasana, $oikeanimi, $kuvaus;

    public function __construct($attributes)
    {
        parent::__construct($attributes);
        $this->validators = array('validate_name', 'validate_password', 'validate_realname');
    }

    public static function find($id){

        $query = DB::connection()->prepare('SELECT * FROM kayttaja WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $kayttaja = new User(array(

                'id' => $row['id'],
                'kayttajanimi' => $row['kayttajanimi'],
                'salasana' => $row['salasana'],
                'oikeanimi' => $row['oikeanimi'],
                'kuvaus' => $row['kuvaus']
            ));
            return $kayttaja;
        } else {
            return null;
        }

    }

    public static function authenticate($username, $password)
    {


        $query = DB::connection()->prepare('SELECT * FROM kayttaja WHERE kayttajanimi = :kayttajanimi AND salasana = :salasana LIMIT 1');
        $query->execute(array('kayttajanimi' => $username, 'salasana' => $password));
        $row = $query->fetch();
        if ($row) {
            $kayttaja = new User(array(

                'id' => $row['id'],
                'kayttajanimi' => $row['kayttajanimi'],
                'salasana' => $row['salasana'],
                'oikeanimi' => $row['oikeanimi'],
                'kuvaus' => $row['kuvaus']
            ));
            return $kayttaja;
        } else {
            return null;
        }

    }

    public function validate_name()
    {

        $errors = $this->validate_string_length($this->kayttajanimi, 3);
        $errors = arrays_merge($errors, $this->validate_max_length($this->kayttajanimi, 30));

        return $errors;
    }

    public function validate_realname()
    {

        $errors = $this->validate_string_length($this->oikeanimi, 3);
        $errors = arrays_merge($errors, $this->validate_max_length($this->oikeanimi, 255));

        return $errors;
    }


    public function validate_password()
    {

        $errors = $this->validate_string_length($this->salasana, 3);
        $errors = arrays_merge($errors, $this->validate_max_length($this->salasana, 20));

        return $errors;
    }

}