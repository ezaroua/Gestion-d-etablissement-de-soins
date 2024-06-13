<?php

require 'Database.php'; // Inclure le fichier de connexion à la base de données
class ModeleCreationEmploye
{
    protected function getBdd()
    {
        return Database::getBdd();
    }

    public function insererUser($nom, $prenom, $email, $sexe)
    {
        $mdp = "1234";

        $mdp_user = password_hash($mdp, PASSWORD_DEFAULT);

        $stmt = $this->getBdd()->prepare("INSERT INTO users (Nom_user, prenom_user, sexe, adresse_mail, mot_de_passe_hash) VALUES (?, ?, ?, ?, ?)");

        $stmt->bindParam(1, $nom);
        $stmt->bindParam(2, $prenom);
        $stmt->bindParam(3, $sexe);
        $stmt->bindParam(4, $email);
        $stmt->bindParam(5, $mdp_user);

        try {
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Erreur lors de l'exécution de la requête : " . $e->getMessage();
        }
    }

    public function insererEmploye($poste, $date_embauche, $type_contrat, $date_debut, $date_fin, $service)
    {
        try {
            $dernier_id = $this->getBdd()->lastInsertId();
        } catch (PDOException $e) {
            echo "Erreur lors de l'exécution de la requête : " . $e->getMessage();
        }

        $stmt2 = $this->getBdd()->prepare("INSERT INTO employes(id_user, poste, date_embauche, type_contrat, date_debut_contrat, date_fin_contrat, id_service) VALUES (?, ?, ?, ?, ?, ?, ?)");

        $stmt2->bindParam(1, $dernier_id);
        $stmt2->bindParam(2, $poste);
        $stmt2->bindParam(3, $date_embauche);
        $stmt2->bindParam(4, $type_contrat);
        $stmt2->bindParam(5, $date_debut);
        $stmt2->bindParam(6, $date_fin);
        $stmt2->bindParam(7, $service);

        try {
            $stmt2->execute();
            if ($_SESSION['id_service'] == 1) {
                echo "<script>alert('Employé ajouté!');
        document.location.href='?url=Accueil';
        </script>";
            } else {
                echo "<script>alert('Employé ajouté!');
        document.location.href='?url=AccueilMedical';
        </script>";
            }
        } catch (PDOException $e) {
            echo "Erreur lors de l'exécution de la requête : " . $e->getMessage();
        }
    }
}
