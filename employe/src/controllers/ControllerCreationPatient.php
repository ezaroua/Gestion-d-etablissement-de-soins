<?php

class ControllerCreationPatient
{
    private $_view;

    public function __construct($url)
    {
        // Vérifiez si des paramètres supplémentaires sont fournis dans l'URL
        // et gérez-les ou lancez une exception si l'URL n'est pas valide
        if (isset($url) && is_array($url) && count($url) > 1)
            throw new Exception('Page introuvable');
        else
            $this->createPatient();
    }


    private function createPatient()
    {
        // Logique pour initialiser la création du patient
        // Cela inclut généralement la préparation des données nécessaires pour la vue
        // et ensuite charger la vue.
        require_once('src/models/ModeleCreationPatient.php');
        require_once('src/views/ViewCreationPatient.php');
        if (isset($_POST['creer'])) {
            $nom = htmlspecialchars($_POST['nom']);
            $prenom = htmlspecialchars($_POST['prenom']);
            $email = htmlspecialchars($_POST['mail']);
            $sexe = htmlspecialchars($_POST['sexe']);


            //deuxieme
            $date_naissance = htmlspecialchars($_POST['date_naissance']);
            $profession = htmlspecialchars($_POST['profession']);
            $situation_familiale = htmlspecialchars($_POST['situation_familiale']);
            $adresse = htmlspecialchars($_POST['adresse_postale']);
            $tel = htmlspecialchars($_POST['numero_telephone']);
            $langue = htmlspecialchars($_POST['langue_parlee']);

            //troisieme
            $num_secu = htmlspecialchars($_POST['numero_secu']);
            $assurance = htmlspecialchars($_POST['type_assurance']);
            $medecin_traitant = htmlspecialchars($_POST['medecin_traitant']);

            //quatrieme
            $personne_urgence = htmlspecialchars($_POST['personne_urgence']);

            insererUser($nom, $prenom, $email, $sexe, $_bdd);
            insererPatient($date_naissance, $profession, $situation_familiale, $adresse, $tel, $langue, $num_secu, $assurance, $medecin_traitant, $personne_urgence, $_bdd);
        }
    }
}
