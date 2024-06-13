<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Changer le mot de passe</title>
    <link rel="stylesheet" href="static/css/styles.css">
</head>
<body>

    <div class="navbar">

        <?php 
        if ($_SESSION['id_service'] <> 1 ) {
                echo '<a href="?url=AccueilMedical">ACCUEIL</a>';
            } else {
                echo '<a href="?url=Accueil">ACCUEIL</a>';
            }
            ?>


        <?php
        if ($_SESSION['id_service'] == 1 ) {
            echo "<a href='?url=CreationPatient'>PATIENT</a>";
        }
        ?>



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
        <h2>Changer le mot de passe</h2>
    </div>

    <div class="change-password-container">
        <form id="changePasswordForm" method="post" action="?url=ModificationPassword">
            <div class="form-group">
                <label for="currentPassword">Mot de passe actuel</label>
                <input type="password" id="currentPassword" name="currentPassword" required>
            </div>
            <div class="form-group">
                <label for="newPassword">Nouveau mot de passe</label>
                <input type="password" id="newPassword" name="newPassword" required>
            </div>
            <div class="form-group">
                <label for="confirmNewPassword">Confirmer le nouveau mot de passe</label>
                <input type="password" id="confirmNewPassword" name="confirmNewPassword" required>
            </div>
            <div class="center-buttons">
                <button type="submit">Changer</button>
                <button type="button" id="cancelButton" onclick="window.history.back();">Annuler</button>
            </div>
        </form>
    </div>

    <script src="static/js/script.js"></script>
</body>
</html>
