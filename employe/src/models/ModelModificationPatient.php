<?php

require 'Database.php';

class ModelModificationPatient {
    private $bdd;

    public function __construct($bdd)
    {
        $this->bdd = $bdd;
    }

    public function getPatientInfo($patientId) {
        // Récupérer les informations de la table 'users'
        $query1 = $this->bdd->prepare('SELECT Nom_user, prenom_user, sexe, adresse_mail FROM users WHERE id_user = :id');
        $query1->bindParam(':id', $patientId, PDO::PARAM_INT);
        $query1->execute();
        $userInfo = $query1->fetch(PDO::FETCH_ASSOC);

        // Récupérer les informations de la table 'patients'
        $query2 = $this->bdd->prepare('SELECT date_naissance, profession, situation_familial, num_sec, adresse_postal, CP, Ville, Pays, num_tel, type_assurance, contacte_cas_urgence, MedecinTraitant, langue_parler, telephone_cas_urgence FROM patients WHERE id_user = :id');
        $query2->bindParam(':id', $patientId, PDO::PARAM_INT);
        $query2->execute();
        $patientInfo = $query2->fetch(PDO::FETCH_ASSOC);

        // Combiner les résultats des deux requêtes
        if ($userInfo && $patientInfo) {
            return array_merge($userInfo, $patientInfo);
        } elseif ($userInfo) {
            return $userInfo;
        } elseif ($patientInfo) {
            return $patientInfo;
        }

        return false; // ou null, selon votre logique d'erreur
    }

    
    public function updatePatientInfo($patientId, $patientData) {
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
    
        // Vérifiez si la mise à jour a réussi et retournez true ou false en conséquence
        return $query->rowCount() > 0;



        // Préparez votre requête SQL pour mettre à jour les informations du patient
        $query = $this->bdd->prepare('UPDATE patients SET date_naissance = ?, adresse_postal = ?, CP = ?, Ville = ?, Pays = ?, profession = ?, situation_familial = ?, num_tel = ?, langue_parler = ?, num_sec = ?, type_assurance = ?, MedecinTraitant = ?, contacte_cas_urgence = ?, telephone_cas_urgence = ?, lien_cas_urgence = ? WHERE id_user = ?');
        
        // Bind les valeurs
        $query->execute([
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
        return $query->rowCount() > 0;
    }
    
    

}
?>
