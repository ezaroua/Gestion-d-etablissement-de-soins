<?php
function insererUser($nom, $prenom, $email, $sexe, $_bdd)
{

    $login = $nom . $prenom;
    $mdp = "1234";

    $mdp_user = password_hash($mdp, PASSWORD_DEFAULT);

    $stmt = $_bdd->prepare("INSERT INTO users (Nom_user, prenom_user, sexe, adresse_mail, login, mot_de_passe_hash) VALUES (?, ?, ?, ?, ?, ?)");

    $stmt->bindParam(1, $nom);
    $stmt->bindParam(2, $prenom);
    $stmt->bindParam(3, $sexe);
    $stmt->bindParam(4, $email);
    $stmt->bindParam(5, $login);
    $stmt->bindParam(6, $mdp_user);

    try {
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Erreur lors de l'exécution de la requête : " . $e->getMessage();
    }
}

function insererPatient($date_naissance, $profession, $situation_familiale, $adresse, $tel, $langue, $num_secu, $assurance, $medecin_traitant, $personne_urgence, $_bdd)
{
    try {
        $dernier_id = $_bdd->lastInsertId();
    } catch (PDOException $e) {
        echo "Erreur lors de l'exécution de la requête : " . $e->getMessage();
    }

    $stmt2 = $_bdd->prepare("INSERT INTO patients(id_user, date_naissance, profession, situation_familial, num_sec, adresse_postal, num_tel, type_assurance, contacte_cas_urgence, MedecinTraitant, langue_parler) VALUES (?,?,?,?,?,?,?,?,?,?,?)");

    $stmt2->bindParam(1, $dernier_id);
    $stmt2->bindParam(2, $date_naissance);
    $stmt2->bindParam(3, $profession);
    $stmt2->bindParam(4, $situation_familiale);
    $stmt2->bindParam(5, $num_secu);
    $stmt2->bindParam(6, $adresse);
    $stmt2->bindParam(7, $tel);
    $stmt2->bindParam(8, $assurance);
    $stmt2->bindParam(9, $personne_urgence);
    $stmt2->bindParam(10, $medecin_traitant);
    $stmt2->bindParam(11, $langue);

    try {
        $stmt2->execute();
        echo "<script>alert('Patient créé!');
    document.location.href='Router.php';
    </script>";
    } catch (PDOException $e) {
        echo "Erreur lors de l'exécution de la requête : " . $e->getMessage();
    }
}
