<?php

class ControllerCreationPatient {
    private $_view;

    public function __construct($url) {
        // Vérifiez si des paramètres supplémentaires sont fournis dans l'URL
        // et gérez-les ou lancez une exception si l'URL n'est pas valide
        if (isset($url) && is_array($url) && count($url) > 1)
            throw new Exception('Page introuvable');
        else
            $this->createPatient();
    }
    

    private function createPatient() {
        // Logique pour initialiser la création du patient
        // Cela inclut généralement la préparation des données nécessaires pour la vue
        // et ensuite charger la vue.
        
        require_once('src/views/ViewCreationPatient.php');
    }

    /*<?php

$_bdd = new PDO('mysql:host=localhost;dbname=db_administrative_patient;charset=utf8', 'root', '');
$_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
require('../models/ModeleCreationPatient.php');
require('../views/ViewCreationPatient.php');*/
}
