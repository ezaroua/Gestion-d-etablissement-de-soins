<?php
session_start();

if (isset($_POST['Envoyer'])) {
    // Connexion à la base de données
    #require_once "connexion_base.php";
    try {
        $bdd = new PDO ('mysql:host=localhost;dbname=db_administrative_patient;','root','');
        $bdd -> setAttribute (PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $bdd -> exec("set character set utf8");
    } catch (exception $e) {
        die ('Erreur:'.$e -> getMessage());
    }

    // Récupération des données du formulaire
    $login = htmlspecialchars($_POST['login']); // Pour éviter les injections XSS
    $mdp = htmlspecialchars($_POST['password']);

    // Requête de connexion : contrôle du login et récupération du mdp hash
    $sql_user = "SELECT * FROM users WHERE login = :login";
    $req1 = $bdd->prepare($sql_user);
    $req1->bindParam(':login', $login);
    $req1->execute();

    // Si la recherche dans la table users trouve un résultat
    if ($req1->rowCount() > 0) {
        $ValReq1 = $req1->fetch();

        // Vérification du login
        if ($ValReq1['login'] == $login && password_verify($mdp, $ValReq1['mot_de_passe_hash'])) {   #
            // Ouverture de session
            $_SESSION['login'] = intval($ValReq1['login']);

            // Requête pour rechercher dans la table patient
            $sql_patient = "SELECT p.* FROM patients p
                            JOIN users u ON p.id_user = u.id_user
                            WHERE u.login = :login";
            $req2 = $bdd->prepare($sql_patient);
            $req2->bindParam(':login', $login);
            $req2->execute();

            // Si la recherche dans la table patient trouve un résultat
            if ($req2->rowCount() > 0) {
                $_SESSION['statut'] = "Patient";
                header('Location: ./../views/ViewAccueil.php');
                exit();
            } else {
                // Si pas employé, déconnexion et redirection vers la page de connexion
                $error = "Trouvé dans la table USER mais pas dans la table PATIENT";
            }
        } else {
            // Mauvais mot de passe
            $error = "Le login ou le mot de passe est incorrect.";
        }
    } else {
        // Utilisateur introuvable
        $error = "User introuvable dans la table.";
    }
} else {
    // Formulaire non remplis
    $error = "Formulaire non remplis";
}

// Affichage des erreurs
if (isset($error)) {
    session_destroy();
    echo "<script language='Javascript'>alert('$error')</script>";
    header('Refresh: 0.1; ./../views/ViewConnexionPatient.php');
    exit();
}
?>
