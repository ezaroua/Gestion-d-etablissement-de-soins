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
        <h2>Bienvenue Ilias EZAROUALI</h2>
    </div>

    <div class="search-container">
        <form id="patientForm" method="post" action="index.php?action=search">
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
                    <input type="text" id="dateNaissance" name="dateNaissance">
                </div>
                <div class="column">
                    <label for="num_sec">N° sécurité sociale</label>
                    <input type="text" id="num_sec" name="num_sec">
                </div>
            </div>
            <div class="center-buttons">
                <button type="submit">Chercher</button>
                <button type="button" onclick="window.location.href='https://www.example.com';">Réinitialiser</button>
            </div>
        </form>
    </div>

    <table>
        <tr>
            <th>ID Personne</th>
            <th>Patient</th>
            <th>Date de naissance</th>
            <th>Sexe</th>
            <th>N° securité sociale</th>
            <th>Medecin traitant</th>

        </tr>
        <tbody>
            <tr>
                <td>01</td>
                <td>01</td>
                <td>01</td>
                <td>01</td>
                <td>01</td>
                <td>01</td>
            </tr>
            <tr>
                <td>02</td>
                <td>02</td>
                <td>02</td>
                <td>02</td>
                <td>02</td>
                <td>02</td>
            </tr>
        </tbody>

    </table>

    <script src="static/js/script.js"></script>

</body>

</html>