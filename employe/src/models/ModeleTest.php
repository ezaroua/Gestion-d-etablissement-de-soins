<?php
function transformerEnTableau($chaine)
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
$nom = "";
$prenom = "";
$date_naissance = "";
$num_sec = "";
$service = 1;
$chemin_script_python = "python/ModeleRecupererPatient.py";
$chemin_exec_python = "C:\\Users\\thoma\\AppData\\Local\\Programs\\Python\\Python312\\python.exe";

error_reporting(E_ALL);
ini_set('display_errors', 1);
// Appel du script Python en utilisant exec
putenv('PYTHONIOENCODING=utf-8');
exec("$chemin_exec_python $chemin_script_python \"$nom\" \"$prenom\" \"$date_naissance\" \"$num_sec\" $service", $output, $return);


// Affichage de la sortie et du code de retour
echo "Sortie du script Python :";
echo "<pre>";
print_r($output);
echo "</pre>";

echo "Code de retour : $return";

$tab_patient = array();

$output = array_slice($output, 1, null, true);

// Parcourir chaque élément du tableau
foreach ($output as $element) {
    $element = transformerEnTableau($element);
    array_push($tab_patient, $element);
    //echo "<br/>" . gettype($element) . "<br/>";
    //print_r($element);
}
echo "<br/><br/>";
print_r($tab_patient);
echo "<br/>";
foreach ($tab_patient as $element) {
    echo "<br/>";
    echo $element[3];
}
