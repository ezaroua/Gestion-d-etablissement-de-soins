<?php 

abstract class Model {
    // Propriété statique pour stocker la connexion à la base de données
    private static $_bdd;

    // Méthode pour initialiser la connexion à la base de données
    private static function setBdd() {
        self::$_bdd = new PDO('mysql:host=localhost;dbname=db_administrative_patient;charset=utf8', 'root', '');
        self::$_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    // Méthode pour récupérer la connexion à la base de données
    protected function getBdd() {
        if (self::$_bdd == null) {
            self::setBdd(); // Appel de la méthode setBdd pour initialiser la connexion si elle n'existe pas
        }
        return self::$_bdd;
    }

    // Méthode pour récupérer toutes les données d'une table
    protected function getAll($table, $obj) {
        $var = [];
        $req = $this->getBdd()->prepare('SELECT * FROM ' . $table . ' ORDER BY id_user DESC'); 
        $req->execute();
        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $var[] = new $obj($data);
        }
        return $var;
        $req->closeCursor(); // Fermeture du curseur
        
    }
}
