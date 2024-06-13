<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Nouveau Patient</title>
    <link rel="stylesheet" href="static/css/styles.css">
</head>

<body class="patient">

    <div class="navbar">
        <a href="?url=Accueil">ACCUEIL</a>
        <a href="?url=CreationPatient">PATIENT</a>
        <?php
        if ($_SESSION['poste'] == "Chef Service") {
            echo "<a href='?url=CreationEmploye'>AJOUT EMPLOYE</a>";
        }
        ?>
        <a href="?url=GestionDemandes">DEMANDES</a>
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
        <h2>Nouveau Patient</h2>
        <!-- Formulaires et autres éléments d'interface utilisateur -->
    </div>
    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" name="formulaire_patient">
        <div class="search-container create_patient partie visible" id="partie1">
            <fieldset>
                <div>
                    <label for="prenom">Prénom* :</label>
                    <input type="text" id="prenom" name="prenom" required>
                </div>
                <div>
                    <label for="nom">Nom* :</label>
                    <input type="text" id="nom" name="nom" required>
                </div>
                <div>
                    <label for="mail">Email* :</label>
                    <input type="email" id="mail" name="mail" required>
                </div>
                <div>
                    <label for="sexe">Sexe* :</label>
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
                    <label for="date_naissance">Date de naissance* :</label>
                    <input type="date" id="date_naissance" name="date_naissance" required>
                </div>


                <div>
                    <label for="adresse_postale">Adresse postale* :</label>
                    <textarea id="adresse_postale" name="adresse_postale" rows="4" required></textarea>
                </div>

                <div>
                    <label for="cp">Code postal* :</label>
                    <input type="text" id="cp" name="cp" minlength="5" maxlength="5" required>
                </div>

                <div>
                    <label for="ville">Ville* :</label>
                    <input type="text" id="ville" name="ville" required>
                </div>

                <div>
                    <label for="pays">Pays* :</label>
                    <input type="text" id="pays" name="pays" required>
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
                    <label for="profession">Profession :</label>
                    <select id="profession" name="profession" required>
                        <option value="agriculteur">Agriculteur</option>
                        <option value="artisan">Artisan</option>
                        <option value="commercant">Commerçant</option>
                        <option value="chef_entreprise">Chef d'entreprise</option>
                        <option value="profession_liberale">Profession libérale</option>
                        <option value="cadre">Cadre</option>
                        <option value="profession_intermediaire">Profession Intermédiaire</option>
                        <option value="employe">Employé</option>
                        <option value="ouvrier">Ouvrier</option>
                        <option value="retraite">Retraité</option>
                        <option value="demandeur_emploi">Demandeur d'emploi</option>
                        <option value="etudiant">Etudiant</option>
                        <option value="autre">Autre</option>
                    </select>
                </div>

                <div>
                    <label for="situation_familiale">Situation familiale* :</label>
                    <select id="situation_familiale" name="situation_familiale" required>
                        <option value="marié">Marié(e)</option>
                        <option value="célibataire">Célibataire</option>
                        <option value="veuf">Veuf/Veuve</option>
                        <option value="concubinage">En concubinage</option>
                    </select>
                </div>

                <div>
                    <label for="numero_telephone">Numéro de téléphone* :</label>
                    <input type="tel" id="numero_telephone" name="numero_telephone" pattern="[0-9]{10}" required>
                </div>

                <div>
                    <label for="langue_parlee">Langue(s) parlée(s)* :</label>
                    <input type="text" id="langue_parlee" name="langue_parlee" required>
                </div>
                <div class="buttons-patient">
                    <button type="button" onclick="afficherPartie('partie2')">Retour</button>
                    <button type="button" onclick="afficherPartie('partie4')">Suivant</button>
                </div>
            </fieldset>
        </div>
        <div class="search-container create_patient partie visible" id="partie4">
            <fieldset>
                <div>
                    <label for="numero_secu">Numéro de sécurité sociale* :</label>
                    <input type="text" id="numero_secu" name="numero_secu" maxlength="15" required>
                </div>

                <div>
                    <label for="type_assurance">Type d'assurance* :</label>
                    <select id="type_assurance" name="type_assurance" required>
                        <option value="">Choisissez une option</option>
                        <option value="Assurance maladie">Assurance maladie</option>
                        <option value="Mutuelle">Mutuelle</option>
                        <option value="Assurance complémentaire">Assurance complémentaire</option>
                    </select>
                </div>

                <div>
                    <label for="medecin_traitant">Médecin traitant* :</label>
                    <input type="text" id="medecin_traitant" name="medecin_traitant" required>
                </div>
                <div class="buttons-patient">
                    <button type="button" onclick="afficherPartie('partie3')">Retour</button>
                    <button type="button" onclick="afficherPartie('partie5')">Suivant</button>
                </div>
            </fieldset>
        </div>
        <div class="search-container create_patient partie visible" id="partie5">
            <fieldset>
                <div>
                    <label for="personne_urgence">Personne à contacter en cas d'urgence :</label>
                    <input type="text" id="personne_urgence" name="personne_urgence">
                </div>

                <div>
                    <label for="tel_cas_urgence">Téléphone de la personne :</label>
                    <input type="text" id="tel_cas_urgence" name="tel_cas_urgence" maxlength="13">
                </div>

                <div>
                    <label for="lien_urgence">Lien avec la personne</label>
                    <select id="lien_urgence" name="lien_urgence">
                        <option value=""></option>
                        <option value="parent">Parent</option>
                        <option value="famille">famille</option>
                        <option value="ami">ami</option>
                        <option value="conjoint">conjoint/conjointe</option>
                    </select>
                </div>

                <div class="buttons-patient">
                    <button type="button" onclick="afficherPartie('partie4')">Retour</button>
                </div>
            </fieldset>
            <div class="buttons-patient">
                <input type="submit" value="Créer le patient" name="creer">
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