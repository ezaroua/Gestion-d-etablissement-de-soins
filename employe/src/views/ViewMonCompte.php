<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Mon compte</title>
    <link rel="stylesheet" href="static/css/styles.css">
</head>

<body class="patient">

    <div class="navbar">
        <a href="?url=Accueil">ACCUEIL</a>
        <a href="?url=CreationPatient">PATIENT</a>
        <a href="?url=GestionDemandes">DEMANDES</a>
        <div class="dropdown">
            <button class="dropbtn"><img src="static/image/user-icon.png" alt="User"></button>
            <div class="dropdown-content">
                <a href="?url=MonCompte">Mon compte</a>
                <a href="?url=ModificationPassword">Changer mon mot de passe</a>
                <a href="?url=Deconnexion">Déconnexion</a>
            </div>
        </div>
    </div>


    <div class="main-header">
        <h2>Mes informations personnelles</h2>
    </div>

    <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="post">
        <div class="search-container create_patient">
            <fieldset>
                <div>
                    <label for="prenom">Prénom :</label>
                    <input type="text" id="prenom" name="prenom" value="<?php echo htmlspecialchars($userInfo['prenom_user']); ?>" readonly>
                </div>
                <div>
                    <label for="nom">Nom :</label>
                    <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($userInfo['Nom_user']); ?>" readonly>
                </div>
                <div>
                    <label for="mail">Email :</label>
                    <input type="text" id="mail" name="mail" value="<?php echo htmlspecialchars($userInfo['adresse_mail']); ?>" readonly>
                </div>
                <div>
                    <label for="sexe">Sexe :</label>
                    <input type="text" id="mail" name="mail" value="<?php if ($userInfo['sexe'] == 'M') echo 'Masculin' ; else echo 'Féminin'; ?>" readonly>
                </div>
                <div>
                    <label for="date_embauche">Date embauche :</label>
                    <input type="text" id="date_embauche" name="date_embauche" value="<?php echo htmlspecialchars($userInfo['date_embauche']); ?>" readonly>
                </div>
                <div>
                    <label for="contrat">Type de contrat :</label>
                    <input type="text" id="mail" name="mail" value="<?php echo htmlspecialchars($userInfo['type_contrat']) ; ?>" readonly>
                </div>
                <div>
                    <label for="date_debut">Date de début de contrat :</label>
                    <input type="text" id="date_debut" name="date_debut" value="<?php echo htmlspecialchars($userInfo['date_debut_contrat']); ?>" readonly>
                </div>
                <div>
                    <label for="date_fin">Date de fin de contrat :</label>
                    <input type="text" id="date_fin" name="date_fin" value="<?php echo htmlspecialchars($userInfo['date_fin_contrat']); ?>" readonly>
                </div>
                <div>
                    <label for="poste">Poste :</label>
                    <input type="text" id="mail" name="mail" value="<?php if ($userInfo['poste'] == 'employe') echo 'Employé' ; else echo 'Chef de Service'; ?>" readonly>
                </div>
            </fieldset>
        </div>
    </form>
</body>

</html>
