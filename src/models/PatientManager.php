<?php 

class PatientManager extends Model{

    public function getPatients(){
        $this->getBdd();
        return $this->getAll('patients','Patient');
    }
}