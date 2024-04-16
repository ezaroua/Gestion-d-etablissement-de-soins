<?php

if (isset($_POST['creer'])) {
    //premier fieldset
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $login = $nom . $prenom;
    $email = htmlspecialchars($_POST['mail']);
    $sexe = htmlspecialchars($_POST['sexe']);

    $mdp = "1234";

    $mdp_user = password_hash($mdp, PASSWORD_DEFAULT);

    //deuxieme
    $date_naissance = htmlspecialchars($_POST['date_naissance']);
    $profession = htmlspecialchars($_POST['profession']);
    $situation_familiale = htmlspecialchars($_POST['situation_familiale']);
    $adresse = htmlspecialchars($_POST['adresse_postale']);
    $tel = htmlspecialchars($_POST['numero_telephone']);
    $langue = htmlspecialchars($_POST['langue_parlee']);

    //troisieme
    $num_secu = htmlspecialchars($_POST['numero_secu']);
    $assurance = htmlspecialchars($_POST['type_assurance']);
    $medecin_traitant = htmlspecialchars($_POST['medecin_traitant']);

    //quatrieme
    $personne_urgence = htmlspecialchars($_POST['personne_urgence']);

    //attention à login qui a un comportement bizzare
    $stmt = $_bdd->prepare("INSERT INTO users (Nom_user, prenom_user, sexe, adresse_mail, login, mot_de_passe_hash) VALUES (?, ?, ?, ?, ?, ?)");

    $stmt->bindParam(1, $nom);
    $stmt->bindParam(2, $prenom);
    $stmt->bindParam(3, $sexe);
    $stmt->bindParam(4, $email);
    $stmt->bindParam(5, $login);
    $stmt->bindParam(6, $mdp_user);

    try {
        $stmt->execute();
        $dernier_id = $_bdd->lastInsertId();
        echo "Enregistrement effectué avec succès. dernier id : " . $dernier_id;

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
    } catch (PDOException $e) {
        echo "Erreur lors de l'exécution de la requête : " . $e->getMessage();
    }
}
