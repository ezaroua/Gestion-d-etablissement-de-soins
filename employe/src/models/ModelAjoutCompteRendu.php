<?php

class ModelAjoutCompteRendu
{
    private $chemin_exec_python = "C:\\Users\\User\\AppData\\Local\\Programs\\Python\\Python312\\python.exe";
    private $chemin_script_python = "C:\\xampp\\htdocs\\projetAnnuelB3ESGI\\employe\\src\\models\\python\\ModelInsertionCompteRendu.py";

    public function creerDansNoSQL($id_user, $date, $motif, $compteRendu , $nom_medecin )
    {
        $compteRenduEncoded = base64_encode($compteRendu); // Bonne pratique : encoder pour gérer les caractères spéciaux
        $command = escapeshellcmd($this->chemin_exec_python) . ' ' .
                   escapeshellarg($this->chemin_script_python) . ' ' .
                   escapeshellarg($id_user) . ' ' .
                   escapeshellarg($date) . ' ' .
                   escapeshellarg($motif) . ' ' .
                   escapeshellarg($compteRenduEncoded) . ' ' . // Utilisez la version encodée ici
                   escapeshellarg($nom_medecin);
        
        error_log("Executing command: $command");

        $output = shell_exec($command);
        if ($output === null) {
            error_log("Shell execution returned null: check command syntax and permissions.");
        }

        error_log("Command output: $output");
        
        return $output;
    }
}
?>
