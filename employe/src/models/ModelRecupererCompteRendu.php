<?php

class ModelRecupererCompteRendu
{
    public function recupererComptesRendus($id_user, $service)
    {
        $id_user = escapeshellarg($id_user);
        $service = escapeshellarg($service);
        $command = "C:\Users\User\AppData\Local\Programs\Python\Python312\python.exe C:/xampp/htdocs/projetAnnuelB3ESGI/employe/src/models/python/ModelRecupererCompteRendu.py $id_user $service 2>&1";
        exec($command, $output, $return_var);

        $comptesRendus = [];
        foreach ($output as $line) {
            $data = json_decode($line, true);
            if ($data) {
                $comptesRendus[] = $data;
            } else {
                error_log("Donnée incomplète ou mal formée: $line");
            }
        }
        return $comptesRendus;
    }
}
