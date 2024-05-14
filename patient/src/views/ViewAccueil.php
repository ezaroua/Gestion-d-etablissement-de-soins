<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Accueil Patients</title>
    <link rel="stylesheet" href="static/css/styles.css">
</head>

<body>
    <div class="navbar">
        <a href="#home">ACCUEIL</a>
        <a href="#nursing"></a>
        <!--TODO: Ajoutez d'autres liens de navigation-->
    </div>

    <div class="main-header">
        <h2>Bienvenue Ilias EZAROUALI</h2>
    </div>

    <div class="search-container">
        <form id="patientForm" method="post" action="index.php?action=search">
            <div class="row">
                <div class="column">
                    <label for="annee">Année</label>
                    <input type="number" id="annee" name="annee">
                </div>
                <div class="column">
                    <label for="mois">Mois</label>
                    <input type="number" id="mois" name="mois">
                </div>
                <div class="service">
                    <label for="service">Service</label>
                    <select id="service" name="service" required>
                        <option value="urgence">Urgence</option>
                    </select>
                </div>
            </div>

            <div class="center-buttons">
                <button type="submit">Chercher</button>
                <button type="button" id="clearButton">Vider</button>
            </div>
        </form>
    </div>
</body>