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
            $parts = explode('$', $line);
            if (count($parts) === 3) {
                list($date, $motif, $compteRendu) = $parts;
                $comptesRendus[] = [
                    'date' => trim($date),
                    'motif' => trim($motif),
                    'compte_rendu' => trim($compteRendu)
                ];
            } else {
                error_log("Donnée incomplète ou mal formée: $line");
            }
        }

        return $comptesRendus;
    }
}
?>
