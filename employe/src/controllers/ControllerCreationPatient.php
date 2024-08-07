<?php
session_start(); // Démarrer la session
class ControllerCreationPatient
{
    private $_view;

    public function __construct($url)
    {
        // Vérifiez si des paramètres supplémentaires sont fournis dans l'URL
        // et gérez-les ou lancez une exception si l'URL n'est pas valide
        // Vérifier si les variables de session 'nom' et 'prenom' sont présentes
        if (!isset($_SESSION['nom']) || !isset($_SESSION['prenom'])) {
            // Rediriger vers une page de connexion ou afficher un message d'erreur
            header('Location: index.php');
            exit(); // Arrêter l'exécution du script
        }

        if  ($_SESSION['id_service'] != 1){

            header('Location: ?url=AccueilMedical');
            exit();

        }

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
        if (isset($_POST['creer'])) {
            $user = new ModeleCreationPatient();
            $nom = htmlspecialchars($_POST['nom']);
            $prenom = htmlspecialchars($_POST['prenom']);
            $email = htmlspecialchars($_POST['mail']);
            $sexe = htmlspecialchars($_POST['sexe']);


            //deuxieme
            $date_naissance = htmlspecialchars($_POST['date_naissance']);
            $profession = htmlspecialchars($_POST['profession']);
            $situation_familiale = htmlspecialchars($_POST['situation_familiale']);
            $adresse = htmlspecialchars($_POST['adresse_postale']);
            $cp = htmlspecialchars($_POST['cp']);
            $ville = htmlspecialchars($_POST['ville']);
            $pays = htmlspecialchars($_POST['pays']);
            $tel = htmlspecialchars($_POST['numero_telephone']);
            $langue = htmlspecialchars($_POST['langue_parlee']);

            //troisieme
            $num_secu = htmlspecialchars($_POST['numero_secu']);
            $assurance = htmlspecialchars($_POST['type_assurance']);
            $medecin_traitant = htmlspecialchars($_POST['medecin_traitant']);

            //quatrieme
            $personne_urgence = !empty($_POST['personne_urgence']) ? htmlspecialchars($_POST['personne_urgence']) : null;
            $tel_urgence = !empty($_POST['tel_cas_urgence']) ? htmlspecialchars($_POST['tel_cas_urgence']) : null;
            $lien_urgence = !empty($_POST['lien_urgence']) ? htmlspecialchars($_POST['lien_urgence']) : null;
            $verif = $user->verifierNumeroSecu($num_secu);
            if ($verif) {
                $user->insererUser($nom, $prenom, $email, $sexe);
                $user->insererPatient($date_naissance, $profession, $situation_familiale, $adresse, $cp, $ville, $pays, $tel, $langue, $num_secu, $assurance, $medecin_traitant, $personne_urgence, $tel_urgence, $lien_urgence);
            }
        }
        require_once('src/views/ViewCreationPatient.php');
    }
}
