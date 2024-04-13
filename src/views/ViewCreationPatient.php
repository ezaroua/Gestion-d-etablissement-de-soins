<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Nouveau Patient</title>
    <link rel="stylesheet" href="../../static/css/styles.css">
</head>

<body class="patient">
    <div class="main-header">
        <h2>Nouveau Patient</h2>
        <!-- Formulaires et autres éléments d'interface utilisateur -->
    </div>
    <form action="" method="post" name="formulaire_patient">
        <div class="search-container create_patient">
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
            </fieldset>
        </div>
        <div class="bar"></div>
        <div class="search-container create_patient">
            <fieldset>
                <div>
                    <label for="date_naissance">Date de naissance :</label>
                    <input type="date" id="date_naissance" name="date_naissance" required>
                </div>

                <div>
                    <label for="profession">Profession :</label>
                    <input type="text" id="profession" name="profession" required>
                </div>

                <div>
                    <label for="situation_familiale">Situation familiale :</label>
                    <select id="situation_familiale" name="situation_familiale" required>
                        <option value="marié">Marié(e)</option>
                        <option value="célibataire">Célibataire</option>
                        <option value="veuf">Veuf/Veuve</option>
                        <option value="concubinage">En concubinage</option>
                    </select>
                </div>

                <div>
                    <label for="adresse_postale">Adresse postale :</label>
                    <textarea id="adresse_postale" name="adresse_postale" rows="4" required></textarea>
                </div>

                <div>
                    <label for="numero_telephone">Numéro de téléphone :</label>
                    <input type="tel" id="numero_telephone" name="numero_telephone" pattern="[0-9]{10}" required>
                </div>

                <div>
                    <label for="langue_parlee">Langue(s) parlée(s) :</label>
                    <input type="text" id="langue_parlee" name="langue_parlee" required>
                </div>
            </fieldset>
        </div>
        <div class="bar"></div>
        <div class="search-container create_patient">
            <fieldset>
                <div>
                    <label for="numero_secu">Numéro de sécurité sociale :</label>
                    <input type="text" id="numero_secu" name="numero_secu" pattern="[0-9]{15}" required>
                </div>

                <div>
                    <label for="type_assurance">Type d'assurance :</label>
                    <select id="type_assurance" name="type_assurance" required>
                        <option value="">Choisissez une option</option>
                        <option value="Assurance maladie">Assurance maladie</option>
                        <option value="Mutuelle">Mutuelle</option>
                        <option value="Assurance complémentaire">Assurance complémentaire</option>
                    </select>
                </div>

                <div>
                    <label for="medecin_traitant">Médecin traitant :</label>
                    <input type="text" id="medecin_traitant" name="medecin_traitant" required>
                </div>
            </fieldset>
        </div>
        <div class="bar"></div>
        <div class="search-container create_patient">
            <fieldset>
                <label for="personne_urgence">Personne à contacter en cas d'urgence :</label>
                <textarea id="personne_urgence" name="personne_urgence" rows="4" required></textarea>
            </fieldset>
        </div>
        <div class="buttons-patient">
            <input type="submit" value="Créer le patient" name="creer">
        </div>
    </form>