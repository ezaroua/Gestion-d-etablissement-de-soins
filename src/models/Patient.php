<?php

class Patient{

    private $_id_user;
    private $_nom;
    private $_prenom;
    private $_sexe;
    private $_num_sec;
    private $_MedecinTraitant;
    private $_dateNaissance;

    //constructeur
    public function __construct(array $data){
        $this->hydrate($data);
    }

    //hydratation
    public function hydrate(array $data){
        foreach($data as $key => $value){
            $method = 'set'.ucfirst($key);

            if(method_exists($this,$method))
                $this->$method($value);
        }
    }

    //setters 
    public function setid_user($id_user){
        $id_user = (int) $id_user;

        if($id_user >0){
            $this->_id_user = $id_user;
        }
    }

    public function setnom_user($nom){
        if(is_string($nom))
            $this->_nom = $nom;
    }

    public function setprenom_user($prenom){
        if(is_string($prenom))
            $this->_prenom = $prenom;
    }

    public function setSexe($sexe){
        if(is_string($sexe) and ($sexe == 'F' or $sexe == 'M')){
            $this->_sexe = $sexe;
        }
    }
    

    public function setnum_sec($numSecu){
        $numSecu = (int) $numSecu;

        if($numSecu >0){
            $this->_num_sec = $numSecu;
        }
    }

    public function setMedecinTraitant($MedecinTraitant){
        if(is_string($MedecinTraitant))
            $this->_MedecinTraitant = $MedecinTraitant;
    }

    public function setdate_naissance($dateNaissance){
        $this->_dateNaissance = $dateNaissance;
    }

    //getters

    public function id_user(){
        return $this->_id_user;
    }

    public function nom(){
        return $this->_nom;
    }

    public function prenom(){
        return $this->_prenom;
    }

    public function sexe(){
        return $this->_sexe;
    }

    public function num_sec(){
        return $this->_num_sec;
    }

    public function MedecinTraitant(){
        return $this->_MedecinTraitant;
    }

    public function date_naissance(){
        return $this->_dateNaissance;
    }


}