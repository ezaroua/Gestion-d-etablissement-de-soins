<?php

class Database
{
    private static $bdd = null;

    public static function getBdd()
    {
        if (self::$bdd === null) {
            self::setBdd();
        }
        return self::$bdd;
    }

    private static function setBdd()
    {
        self::$bdd = new PDO('mysql:host=localhost;dbname=db_administrative_patient;charset=utf8', 'root', '');
        self::$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }
}
?>
