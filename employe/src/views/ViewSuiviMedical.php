<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['mail'])) {
    header('Location: ?url=ConnexionEmploye');
    exit();
}

$patientId = $_GET['patientId'] ?? null;

if ($patientId) {
    // Logique pour récupérer et afficher les données de suivi médical pour le patient avec l'id $patientId
} else {
    echo 'Patient ID non fourni';
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Suivi Médical</title>
    <link rel="stylesheet" href="static/css/styles.css">
</head>
<body>
    <div class="navbar">
        <a href="?url=AccueilMedical">ACCUEIL</a>
        <div class="dropdown">
            <button class="dropbtn"><img src="static/image/user-icon.png" alt="User"></button>
            <div class="dropdown-content">
                <a href="#">Mon compte</a>
                <a href="?url=ModificationPassword">Changer mon mot de passe</a>
                <a href="?url=Deconnexion">Déconnexion</a>
            </div>
        </div>
    </div>
    <div class="main-header">
        <h2>Suivi Médical de <?= htmlspecialchars($patientId) ?></h2>
    </div>
    <div class="table-container">
        <table>
            <tr>
                <th>Date</th>
                <th>Motif de consultation </th>
                <th>Compte Rendu</th>
            </tr>
            <?php if (!empty($comptesRendus)) : ?>
                <?php foreach ($comptesRendus as $compteRendu) : ?>
                    <tr>
                        <td><?= htmlspecialchars($compteRendu->date) ?></td>
                        <td> </td>
                        <td><?= htmlspecialchars($compteRendu->compte_rendu) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="2">Aucun compte rendu trouvé.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
    <div class="center-buttons">
        <a href="?url=AjoutCompteRendu&patientId=<?= htmlspecialchars($patientId) ?>"><button>Ajouter un Compte Rendu</button></a>
    </div>
    <script src="static/js/script.js"></script>
</body>
</html>
