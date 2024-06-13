<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Mon compte</title>
    <link rel="stylesheet" href="static/css/styles.css">
</head>

<body class="patient">

    <div class="navbar">
        <a href="?url=Accueil">ACCUEIL</a>
        <a href="?url=CreationPatient">PATIENT</a>
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
        <h2>Modification des informations du patient : <?php echo htmlspecialchars($patientInfo['prenom_user']." ".htmlspecialchars($patientInfo['Nom_user'])); ?></h2>
    </div>

    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" name="formulaire_patient">
        <div class="search-container create_patient">
            <fieldset>
                <div>
                    <label for="prenom">Prénom* :</label>
                    <input type="text" id="prenom" name="prenom" value="<?php echo htmlspecialchars($patientInfo['prenom_user']); ?>" required>
                </div>
                <div>
                    <label for="nom">Nom* :</label>
                    <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($patientInfo['Nom_user']); ?>" required>
                </div>
                <div>
                    <label for="mail">Email* :</label>
                    <input type="email" id="mail" name="mail" value="<?php echo htmlspecialchars($patientInfo['adresse_mail']); ?>" required>
                </div>
                <div>
                    <label for="sexe">Sexe* :</label>
                    <select id="sexe" name="sexe" required>
                        <option value="M" <?php if ($patientInfo['sexe'] === 'M') echo 'selected'; ?>>Masculin</option>
                        <option value="F" <?php if ($patientInfo['sexe'] === 'F') echo 'selected'; ?>>Féminin</option>
                    </select>
                </div>
                <div>
                    <label for="date_naissance">Date de naissance* :</label>
                    <input type="date" id="date_naissance" name="date_naissance" value="<?php echo htmlspecialchars($patientInfo['date_naissance']); ?>" required>
                </div>
                <div>
                    <label for="adresse_postale">Adresse postale* :</label>
                    <input id="adresse_postale" name="adresse_postale" rows="4" value="<?php echo htmlspecialchars($patientInfo['adresse_postal']); ?>" required></input>
                </div>
                <div>
                    <label for="cp">Code postal* :</label>
                    <input type="text" id="cp" name="cp" minlength="5" maxlength="5" value="<?php echo htmlspecialchars($patientInfo['CP']); ?>" required>
                </div>
                <div>
                    <label for="ville">Ville* :</label>
                    <input type="text" id="ville" name="ville" value="<?php echo htmlspecialchars($patientInfo['Ville']); ?>" required>
                </div>
                <div>
                    <label for="pays">Pays* :</label>
                    <input type="text" id="pays" name="pays" value="<?php echo htmlspecialchars($patientInfo['Pays']); ?>" required>
                </div>
                <div>
                    <label for="profession">Profession :</label>
                    <select id="profession" name="profession" required>
                        <option value="agriculteur" <?php if ($patientInfo['profession'] === 'agriculteur') echo 'selected'; ?>>Agriculteur</option>
                        <option value="artisan" <?php if ($patientInfo['profession'] === 'artisan') echo 'selected'; ?>>Artisan</option>
                        <option value="commercant" <?php if ($patientInfo['profession'] === 'commercant') echo 'selected'; ?>>Commerçant</option>
                        <option value="chef_entreprise" <?php if ($patientInfo['profession'] === 'chef_entreprise') echo 'selected'; ?>>Chef d'entreprise</option>
                        <option value="profession_liberale" <?php if ($patientInfo['profession'] === 'profession_liberale') echo 'selected'; ?>>Profession libérale</option>
                        <option value="cadre" <?php if ($patientInfo['profession'] === 'cadre') echo 'selected'; ?>>Cadre</option>
                        <option value="profession_intermediaire" <?php if ($patientInfo['profession'] === 'profession_intermediaire') echo 'selected'; ?>>Profession Intermédiaire</option>
                        <option value="employe" <?php if ($patientInfo['profession'] === 'employe') echo 'selected'; ?>>Employé</option>
                        <option value="ouvrier" <?php if ($patientInfo['profession'] === 'ouvrier') echo 'selected'; ?>>Ouvrier</option>
                        <option value="retraite" <?php if ($patientInfo['profession'] === 'retraite') echo 'selected'; ?>>Retraité</option>
                        <option value="demandeur_emploi" <?php if ($patientInfo['profession'] === 'demandeur_emploi') echo 'selected'; ?>>Demandeur d'emploi</option>
                        <option value="etudiant" <?php if ($patientInfo['profession'] === 'etudiant') echo 'selected'; ?>>Etudiant</option>
                        <option value="autre" <?php if ($patientInfo['profession'] === 'autre') echo 'selected'; ?>>Autre</option>
                    </select>
                </div>
                <div>
                    <label for="situation_familiale">Situation familiale* :</label>
                    <select id="situation_familiale" name="situation_familiale" required>
                        <option value="marié" <?php if ($patientInfo['situation_familial'] === 'marié') echo 'selected'; ?>>Marié(e)</option>
                        <option value="célibataire" <?php if ($patientInfo['situation_familial'] === 'célibataire') echo 'selected'; ?>>Célibataire</option>
                        <option value="veuf" <?php if ($patientInfo['situation_familial'] === 'veuf') echo 'selected'; ?>>Veuf/Veuve</option>
                        <option value="concubinage" <?php if ($patientInfo['situation_familial'] === 'concubinage') echo 'selected'; ?>>En concubinage</option>
                    </select>
                </div>
                <div>
                    <label for="numero_telephone">Numéro de téléphone* :</label>
                    <input type="tel" id="numero_telephone" name="numero_telephone" pattern="[0-9]{10}" value="<?php echo htmlspecialchars($patientInfo['num_tel']); ?>" required>
                </div>
                <div>
                    <label for="langue_parlee">Langue(s) parlée(s)* :</label>
                    <input type="text" id="langue_parlee" name="langue_parlee" value="<?php echo htmlspecialchars($patientInfo['langue_parler']); ?>" required>
                </div>
                <div>
                    <label for="numero_secu">Numéro de sécurité sociale* :</label>
                    <input type="text" id="numero_secu" name="numero_secu" maxlength="15" value="<?php echo htmlspecialchars($patientInfo['num_sec']); ?>" required>
                </div>
                <div>
                    <label for="type_assurance">Type d'assurance* :</label>
                    <select id="type_assurance" name="type_assurance" required>
                        <option value="">Choisissez une option</option>
                        <option value="Assurance maladie" <?php if ($patientInfo['type_assurance'] === 'Assurance maladie') echo 'selected'; ?>>Assurance maladie</option>
                        <option value="Mutuelle" <?php if ($patientInfo['type_assurance'] === 'Mutuelle') echo 'selected'; ?>>Mutuelle</option>
                        <option value="Assurance complémentaire" <?php if ($patientInfo['type_assurance'] === 'Assurance complémentaire') echo 'selected'; ?>>Assurance complémentaire</option>
                    </select>
                </div>
                <div>
                    <label for="medecin_traitant">Médecin traitant* :</label>
                    <input type="text" id="medecin_traitant" name="medecin_traitant" value="<?php echo htmlspecialchars($patientInfo['MedecinTraitant']); ?>" required>
                </div>
                <div>
                    <label for="personne_urgence">Personne à contacter en cas d'urgence :</label>
                    <input type="text" id="personne_urgence" name="personne_urgence" value="<?php echo htmlspecialchars($patientInfo['contacte_cas_urgence']); ?>">
                </div>
                <div>
                    <label for="tel_cas_urgence">Téléphone de la personne :</label>
                    <input type="text" id="tel_cas_urgence" name="tel_cas_urgence" maxlength="13" value="<?php echo htmlspecialchars($patientInfo['num_tel']); ?>">
                </div>
                <div>
                    <label for="lien_urgence">Lien avec la personne :</label>
                    <select id="lien_urgence" name="lien_urgence">
                        <option value=""></option>
                        <option value="parent" <?php if ($patientInfo['lien_cas_urgence'] === 'parent') echo 'selected'; ?>>Parent</option>
                        <option value="famille" <?php if ($patientInfo['lien_cas_urgence'] === 'famille') echo 'selected'; ?>>Famille</option>
                        <option value="ami" <?php if ($patientInfo['lien_cas_urgence'] === 'ami') echo 'selected'; ?>>Ami</option>
                        <option value="conjoint" <?php if ($patientInfo['lien_cas_urgence'] === 'conjoint') echo 'selected'; ?>>Conjoint/Conjointe</option>
                    </select>
                </div>
                <div class="buttons-patient">
                    <input type="submit" value="Modifier" name="modifier">
                </div>
            </fieldset>
        </div>
    </form>
</body>

</html>
<script src="static/js/script.js"></script>
