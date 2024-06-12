<?php

require 'Database.php'; // Inclure le fichier de connexion à la base de données
class ModeleCreationPatient
{

    protected function getBdd()
    {
        return Database::getBdd();
    }

    public function verifierNumeroSecu($numeroSecu)
    {
        $stmt = $this->getBdd()->prepare("SELECT * FROM patients WHERE num_sec=?");

        $stmt->bindParam(1, $numeroSecu);

        try {
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result === false) {
                // Aucune ligne trouvée, la fonction ne renvoie rien
                return true;
            } else {
                // Une ou plusieurs lignes trouvées, la fonction renvoie quelque chose
                echo "<script>alert('numéro de sécurité social déjà dans la base!');
        document.location.href='?url=CreationPatient';
        </script>";
            }
        } catch (PDOException $e) {
            echo "Erreur lors de l'exécution de la requête : " . $e->getMessage();
        }
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

    public function insererPatient($date_naissance, $profession, $situation_familiale, $adresse, $cp, $ville, $pays, $tel, $langue, $num_secu, $assurance, $medecin_traitant, $personne_urgence, $tel_cas_urgence, $lien_urgence)
    {
        try {
            $dernier_id = $this->getBdd()->lastInsertId();
        } catch (PDOException $e) {
            echo "Erreur lors de l'exécution de la requête : " . $e->getMessage();
        }

        $stmt2 = $this->getBdd()->prepare("INSERT INTO patients(id_user, date_naissance, profession, situation_familial, num_sec, adresse_postal, CP, Ville, Pays, num_tel, type_assurance, contacte_cas_urgence, telephone_cas_urgence, lien_cas_urgence, MedecinTraitant, langue_parler) VALUES (?,?,?,?,?,?,?,?,?,?,?, ?, ?, ?, ?, ?)");
        echo "<br/> $num_secu";
        $stmt2->bindParam(1, $dernier_id);
        $stmt2->bindParam(2, $date_naissance);
        $stmt2->bindParam(3, $profession);
        $stmt2->bindParam(4, $situation_familiale);
        $stmt2->bindParam(5, $num_secu);
        $stmt2->bindParam(6, $adresse);
        $stmt2->bindParam(7, $cp);
        $stmt2->bindParam(8, $ville);
        $stmt2->bindParam(9, $pays);
        $stmt2->bindParam(10, $tel);
        $stmt2->bindParam(11, $assurance);
        $stmt2->bindParam(12, $personne_urgence);
        $stmt2->bindParam(13, $tel_cas_urgence);
        $stmt2->bindParam(14, $lien_urgence);
        $stmt2->bindParam(15, $medecin_traitant);
        $stmt2->bindParam(16, $langue);

        try {
            $stmt2->execute();
            echo "<script>alert('Patient créé!');
        document.location.href='?url=Accueil';
        </script>";
        } catch (PDOException $e) {
            echo "Erreur lors de l'exécution de la requête : " . $e->getMessage();
        }
    }
}
