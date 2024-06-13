<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Interface de Gestion des Patients</title>
    <link rel="stylesheet" href="static/css/styles_medical.css">
    <style>

    </style>
</head>

<body>
    <div class="navbar">
        <a href="?url=AccueilMedical">ACCUEIL</a>
        <?php
        if ($_SESSION['poste'] == "Chef Service") {
            echo "<a href='?url=CreationEmploye'>AJOUT EMPLOYE</a>";
        }
        ?>
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
        <h2>Information de <?= $tab_patient[1] ?> <?= $tab_patient[2] ?></h2>
    </div>
    <div class="countaineur">
        <div>
            <div class="info">
                <label for="nom">Nom :</label>
                <span id="nom"><?= $tab_patient[2] ?></span>
            </div>
            <div class="info">
                <label for="prenom">Prénom :</label>
                <span id="prenom"><?= $tab_patient[1] ?></span>
            </div>
            <div class="info">
                <label for="date-naissance">Date de Naissance :</label>
                <span id="date-naissance"><?= $tab_patient[4] ?></span>
            </div>
            <div class="info">
                <label for="adresse">Adresse :</label>
                <span id="adresse"><?= $tab_patient[10] ?>, <?= $tab_patient[11] ?>, <?= $tab_patient[12] ?></span>
            </div>
            <div class="info">
                <label for="email">Email :</label>
                <span id="email"><?= $tab_patient[7] ?></span>
            </div>
            <div class="info">
                <label for="telephone">Téléphone :</label>
                <span id="telephone"><?= $tab_patient[14] ?></span>
            </div>
        </div>
        <div>
            <div class="info">
                <label for="telephone">Profession :</label>
                <span id="telephone"><?= $tab_patient[8] ?></span>
            </div>
            <div class="info">
                <label for="telephone">Situation :</label>
                <span id="telephone"><?= $tab_patient[9] ?></span>
            </div>
            <div class="info">
                <label for="telephone">Langue parlées:</label>
                <span id="telephone"><?= $tab_patient[16] ?></span>
            </div>
        </div>
        <div>
            <div class="info">
                <label for="telephone">Numéro de sécurité sociale :</label>
                <span id="telephone"><?= $tab_patient[0] ?></span>
            </div>
            <div class="info">
                <label for="telephone">Médecin traitant :</label>
                <span id="telephone"><?= $tab_patient[6] ?></span>
            </div>
            <div class="info">
                <label for="telephone">Type d'assurance :</label>
                <span id="telephone"><?= $tab_patient[15] ?></span>
            </div>
            <hr />
            <div class="info">
                <label for="telephone">Personne à contacter en cas d'urgence :</label>
                <span id="telephone"><?= $tab_patient[17] ?></span>
            </div>
            <div class="info">
                <label for="telephone">Téléphone de la personne :</label>
                <span id="telephone"><?= $tab_patient[18] ?></span>
            </div>
            <div class="info">
                <label for="telephone">Lien de la personne :</label>
                <span id="telephone"><?= $tab_patient[19] ?></span>
            </div>
        </div>
    </div>