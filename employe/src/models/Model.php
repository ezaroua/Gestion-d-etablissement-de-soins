<?php

require_once 'Database.php'; // Inclure le fichier de connexion à la base de données

abstract class Model
{
    // Méthode pour récupérer la connexion à la base de données
    protected function getBdd()
    {
        return Database::getBdd();
    }

    // Méthode pour récupérer toutes les données d'une table
    protected function getAll($table, $obj)
    {
        $var = [];
        $req = $this->getBdd()->prepare('SELECT * FROM ' . $table . ' JOIN users ON patients.id_user=users.id_user ORDER BY users.id_user ASC');
        $req->execute();
        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $var[] = new $obj($data);
        }
        $req->closeCursor(); // Fermeture du curseur
        return $var;
    }

    public function getsearchPatients($table, $obj, $nom, $prenom, $dateNaissance, $num_sec, $patientId)
    {
        $var = [];
        $sql = 'SELECT * FROM ' . $table . ' AS patients JOIN users AS users ON patients.id_user = users.id_user WHERE 1=1';

        $params = [];

        if (!empty($nom)) {
            $sql .= " AND users.nom_user LIKE ?";
            $params[] = "%$nom%";
        }
        if (!empty($prenom)) {
            $sql .= " AND users.prenom_user LIKE ?";
            $params[] = "%$prenom%";
        }
        if (!empty($dateNaissance) && preg_match("/\d{4}-\d{2}-\d{2}/", $dateNaissance)) {
            $sql .= " AND patients.date_naissance = ?";
            $params[] = $dateNaissance;
        }
        if (!empty($num_sec)) {
            $sql .= " AND patients.num_sec = ?";
            $params[] = $num_sec;
        }
        if (!empty($patientId) && ctype_digit($patientId)) {
            $sql .= " AND patients.id_user = ?";
            $params[] = $patientId;
        }

        $stmt = $this->getBdd()->prepare($sql);
        $stmt->execute($params);
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $var[] = new $obj($data);
        }
        $stmt->closeCursor(); // Fermeture du curseur
        return $var;
    }
}
?>
