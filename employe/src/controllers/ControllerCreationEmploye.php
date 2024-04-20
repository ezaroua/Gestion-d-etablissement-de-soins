<?php

class ControllerCreationEmploye
{
    private $_view;

    public function __construct($url)
    {
        // Vérifiez si des paramètres supplémentaires sont fournis dans l'URL
        // et gérez-les ou lancez une exception si l'URL n'est pas valide
        if (isset($url) && is_array($url) && count($url) > 1)
            throw new Exception('Page introuvable');
        else
            $this->createEmploye();
    }

    private function createEmploye()
    {
        // Logique pour initialiser la création du patient
        // Cela inclut généralement la préparation des données nécessaires pour la vue
        // et ensuite charger la vue.
        if (isset($_POST['soumettre'])) {
            $user = new ModeleCreationEmploye();
            $nom = htmlspecialchars($_POST['nom']);
            $prenom = htmlspecialchars($_POST['prenom']);
            $login = $nom . $prenom;
            $email = htmlspecialchars($_POST['mail']);
            $sexe = htmlspecialchars($_POST['sexe']);
            $date_embauche = htmlspecialchars($_POST['date_embauche']);
            $contrat = htmlspecialchars($_POST['contrat']);
            $date_debut = htmlspecialchars($_POST('date_debut'));
            $date_fin = htmlspecialchars($_POST('date_fin'));
            $service = htmlspecialchars($_POST['service']);

            $user->insererUser($nom, $prenom, $email, $sexe);
            $user->insererEmploye($date_embauche, $contrat, $date_debut, $date_fin);
        }
        require_once('src/views/ViewCreationEmploye.php');
    }
}
