<?php
$id = $_GET['id'];
// Supposons que vous avez une fonction qui récupère les détails du patient
$patient = getPatientById($id);

if ($patient) {
    echo "<h1>Détails du patient</h1>";
    echo "<p>Nom : " . $patient->nom() . "</p>";
    echo "<p>Prénom : " . $patient->prenom() . "</p>";
    // Ajoutez plus de détails selon les données disponibles
} else {
    echo "<p>Patient non trouvé.</p>";
}
?>
