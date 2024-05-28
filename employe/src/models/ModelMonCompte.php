<?php

require 'Database.php';

class ModelMonCompte {
    private $bdd;

    public function __construct($bdd)
    {
        $this->bdd = $bdd;
    }

    public function getUserInfo($userId) {
        // Récupérer les informations de la table 'users'
        $query1 = $this->bdd->prepare('SELECT Nom_user, prenom_user, sexe, adresse_mail FROM users WHERE id_user = :id');
        $query1->bindParam(':id', $userId, PDO::PARAM_INT);
        $query1->execute();
        $userInfo = $query1->fetch(PDO::FETCH_ASSOC);

        // Récupérer les informations de la table 'employes'
        $query2 = $this->bdd->prepare('SELECT poste, date_embauche, type_contrat, date_debut_contrat, date_fin_contrat FROM employes WHERE id_user = :id');
        $query2->bindParam(':id', $userId, PDO::PARAM_INT);
        $query2->execute();
        $employeeInfo = $query2->fetch(PDO::FETCH_ASSOC);

        // Combiner les résultats des deux requêtes
        if ($userInfo && $employeeInfo) {
            return array_merge($userInfo, $employeeInfo);
        } elseif ($userInfo) {
            return $userInfo;
        } elseif ($employeeInfo) {
            return $employeeInfo;
        }

        return false; // ou null, selon votre logique d'erreur
    }
}
?>
