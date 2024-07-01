<?php

class ModelRecupererCompteRendu
{
    public function recupererComptesRendus($id_user, $service)
    {
        $id_user = escapeshellarg($id_user);
        $service = isset($service) ? escapeshellarg($service) : '';
        
        //$command = "C:\Users\User\AppData\Local\Programs\Python\Python312\python.exe C:/xampp/htdocs/projetAnnuelB3ESGI/employe/src/models/python/ModelRecupererCompteRendu.py $id_user $service 2>&1";

        $command = "C:\\Python312\\python.exe C:/xampp/htdocs/projetAnnuelB3ESGI/employe/src/models/python/ModelRecupererCompteRendu.py $id_user $service 2>&1";
        exec($command, $output, $return_var);

        $comptesRendus = [];
        $json_output = implode("", $output);
        $decoded_output = json_decode($json_output, true);

        if (json_last_error() === JSON_ERROR_NONE) {
            $comptesRendus = $decoded_output;
        } else {
            error_log("Erreur de décodage JSON: " . json_last_error_msg());
        }

        return $comptesRendus;
    }
}
