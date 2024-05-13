<?php

require 'Database.php'; // Inclure le fichier de connexion à la base de données
class ModeleInsertionPatientNoSQL
{
    private $chemin_script_python = "src/models/python/ModeleInsertionPatient.py";
    private $chemin_exec_python = "C:\\Users\\thoma\\AppData\\Local\\Programs\\Python\\Python312\\python.exe";
    protected function getBdd()
    {
        return Database::getBdd();
    }

    public function recupererDonneePatient($num_secu)
    {
        $stmt = $this->getBdd()->prepare("SELECT * FROM patients WHERE num_sec=?");
        $stmt->bindParam(1, $num_secu);

        try {
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result; // Retourne le tableau des résultats
        } catch (PDOException $e) {
            echo "Erreur lors de l'exécution de la requête : " . $e->getMessage();
            return [];
        }
    }

    public function recupererDonneeUser($id_user)
    {
        $stmt = $this->getBdd()->prepare("SELECT * FROM users WHERE id_user=?");
        $stmt->bindParam(1, $id_user);

        try {
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result; // Retourne le tableau des résultats
        } catch (PDOException $e) {
            echo "Erreur lors de l'exécution de la requête : " . $e->getMessage();
            return [];
        }
    }

    public function creerDansNoSQL($nom, $prenom, $sexe, $mail, $date_naissance, $profession, $situation_familial, $num_sec, $adresse_postal, $cp, $ville, $pays, $num_tel, $type_assurance, $contacte_cas_urgence, $medecin_traitant, $langue, $id_user)
    {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        // Appel du script Python en utilisant exec
        exec("$this->chemin_exec_python $this->chemin_script_python $nom $prenom $sexe $mail $date_naissance $profession $situation_familial $num_sec $adresse_postal $cp $ville $pays $num_tel $type_assurance $contacte_cas_urgence $medecin_traitant $langue $id_user", $output, $return);

        if ($return == 0) {
            echo "Insertion réussi";
        } else {
            echo "<pre>";
            print_r($output);
            echo "</pre>";
        }
    }
}
// Chemin vers le script Python
/*$chemin_script_python = "ModeleInsertionPatient.py";
$chemin_exec_python = "C:\\Users\\thoma\\AppData\\Local\\Programs\\Python\\Python312\\python.exe";

//valeur
$numero_securite_sociale = "110-00-0000";
$nom = "Letoublon";
$prenom = "Thomas";
$sexe = "M";
$mail = "toto@gmail.com";

error_reporting(E_ALL);
ini_set('display_errors', 1);
// Appel du script Python en utilisant exec
exec("$chemin_exec_python $chemin_script_python $numero_securite_sociale $nom $prenom $sexe $mail", $output, $return);

// Affichage de la sortie et du code de retour
/*echo "Sortie du script Python :";
echo "<pre>";
print_r($output);
echo "</pre>";

echo "Code de retour : $return";*/
/*if ($return == 0) {
    echo "Insertion réussi";
}*/
