<?php

require 'Database.php';
class ModelConnexionEmploye
{
    private $bdd;

    public function __construct($bdd)
    {
        $this->bdd = $bdd;
    }

    public function connexionEmploye($mail, $mdp)
    {
        $result = array();

        try {
            $sql_user = "SELECT * FROM users WHERE adresse_mail = :adresse_mail";
            $req1 = $this->bdd->prepare($sql_user); // Utilisez $this->bdd au lieu de $bdd
            $req1->bindParam(':adresse_mail', $mail);
            $req1->execute();

            if ($req1->rowCount() > 0) {
                $ValReq1 = $req1->fetch();

                if ($ValReq1['adresse_mail'] == $mail ) {   //&& password_verify($mdp, $ValReq1['mot_de_passe_hash'])
                    $sql_employe = "SELECT e.* FROM employes e
                                    JOIN users u ON e.id_user = u.id_user
                                    WHERE u.adresse_mail = :adresse_mail";
                    $req2 = $this->bdd->prepare($sql_employe); // Utilisez $this->bdd au lieu de $bdd
                    $req2->bindParam(':adresse_mail', $mail);
                    $req2->execute();

                    if ($req2->rowCount() > 0) {
                        $result['success'] = true;
<<<<<<< Updated upstream
                        $result['statut'] = "Employe";
=======
                        $result['nom'] = $ValReq2['Nom_user'];
                        $result['prenom'] = $ValReq2['prenom_user'];
                        $result['poste'] = $ValReq2['poste'];
                        $result['id_user'] = $ValReq2['id_user'];
                        $result['id_service'] = $ValReq2['id_service'];
>>>>>>> Stashed changes
                    } else {
                        $result['success'] = false;
                        $result['error'] = "Trouvé dans la table USER mais pas dans la table EMPLOYE";
                    }
                } else {
                    $result['success'] = false;
                    $result['error'] = "Le login ou le mot de passe est incorrect.";
                }
            } else {
                $result['success'] = false;
                $result['error'] = "User introuvable dans la table.";
            }
        } catch (Exception $e) {
            $result['success'] = false;
            $result['error'] = "Erreur : " . $e->getMessage();
        }

        return $result;
    }
}
?>
