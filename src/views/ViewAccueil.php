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
        <a href="#ViewCreationPatient.php">Patient</a>
        <!--TODO: Ajoutez d'autres liens de navigation-->
    </div>

    <div class="main-header">
        <h2>Bienvenue Ilias EZAROUALI</h2>
    </div>

    <div class="search-container">
        <form id="patientForm" method="post">
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

        <?php foreach($patients as $patient): ?>
            <tr>
                <td><?= $patient->id_user() ?></td>
                <td><?= $patient->nom(). ' ' .$patient->prenom()?> </td>
                <td><?= $patient->date_naissance() ?></td>
                <td><?= $patient->sexe() ?></td>
                <td><?= $patient->num_sec() ?></td>
                <td><?= $patient->MedecinTraitant() ?></td>
            </tr>
        <?php endforeach; ?>

    </table>

    <script src="static/js/script.js"></script>

</body>
</html>