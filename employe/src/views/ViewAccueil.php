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
        <a href="?url=CreationPatient">PATIENT</a>
        <a href="?url=GestionDemandes">DEMANDES</a>
        <div class="dropdown">
            <button class="dropbtn"><img src="static/image/user-icon.png" alt="User"></button>
            <div class="dropdown-content">
                <a href="#">Mon compte</a>
                <a href="?url=ModificationPassword">Changer mon mot de passe</a>
                <a href="ControllerDeconnexion.php">Déconnexion</a>
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
            <div class="row">
                <div class="column">
                    <label for="patientId">Patient ID</label>
                    <input type="text" id="patientId" name="patientId">
                </div>
                <div class="column">
                    <label for="province">Province</label>
                    <select id="province" name="province">
                    <option value="">Sélectionner...</option>
                    </select>
                </div>
                <div class="column">
                    <label for="service">service</label>
                    <input type="text" id="service" name="service">
                </div>

            </div>

            <div class="center-buttons">
                <button type="submit">Chercher</button>
                <button type="button" id="clearButton">Vider</button> 
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
        <?php if (!empty($patients)) : ?>
            <?php foreach ($patients as $patient) : ?>
                <tr class='clickable-row' data-id="<?= $patient->id_user() ?>">
                    <td><?= $patient->id_user() ?></td>
                    <td><?= $patient->nom() . ' ' . $patient->prenom() ?> </td>
                    <td><?= $patient->date_naissance() ?></td>
                    <td><?= $patient->sexe() ?></td>
                    <td><?= $patient->num_sec() ?></td>
                    <td><?= $patient->MedecinTraitant() ?></td>
                </tr>
            <?php endforeach; ?>



            <?php if (empty($patients)) : ?>
                <tr>
                    <td colspan="6">Aucun patient trouvé.</td>
                </tr>
            <?php endif; ?>

            <!-- <?php echo '<pre>';
                    print_r($patients);
                    echo '</pre>'; ?> -->

        <?php endif; ?>

    </table>

    <script src="static/js/script.js"></script>

</body>

</html>