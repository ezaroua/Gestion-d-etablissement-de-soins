<?php

require 'Database.php';

class ModelModificationPatient
{
    private $bdd;
    private $chemin_script_python_insertion = "src/models/python/ModeleInsertionPatient.py";
    private $chemin_script_python_modification = "src/models/python/ModeleModificationPatient.py";
    private $chemin_exec_python = "C:\Users\User\AppData\Local\Programs\Python\Python312\python.exe";
    //private $chemin_exec_python = "C:\\Users\\thoma\\AppData\\Local\\Programs\\Python\\Python312\\python.exe";

    public function __construct($bdd)
    {
        $this->bdd = $bdd;
    }

    public function getPatientInfo($patientId)
    {
        // Récupérer les informations de la table 'users'
        $query1 = $this->bdd->prepare('SELECT Nom_user, prenom_user, sexe, adresse_mail FROM users WHERE id_user = :id');
        $query1->bindParam(':id', $patientId, PDO::PARAM_INT);
        $query1->execute();
        $userInfo = $query1->fetch(PDO::FETCH_ASSOC);

        // Récupérer les informations de la table 'patients'
        $query2 = $this->bdd->prepare('SELECT date_naissance, profession, situation_familial, num_sec, adresse_postal, CP, Ville, Pays, num_tel, type_assurance, contacte_cas_urgence, MedecinTraitant, langue_parler, telephone_cas_urgence, lien_cas_urgence FROM patients WHERE id_user = :id');
        $query2->bindParam(':id', $patientId, PDO::PARAM_INT);
        $query2->execute();
        $patientInfo = $query2->fetch(PDO::FETCH_ASSOC);

        // Combiner les résultats des trois requêtes
        if ($userInfo && $patientInfo) {
            return array_merge($userInfo, $patientInfo);
        } elseif ($userInfo) {
            return $userInfo;
        } elseif ($patientInfo) {
            return $patientInfo;
        }

        return false; // ou null, selon votre logique d'erreur
    }

    public function recupererServicePatient($patientId)
    {
        $query3 = $this->bdd->prepare('SELECT nom_service FROM service INNER JOIN patient_service ON service.id_service=patient_service.id_service WHERE id_user=:id');
        $query3->bindParam(':id', $patientId, PDO::PARAM_INT);
        $query3->execute();
        $patientService = $query3->fetchAll(PDO::FETCH_ASSOC);

        return $patientService;
    }

    public function insererServicePatient($patientId, $service)
    {
        $sql = $this->bdd->prepare("INSERT INTO patient_service (id_service, id_user) VALUES (:id_service, :id_user)");

        // Lier les paramètres à la requête SQL
        $sql->bindParam(':id_service', $service, PDO::PARAM_INT);
        $sql->bindParam(':id_user', $patientId, PDO::PARAM_INT);

        // Exécuter la requête
        $sql->execute();
    }


    public function updatePatientInfo($patientId, $patientData)
    {
        // Préparez votre requête SQL pour mettre à jour les informations du patient
        $query = $this->bdd->prepare('UPDATE users SET prenom_user = ?, Nom_user = ?, adresse_mail = ?, sexe = ? WHERE id_user = ?');

        // Bind les valeurs
        $query->execute([
            $patientData['prenom'],
            $patientData['nom'],
            $patientData['mail'],
            $patientData['sexe'],
            $patientId
        ]);
        // Préparez votre requête SQL pour mettre à jour les informations du patient
        $query2 = $this->bdd->prepare('UPDATE patients SET date_naissance = ?, adresse_postal = ?, CP = ?, Ville = ?, Pays = ?, profession = ?, situation_familial = ?, num_tel = ?, langue_parler = ?, num_sec = ?, type_assurance = ?, MedecinTraitant = ?, contacte_cas_urgence = ?, telephone_cas_urgence = ?, lien_cas_urgence = ? WHERE id_user = ?');

        // Bind les valeurs
        $query2->execute([
            $patientData['date_naissance'],
            $patientData['adresse_postale'],
            $patientData['cp'],
            $patientData['ville'],
            $patientData['pays'],
            $patientData['profession'],
            $patientData['situation_familiale'],
            $patientData['numero_telephone'],
            $patientData['langue_parlee'],
            $patientData['numero_secu'],
            $patientData['type_assurance'],
            $patientData['medecin_traitant'],
            $patientData['personne_urgence'],
            $patientData['tel_cas_urgence'],
            $patientData['lien_urgence'],
            $patientId
        ]);

        // Vérifiez si la mise à jour a réussi et retournez true ou false en conséquence
        return $query2->rowCount() > 0;
    }

    public function recupererDonneePatient($id_user)
    {
        $stmt = $this->bdd->prepare("SELECT * FROM patients WHERE id_user=?");
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

    public function recupererDonneeUser($id_user)
    {
        $stmt = $this->bdd->prepare("SELECT * FROM users WHERE id_user=?");
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

    public function creerDansNoSQL($nom, $prenom, $sexe, $mail, $date_naissance, $profession, $situation_familial, $num_sec, $adresse_postal, $cp, $ville, $pays, $num_tel, $type_assurance, $contacte_cas_urgence, $telephone_cas_urgence, $lien_cas_urgence, $medecin_traitant, $langue, $id_user, $service)
    {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $args = array_map('escapeshellarg', func_get_args());
        $command = "$this->chemin_exec_python $this->chemin_script_python_insertion " . implode(' ', $args) . " 2>&1";
        // Appel du script Python en utilisant exec
        exec($command, $output, $return);
        //exec("$this->chemin_exec_python $this->chemin_script_python $nom $prenom $sexe $mail $date_naissance $profession $situation_familial $num_sec $adresse_postal $cp $ville $pays $num_tel $type_assurance $contacte_cas_urgence $medecin_traitant $langue $id_user $service", $output, $return);

        if ($return == 0) {
            echo "<script>alert('Le patient a été ajouté au service sélectionné!');
                document.location.href='?url=ModificationPatient&id=" . $id_user . "';
                </script>";
        } else {
            echo "<pre>";
            print_r($output);
            echo "</pre>";
        }
    }

    public function modifierDansNoSQL($patientId, $prenom, $nom, $mail, $sexe, $date_naissance, $adresse_postal, $cp, $ville, $pays, $profession, $situation_familial, $num_tel, $langue, $numero_secu, $type_assurance, $medecin_traitant, $personne_cas_urgence, $telephone_cas_urgence, $lien_cas_urgence)
    {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $args = array_map('escapeshellarg', func_get_args());
        $command = "$this->chemin_exec_python $this->chemin_script_python_modification " . implode(' ', $args) . " 2>&1";

        // Appel du script Python en utilisant exec
        exec($command, $output, $return);
        //exec("$this->chemin_exec_python $this->chemin_script_python $nom $prenom $sexe $mail $date_naissance $profession $situation_familial $num_sec $adresse_postal $cp $ville $pays $num_tel $type_assurance $contacte_cas_urgence $medecin_traitant $langue $id_user $service", $output, $return);

        if ($return == 0) {
            echo "<script>alert('Modification effectué!');
                document.location.href='?url=ModificationPatient&id=" . $patientId . "';
                </script>";
        } else {
            echo "<pre>";
            print_r($output);
            echo "</pre>";
        }
    }
}
