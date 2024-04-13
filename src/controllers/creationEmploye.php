<?php
try{
    $pdo=new PDO('mysql:host=localhost;dbname=hopital;charset=utf8','root', '');
}catch(Exception $e){
    echo "souscis de co";
}

if(isset($_POST['soumettre'])){
    $nom=htmlspecialchars($_POST['nom']);
    $prenom=htmlspecialchars($_POST['prenom']);
    $login=$nom.$prenom;
    $email=htmlspecialchars($_POST['mail']);
    $sexe=htmlspecialchars($_POST['sexe']);
    $date_embauche=htmlspecialchars($_POST['date_embauche']);
    $contrat=htmlspecialchars($_POST['contrat']);
    $service=htmlspecialchars($_POST['service']);
    $role=htmlspecialchars($_POST['role']);

    $mdp_user=password_hash(htmlspecialchars($_POST['mdp']), PASSWORD_DEFAULT);

    //attention à login qui a un comportement bizzare
    $stmt=$pdo->prepare("INSERT INTO users (Nom_user, prenom_user, sexe, adresse_mail, login_user, mor_de_passe_hash) VALUES (?, ?, ?, ?, ?, ?)");
    
    $stmt->bindParam(1, $nom);
    $stmt->bindParam(2, $prenom);
    $stmt->bindParam(3, $sexe);
    $stmt->bindParam(4, $email);
    $stmt->bindParam(5, $login);
    $stmt->bindParam(6, $mdp_user);

    try {
        $stmt->execute();
        $dernier_id = $pdo->lastInsertId();
        echo "Enregistrement effectué avec succès. dernier id : ".$dernier_id;

        //attention double nom, date debut/date fin/ poste
        $stmt2=$pdo->prepare("INSERT INTO employe(id_user, date_embauche, type_contrat, service_id, groupe_id) VALUES (?, ?, ?, ?, ?)");

        $stmt2->bindParam(1, $dernier_id);
        $stmt2->bindParam(2, $date_embauche);
        $stmt2->bindParam(3, $contrat);
        $stmt2->bindParam(4, $service);
        $stmt2->bindParam(5, $role);

        try{
            $stmt2->execute();
            echo "<br/>Tout est bon";
        }catch(PDOException $e) {
            echo "Erreur lors de l'exécution de la requête : " . $e->getMessage();
        }

    } catch(PDOException $e) {
        echo "Erreur lors de l'exécution de la requête : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de création</title>
</head>
<body>
    <h2>Formulaire de création</h2>
    <form action="creationEmploye.php" method="post">
        <fieldset>
            <div>
                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom" required>
            </div>
            <div>
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" required>
            </div>
            <div>
                <label for="mdp">Mot de passe :</label>
                <input type="password" id="mdp" name="mdp" required>
            </div>
            <div>
                <label for="mail">Email :</label>
                <input type="email" id="mail" name="mail" required>
            </div>
            <div>
                <label for="sexe">Sexe :</label>
                <select id="sexe" name="sexe" required>
                    <option value="M">Masculin</option>
                    <option value="F">Féminin</option>
                </select>
            </div>
        </fieldset>
        <fieldset>
            <div>
                <label for="date_embauche">Date embauche :</label>
                <input type="date" id="date_embauche" name="date_embauche" required>
            </div>
            <div>
                <label for="contrat">Type de contrat :</label>
                <select id="contrat" name="contrat" required>
                    <option value="CDI">CDI</option>
                    <option value="CDD">CDD</option>
                    <option value="Stage">Stage</option>
                    <option value="Alternance">Alternance</option>
                    <option value="Interim">Interim</option>
                </select>
            </div>
        </fieldset>
        <fieldset>
            <div>
                <label for="role">Rôle :</label>
                <select id="role" name="role" required>
                    <option value="1">Agent Médical</option>
                    <option value="2">Agent Administratif</option>
                </select>
            </div>
            <div>
                <label for="service">Service :</label>
                <select id="service" name="service" required>
                    <option value="1">Urgence</option>
                    <option value="2">Radiographie</option>
                </select>
            </div>
        </fieldset>
        <button type="submit" name="soumettre">Soumettre</button>
    </form>
</body>
</html>