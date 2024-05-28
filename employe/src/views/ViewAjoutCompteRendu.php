<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['mail'])) {
    header('Location: ?url=ConnexionEmploye');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Compte Rendu</title>
    <link rel="stylesheet" href="static/css/styles.css">
    <!-- Inclure le fichier JavaScript de CKEditor -->
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            font-family: Arial, sans-serif;
        }

        .navbar {
            background-color: #003366;
            overflow: hidden;
            color: white;
            padding: 14px 20px;
        }

        .navbar a, .dropdown-content a {
            float: left;
            color: white;
            text-align: center;
            padding: 12px;
            text-decoration: none;
            font-size: 17px;
        }

        .dropdown {
            float: right;
        }

        .dropdown .dropbtn {
            cursor: pointer;
            border: none;
            outline: none;
            background-color: inherit;
            font-family: inherit;
            margin: 0;
            padding: 0;
        }

        .dropdown .dropbtn img {
            height: 32px;
            vertical-align: middle;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            right: 0;
        }

        .dropdown-content a {
            float: none;
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
            font-size: 16px; 
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .main-header {
            background-color: #f2f2f2;
            padding: 20px;
            text-align: center;
        }

        .compte-rendu-container {
            padding: 20px;
            padding-bottom: 200px; 
            height: calc(100% - 120px);
        }

        .compte-rendu-container form {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .column {
            flex: 1;
            padding: 0 5px;
        }

        .column label {
            display: block;
            margin-bottom: 5px;
        }
        .input-motif {
            width: 70%; 
            padding: 8px;
            box-sizing: border-box;
        }
        .input-date {
            width: 15%; 
            padding: 8px;
            box-sizing: border-box;
        }


        .center-buttons {
            text-align: center;
            margin-top: 10px;
        }

        .editor-container {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        #compteRendu {
            flex: 1;
            height: 100%;
        }
    </style>
</head>
<body>
<div class="navbar">
        <a href="?url=AccueilMedical">ACCUEIL</a>
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
        <h2>Ajouter un Compte Rendu pour <?= htmlspecialchars($patientId) ?></h2>
    </div>
    <div class="compte-rendu-container">
        <form id="compteRenduForm" method="post" action="?url=SaveCompteRendu">
            <input type="hidden" name="patientId" value="<?= htmlspecialchars($patientId) ?>">
            <div class="row">
                <div class="column">
                    <label for="date">Date</label>
                    <input type="date" id="date" name="date" class="input-date" required>
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <label for="motif">Motif de consultation</label>
                    <input type="text" id="motif" name="motif" class="input-motif" required>
                </div>
            </div>
            <div class="row editor-container">
                <div class="column">
                    <label for="compteRendu">Compte Rendu</label>
                    <textarea id="compteRendu" name="compteRendu" required></textarea>
                </div>
            </div>
            <div class="center-buttons">
                <button type="submit">Enregistrer</button>
                <button type="reset">Annuler</button>
            </div>
        </form>
    </div>
    <script>
        // Initialiser CKEditor sur le champ de texte
        CKEDITOR.replace('compteRendu', {
            height: 'calc(100vh - 300px)' // Ajuster la hauteur de l'éditeur pour qu'il prenne toute la page
        });
    </script>
</body>
</html>
