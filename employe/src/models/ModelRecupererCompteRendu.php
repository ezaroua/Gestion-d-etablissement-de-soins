<?php

class ModelRecupererCompteRendu
{
    public function recupererComptesRendus($id_user)
    {
        $command = "C:\Users\User\AppData\Local\Programs\Python\Python312\python.exe C:/xampp/htdocs/projetAnnuelB3ESGI/employe/src/models/python/ModelRecupererCompteRendu.py " . escapeshellarg($id_user) . " 2>&1";
        exec($command, $output, $return_var);

        $comptesRendus = []; // Initialiser un tableau vide pour les comptes rendus

        if ($return_var != 0) {
            // Si vous préférez retourner un tableau vide au lieu de lancer une exception
            error_log("Erreur lors de l'exécution du script Python: " . implode("\n", $output));
            return $comptesRendus; // Retourne le tableau vide
        }

        foreach ($output as $line) {
            $data = json_decode($line, true);
            if ($data) {
                $comptesRendus[] = [
                    'date' => trim($data['date']),
                    'motif' => trim($data['motif']),
                    'compte_rendu' => trim($data['compte_rendu']),
                    'nom_medecin' => trim($data['nom_medecin']),
                    'consultation_id' => trim($data['consultation_id'])
                ];
            } else {
                error_log("Donnée incomplète ou mal formée: $line");
            }
        }
        

        return $comptesRendus;
    }
}
?>
