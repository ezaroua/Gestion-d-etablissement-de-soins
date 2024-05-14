<?php
class ControllerTest
{
    public function __construct($url)
    {
        // Vérifiez si des paramètres supplémentaires sont fournis dans l'URL
        // et gérez-les ou lancez une exception si l'URL n'est pas valide
        if (isset($url) && is_array($url) && count($url) > 1)
            throw new Exception('Page introuvable');
        else
            $this->insertionNoSQL();
    }

    private function insertionNoSQL()
    {
        //if (isset($_POST['soumettre'])) {
        $creation = new ModeleInsertionPatientNoSQL();
        //$num_secu = htmlspecialchars($_POST['num_secu']);
        //$service=htmlspecialchars($_POST['service']);
        //si 1, on est service urgence
        $service = 1;
        $num_secu = "12345678922222";

        $result = $creation->recupererDonneePatient($num_secu);
        foreach ($result as $result) {
            $id_user = $result['id_user'];
            $date_naissance = $result['date_naissance'];
            $profession = $result['profession'];
            $situation_familial = $result['situation_familial'];
            $adresse = $result['adresse_postal'];
            $cp = $result['CP'];
            $ville = $result['Ville'];
            $pays = $result['Pays'];
            $tel = $result['num_tel'];
            $type_assurance = $result['type_assurance'];
            $contacte_cas_urgence = $result['contacte_cas_urgence'];
            $medecin_traitant = $result['MedecinTraitant'];
            $langue = $result['langue_parler'];
        }
        $result2 = $creation->recupererDonneeUser($id_user);
        foreach ($result2 as $result) {
            $nom = $result['Nom_user'];
            $prenom = $result['prenom_user'];
            $sexe = $result['sexe'];
            $mail = $result['adresse_mail'];
        }
        $creation->creerDansNoSQL($nom, $prenom, $sexe, $mail, $date_naissance, $profession, $situation_familial, $num_secu, $adresse, $cp, $ville, $pays, $tel, $type_assurance, $contacte_cas_urgence, $medecin_traitant, $langue, $id_user, $service);
        //}
    }
}
