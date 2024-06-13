<?php
session_start();
require_once 'src/models/ModelModificationPatient.php'; // Assurez-vous d'inclure votre modèle

class ControllerModificationPatient {
    private $model;

    public function __construct($url) {
        // Vérifiez si l'URL contient au moins un paramètre
        if (isset($_GET['id'])) {
            // Instancier le modèle
            $this->model = new ModelModificationPatient(Database::getBdd());
        
            // Récupérer l'ID du patient depuis les paramètres de l'URL
            $patientId = $_GET['id'];
            
            // Si le formulaire est soumis, vérifiez si le bouton "Modifier" est cliqué
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modifier'])) {
                // Récupérez les données du formulaire
                $patientData = [
                    'prenom' => $_POST['prenom'],
                    'nom' => $_POST['nom'],
                    'mail' => $_POST['mail'],
                    'sexe' => $_POST['sexe'],
                    'date_naissance' => $_POST['date_naissance'],
                    'adresse_postale' => $_POST['adresse_postale'],
                    'cp' => $_POST['cp'],
                    'ville' => $_POST['ville'],
                    'pays' => $_POST['pays'],
                    'profession' => $_POST['profession'],
                    'situation_familiale' => $_POST['situation_familiale'],
                    'numero_telephone' => $_POST['numero_telephone'],
                    'langue_parlee' => $_POST['langue_parlee'],
                    'numero_secu' => $_POST['numero_secu'],
                    'type_assurance' => $_POST['type_assurance'],
                    'medecin_traitant' => $_POST['medecin_traitant'],
                    'personne_urgence' => $_POST['personne_urgence'],
                    'tel_cas_urgence' => $_POST['tel_cas_urgence'],
                    'lien_urgence' => $_POST['lien_urgence']
                ];

                // Appel à la méthode pour mettre à jour les informations du patient
                $success = $this->model->updatePatientInfo($patientId, $patientData);

                // Rediriger vers une page de confirmation ou afficher un message approprié
                if ($success) {
                    // Rediriger ou afficher un message de succès
                } else {
                    // Afficher un message d'erreur
                }
            } else {
                // Appel à la méthode afficherFormulaire avec l'ID du patient
                $this->afficherFormulairePatient($patientId);
            }
        } else {
            // Si aucun ID de patient n'est fourni, vous pouvez gérer cela ici (par exemple, rediriger vers une page d'erreur)
            throw new Exception('ID de patient non spécifié');
        }
    }
    

    public function afficherFormulairePatient($patientId) {
        // Récupération des informations du patient
        $patientInfo = $this->model->getPatientInfo($patientId);
    
        // Vérifie si le patient existe
        if ($patientInfo) {
            // Appel à la vue avec les données du patient
            require 'src/views/ViewModificationPatient.php';
        } else {
            // Si le patient n'existe pas, vous pouvez gérer cela ici (par exemple, rediriger vers une page d'erreur)
            throw new Exception('Patient introuvable');
        }
    }
    
}
?>
