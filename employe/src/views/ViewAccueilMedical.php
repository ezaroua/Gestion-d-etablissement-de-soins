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
        <h2>Bienvenue <?= $_SESSION['prenom'] ?> <?= $_SESSION['nom'] ?></h2>
    </div>

    <div class="search-container">
        <form id="patientForm" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
            <div class="row">
                <div class="column">
                    <label for="nom">Nom</label><br />
                    <input type="text" id="nom" name="nom">
                </div>
                <div class="column">
                    <label for="prenom">Prénom</label><br />
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
    <?php
    if (count($tab_patient) < 1) {
        echo "Aucun patient trouvé<br/>";
    }
    ?>
    <table class="tab_accueil">
        <tr>
            <th>ID Personne</th>
            <th>Patient</th>
            <th>Date de naissance</th>
            <th>Sexe</th>
            <th>N° securité sociale</th>
            <th>Medecin traitant</th>
            <th>Information Patient</th>
            <th>Compte rendu</th>
        </tr>
        <tbody>
            <?php
            if (count($tab_patient) > 0) {
                foreach ($tab_patient as $element) {
                    echo "<tr class='tr_accueil'>";
                    echo "<td>" . (isset($element[3]) ? htmlspecialchars($element[3]) : "") . "</td>";
                    echo "<td>" . (isset($element[1]) ? htmlspecialchars($element[1]) : "") . " " . (isset($element[2]) ? htmlspecialchars($element[2]) : "") . "</td>";
                    echo "<td>" . (isset($element[4]) ? htmlspecialchars($element[4]) : "") . "</td>";
                    echo "<td>" . (isset($element[5]) ? htmlspecialchars($element[5]) : "") . "</td>";
                    echo "<td>" . (isset($element[0]) ? htmlspecialchars($element[0]) : "") . "</td>";
                    echo "<td>" . (isset($element[6]) ? htmlspecialchars($element[6]) : "") . "</td>";
                    echo "<td class='bout_tab'>
                        <button type='button' onclick='window.location.href=\"" . $_SERVER['REQUEST_URI'] . "&id_user=" . (isset($element[3]) ? $element[3] : "") . "\";'>Info Patient</button>
                    </td>";
                    echo "<td class='bout_tab'>
                        <button type='button' onclick='window.location.href=\"?url=SuiviMedical&patientId=" .  (isset($element[3]) ? htmlspecialchars($element[3]) : "") . "\";'>Compte Rendu</button>
                    </td>";
                    echo "</tr>";
                }
            }
            ?>

        </tbody>

    </table>


</body>

</html>