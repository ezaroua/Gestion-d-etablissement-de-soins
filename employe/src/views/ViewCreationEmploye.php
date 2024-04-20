<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Nouveau Employe</title>
    <link rel="stylesheet" href="static/css/styles.css">
</head>

<body class="patient">
    <div class="main-header">
        <h2>Création Employé</h2>
    </div>
    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
        <div class="search-container create_patient partie visible" id="partie1">
            <fieldset>
                <div>
                    <label for="prenom">Prénom :</label>
                    <input type="text" id="prenom" name="prenom" required>
                </div>
                <div>
                    <label for="nom">Nom :</label>
                    <input type="text" id="nom" name="nom" required>
                </div>
                <div>
                    <label for="mail">Email :</label>
                    <input type="email" id="mail" name="mail" required>
                </div>
                <div>
                    <label for="sexe">Sexe :</label>
                    <select id="sexe" name="sexe" required>
                        <option value="M">Masculin</option>
                        <option value="F">Féminin</option>
                    </select>
                </div>
                <div class="buttons-patient">
                    <button type="button" onclick="afficherPartie('partie2')">Suivant</button>
                </div>
            </fieldset>
        </div>
        <div class="search-container create_patient partie visible" id="partie2">
            <fieldset>
                <div>
                    <label for="date_embauche">Date embauche :</label>
                    <input type="date" id="date_embauche" name="date_embauche" required>
                </div>
                <div>
                    <label for="contrat">Type de contrat :</label>
                    <select id="contrat" name="contrat" required>
                        <option value="CDI">CDI</option>
                        <option value="CDD">CDD</option>
                        <option value="Stage">Stage</option>
                        <option value="Alternance">Alternance</option>
                        <option value="Interim">Interim</option>
                    </select>
                </div>
                <div>
                    <label for="date_debut">Date de début de contrat :</label>
                    <input type="date" id="date_debut" name="date_debut" required>
                </div>
                <div>
                    <label for="date_fin">Date de fin de contrat :</label>
                    <input type="date" id="date_fin" name="date_fin" required>
                </div>
                <div class="buttons-patient">
                    <button type="button" onclick="afficherPartie('partie1')">Retour</button>
                    <button type="button" onclick="afficherPartie('partie3')">Suivant</button>
                </div>
            </fieldset>
        </div>
        <div class="search-container create_patient partie visible" id="partie3">
            <fieldset>
                <div>
                    <label for="service">Service :</label>
                    <select id="service" name="service" required>
                        <option value="1">Urgence</option>
                        <option value="2">Radiographie</option>
                    </select>
                </div>
                <div class="buttons-patient">
                    <button type="button" onclick="afficherPartie('partie2')">Retour</button>
                </div>
            </fieldset>
            <div class="buttons-patient">
                <button type="submit" name="soumettre">Soumettre</button>
            </div>
        </div>
    </form>
</body>

</html>
<script src="static/js/script.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Cacher toutes les parties sauf la première au chargement de la page
        var parties = document.querySelectorAll('.partie');
        for (var i = 1; i < parties.length; i++) {
            parties[i].classList.remove('visible');
        }
    });
</script>