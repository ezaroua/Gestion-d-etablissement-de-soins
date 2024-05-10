<?php
// Chemin vers le script Python
$chemin_script_python = "ModeleInsertionPatient.py";
$chemin_exec_python = "C:\\Users\\thoma\\AppData\\Local\\Programs\\Python\\Python312\\python.exe";

//valeur
$numero_securite_sociale = "110-00-0000";
$nom = "Letoublon";
$prenom = "Thomas";
$sexe = "M";
$mail = "toto@gmail.com";

error_reporting(E_ALL);
ini_set('display_errors', 1);
// Appel du script Python en utilisant exec
exec("$chemin_exec_python $chemin_script_python $numero_securite_sociale $nom $prenom $sexe $mail", $output, $return);

// Affichage de la sortie et du code de retour
/*echo "Sortie du script Python :";
echo "<pre>";
print_r($output);
echo "</pre>";

echo "Code de retour : $return";*/
if ($return == 0) {
    echo "Insertion réussi";
}
