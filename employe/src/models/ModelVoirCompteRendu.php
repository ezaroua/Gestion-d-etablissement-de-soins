<?php
require 'Database.php';
class ModelVoirCompteRendu {
    public function getConsultationById($id_user, $consultation_id, $service) {
        $id_user = escapeshellarg($id_user ?? '');
        $consultation_id = escapeshellarg($consultation_id ?? '');
        $service = escapeshellarg($service ?? '');
    
        //$command = "C:\\Users\\User\\AppData\\Local\\Programs\\Python\\Python312\\python.exe C:/xampp/htdocs/projetAnnuelB3ESGI/employe/src/models/python/ModelVoirCompteRendu.py $id_user $consultation_id $service 2>&1";

        $command = "C:\\Python312\\python.exe C:/xampp/htdocs/projetAnnuelB3ESGI/employe/src/models/python/ModelVoirCompteRendu.py $id_user $consultation_id $service 2>&1";
        exec($command, $output, $return_var);
        
        if ($return_var != 0) {
            error_log("Erreur lors de l'exécution du script Python: " . implode("\n", $output));
            return null; // Retourne null si une erreur survient
        }

        $data = json_decode(implode("", $output), true);
    if (isset($data['error'])) {
        error_log("Erreur: " . $data['error']);
        return null;
}

return [
    'date' => $data['date'] ?? 'Non disponible',
    'motif' => $data['motif'] ?? 'Non disponible',
    'compte_rendu' => $data['compte_rendu'] ?? 'Non disponible',
    'nom_medecin' => $data['nom_medecin'] ?? 'Non renseigné',
    'numero_securite_sociale' => $data['numero_securite_sociale'] ?? 'Non disponible',
    'prenom' => $data['prenom'] ?? 'Non disponible',
    'nom' => $data['nom'] ?? 'Non disponible',
    'medecin_traitant' => $data['medecin_traitant'] ?? 'Non disponible'
];
    }
}