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
    <title>Suivi Médical</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
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

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #003366;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .search-container {
            background-color: #f3f3f3;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin: 20px 400px 50px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-group {
            margin-bottom: 10px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"], select {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .center-buttons {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            width: 100%;
            margin-top: 20px;
        }

        .center-buttons a {
            text-decoration: none;
            color: white;
            background-color: #28a745;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .center-buttons a:hover {
            background-color: #218838;
        }

        .filter-container {
            padding: 15px;
            border-radius: 5px;
            margin: 20px auto;
            width: 80%;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 300px;
            margin-top: 20px;
            height: 90px;
            border-top-width: 10px;
            padding-top: 20px;
            padding-bottom: 20px;   
            margin-left: 0px;
        }

        .filter-container form {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            width: 100%;
        }

        .filter-container label {
            margin-right: 10px;
            font-weight: bold;
        }

    </style>

    <script>
        function submitForm() {
            document.getElementById("serviceForm").submit();
        }
    </script>
</head>
<body>
    <div class="navbar">
        <a href="?url=AccueilMedical">ACCUEIL</a>
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
        <?php foreach ($comptesRendus as $compteRendu) : ?>
        <?php $nomPatient = isset($compteRendu['nom']) ? htmlspecialchars($compteRendu['nom']) . ' ' . htmlspecialchars($compteRendu['prenom']) : 'Nom inconnu';?>
        <?php endforeach; ?>

            
            <h2>Suivi Médical de <?=  htmlspecialchars(urldecode($_GET['nom'] ?? 'Nom non fourni')) ?></h2>
 
    </div>

    <div class="filter-container">
        <form action="" method="GET">
            <input type="hidden" name="url" value="SuiviMedical">
            <input type="hidden" name="patientId" value="<?= htmlspecialchars($patientId) ?>">
            <input type="hidden" name="nom" value="<?= htmlspecialchars($nom) ?>">
            <label for="service">Service :</label>
            <select name="service" id="service" onchange="this.form.submit()">
                <option value="">Choisir un service</option>
                <option value="cardiologie" <?= (isset($_GET['service']) && $_GET['service'] === 'cardiologie') ? 'selected' : '' ?>>Cardiologie</option>
                <option value="chirurgie" <?= (isset($_GET['service']) && $_GET['service'] === 'chirurgie') ? 'selected' : '' ?>>Chirurgie</option>
                <option value="radiologie" <?= (isset($_GET['service']) && $_GET['service'] === 'radiologie') ? 'selected' : '' ?>>Radiologie</option>
                <option value="urgences" <?= (isset($_GET['service']) && $_GET['service'] === 'urgences') ? 'selected' : '' ?>>Urgences</option>
            </select>
        </form>
    </div>

    <div class="table-container">
        <table>
            <tr>
                <th>Date</th>
                <th>Motif de consultation</th>
                <th> Nom du médecin </th>
                <th>Compte Rendu</th>
            </tr>
            <?php 
            if (!empty($comptesRendus)) : ?>
                <?php foreach ($comptesRendus as $compteRendu) : ?>
                    <tr>
                        <td><?= htmlspecialchars($compteRendu['date'] ?? '') ?></td>
                        <td><?= htmlspecialchars($compteRendu['motif'] ?? '') ?></td>
                        <td><?= htmlspecialchars($compteRendu['nom_medecin'] ?? '') ?></td>
                        <td><a href="?url=VoirCompteRendu&consultationId=<?= htmlspecialchars($compteRendu['consultation_id'] ?? '') ?>&patientId=<?= htmlspecialchars($patientId ?? '') ?>&service=<?= $compteRendu['service'] ?>">Voir Détails</a></td>
                    </tr>
                    
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="5">Aucun compte rendu trouvé.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>

    <div class="center-buttons">
        <a href="?url=AjoutCompteRendu&patientId=<?= htmlspecialchars($patientId) ?>&service=<?= $service?>&nom=<?= htmlspecialchars($nom)?>">Ajouter un compte rendu</a>
    </div>
    <script src="static/js/script.js"></script>
</body>
</html>
