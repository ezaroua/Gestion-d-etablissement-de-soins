<?php

require 'Database.php'; // Inclure le fichier de connexion à la base de données
class ModeleRecupererUnPatientNoSQL
{
    private $chemin_script_python = "src/models/python/ModeleRecupererUnPatient.py";
    private $chemin_exec_python = "C:\Users\User\AppData\Local\Programs\Python\Python312\python.exe";
    //private $chemin_exec_python = "C:\\Users\\thoma\\AppData\\Local\\Programs\\Python\\Python312\\python.exe";
    protected function getBdd()
    {
        return Database::getBdd();
    }

    private function transformerEnTableau($chaine)
    {
        // Supprimer les crochets
        $chaine = trim($chaine, "[]");

        // Séparer les éléments
        $elements = explode(", ", $chaine);

        // Enlever les apostrophes autour de chaque élément
        foreach ($elements as &$element) {
            $element = trim($element, "'");
        }

        // Retourner le tableau résultant
        return $elements;
    }

    public function recupererUnPatientNoSQL($service, $id_user)
    {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $args = array_map('escapeshellarg', func_get_args());
        $command = "$this->chemin_exec_python $this->chemin_script_python " . implode(' ', $args) . " 2>&1";
        // Appel du script Python en utilisant exec
        putenv('PYTHONIOENCODING=utf-8');
        exec($command, $output, $return);

        if ($return !== 0 || empty($output)) {
            header("Location: index.php?url=AccueilMedical"); // Remplacez /path/to/error/page par le chemin réel de la page d'erreur
            exit();
        }

        // Parcourir chaque élément du tableau
        foreach ($output as $element) {
            $element = $this->transformerEnTableau($element);
        }

        return $element;
    }
}