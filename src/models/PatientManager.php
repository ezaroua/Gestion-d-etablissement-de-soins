<?php 

class PatientManager extends Model{

    public function getPatients(){
        return $this->getAll('patients','Patient');
    }

    public function searchPatients() {
        $nom = $_POST['nom'] ?? null;
        $prenom = $_POST['prenom'] ?? null;
        $dateNaissance = $_POST['dateNaissance'] ?? null;
        $num_sec = $_POST['num_sec'] ?? null;
        $patientId = $_POST['patientId'] ?? null;
        //$dateNaissance = $_POST['dateNaissance'] ?? null;
        //$this->_patientManager = new PatientManager();
        
        //require_once('src/views/viewAccueil.php');
        
        return $this->getsearchPatients('patients','Patient', $nom, $prenom, $dateNaissance, $num_sec , $patientId);  
    }

}
