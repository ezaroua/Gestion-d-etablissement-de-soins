<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Interface de Gestion des Patients</title>
    <link rel="stylesheet" href="static/css/styles.css">
    <style>

    </style>
</head>

<body>
    <div class="navbar">
        <a href="?url=Accueil">ACCUEIL</a>
        <div class="dropdown">
            <button class="dropbtn"><img src="static/image/user-icon.png" alt="User"></button>
            <div class="dropdown-content">
                <a href="#">Mon compte</a>
                <a href="?url=ModificationPassword">Changer mon mot de passe</a>
                <a href="#">Déconnexion</a>
            </div>
        </div>
    </div>

    <div class="main-header">
        <h2>Bienvenue <?= $_SESSION['prenom'] ?> <?= $_SESSION['nom'] ?></h2>
    </div>

    <div class="search-container">
        <form id="patientForm" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
            <div class="row">
                <div class="column">
                    <label for="nom">Nom</label>
                    <input type="text" id="nom" name="nom">
                </div>
                <div class="column">
                    <label for="prenom">Prénom</label>
                    <input type="text" id="prenom" name="prenom">
                </div>
                <div class="column">
                    <label for="dateNaissance">Date de naissance</label>
                    <input type="date" id="dateNaissance" name="dateNaissance">
                </div>
                <div class="column">
                    <label for="num_sec">N° sécurité sociale</label>
                    <input type="text" id="num_sec" name="num_sec">
                </div>
            </div>
            <div class="center-buttons">
                <button type="submit" name="chercher">Chercher</button>
                <button type="button" onclick="window.location.href='<?php echo $_SERVER['REQUEST_URI']; ?>';">Réinitialiser</button>
            </div>
        </form>
    </div>

    <table class="tab_accueil">
        <tr>
            <th>ID Personne</th>
            <th>Patient</th>
            <th>Date de naissance</th>
            <th>Sexe</th>
            <th>N° securité sociale</th>
            <th>Medecin traitant</th>

        </tr>
        <tbody>
            <?php
            foreach ($tab_patient as $element) {
                echo "<tr onclick=\"redirectTo('page1.html')\" class='tr_accueil'>
                    <td>" . $element[3] . "</td>
                    <td>" . $element[1] . " " . $element[2] . "</td>
                    <td>" . $element[4] . "</td>
                    <td>" . $element[5] . "</td>
                    <td>" . $element[0] . "</td>
                    <td>" . $element[6] . "</td>
                </tr>";
            }
            ?>
        </tbody>

    </table>

    <script src="static/js/script.js"></script>

</body>

</html>