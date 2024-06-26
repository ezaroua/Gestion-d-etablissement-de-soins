<?php

require 'Database.php';

class ModelConnexionPatient
{
    private $bdd;

    public function __construct($bdd)
    {
        $this->bdd = $bdd;
    }

    public function connexionPatient($mail, $mdp)
    {
        $result = array();

        try {
            $sql_user = "SELECT * FROM users WHERE adresse_mail = :adresse_mail";
            $req1 = $this->bdd->prepare($sql_user);
            $req1->bindParam(':adresse_mail', $mail);
            $req1->execute();

            if ($req1->rowCount() > 0) {
                $ValReq1 = $req1->fetch();

                if ($ValReq1['adresse_mail'] == $mail && password_verify($mdp, $ValReq1['mot_de_passe_hash'])) {
                    $sql_patient = "SELECT p.*, u.Nom_user, u.prenom_user FROM patients p
                                    JOIN users u ON p.id_user = u.id_user
                                    WHERE u.adresse_mail = :adresse_mail";
                    $req2 = $this->bdd->prepare($sql_patient);
                    $req2->bindParam(':adresse_mail', $mail);
                    $req2->execute();

                    if ($req2->rowCount() > 0) {
                        $ValReq2 = $req2->fetch();
                        $result['success'] = true;

                        $result['statut'] = "Patient";
                        $result['nom'] = $ValReq2['Nom_user'];
                        $result['prenom'] = $ValReq2['prenom_user'];
                        $result['id_user'] = $ValReq2['id_user'];

                    } else {
                        $result['success'] = false;
                        $result['error'] = "Trouvé dans la table USER mais pas dans la table PATIENT";
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




