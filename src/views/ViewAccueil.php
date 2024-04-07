<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Interface de Gestion des Patients</title>
    <link rel="stylesheet" href="static/css/styles.css">
</head>
<body>

<div class="navbar">
    <a href="#home">Accueil</a>
    <a href="#nursing"></a>
    <a href="#patient">Patient</a>
    <!-- Ajoutez d'autres liens de navigation si nécessaire -->
</div>

<div class="main-header">
    <h2>Bienvenue Ilias EZAROUALI</h2>
    <!-- Formulaires et autres éléments d'interface utilisateur -->
</div>

<div class="search-container">
    <form action="/path-to-your-script.php" method="post">
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
                <label for="idNat">N° secrurité social</label>
                <input type="text" id="idNat" name="idNat">
            </div>
        </div>

        <div class="row">
            <div class="column">
                <label for="patientId">Patient ID</label>
                <input type="text" id="patientId" name="patientId">
            </div>
            <div class="column">
                <label for="province">Province</label>
                <select id="province" name="province">
                    <option value="">Sélectionner...</option>
                    <!-- Options de la province ici -->
                </select>
            </div>
            <div class="column">
                <label for="patientId">service</label>
                <input type="text" id="patientId" name="patientId">
            </div>
            
        </div>
        
        <div class="center-buttons"> 
            <button type="button">Chercher</button>
            <button type="button">Vider</button>  
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
    <tr>
        <td>9966</td>
        <td>VERBEKE, FRANK</td>
        <td>23/08/1963</td>
        <td>F</td>
        <td>HOSPITALISATION CHIRURGIE</td>
        <td>Diagnostique Exemple</td>
    </tr>

    <?php foreach($patients as $patient): ?>
        <tr>
            <td><?= $patient->id() ?> test</td>
            <td><?= $patient->nom() ?> </td>
            <td><?= $patient->dateNaissance() ?></td>
            <td><?= $patient->sexe() ?></td>
            <td></td>
            <td></td>
        </tr>
    <?php endforeach; ?>
    <!-- Ajoutez d'autres lignes de données codées en dur si nécessaire -->
</table>

<?php foreach($patients as $patient): ?>
        
           <?= $patient->id() ?> 
           <?= $patient->nom() ?> 
           <?= $patient->dateNaissance() ?>
           <?= $patient->sexe() ?>
        
    <?php endforeach; ?>
</body>
</html>