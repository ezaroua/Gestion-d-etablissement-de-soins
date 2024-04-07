<?php

class Patient{

    private $_id;
    private $_nom;
    private $_prenom;
    private $_sexe;
    private $_numSecu;
    private $_medecinTraitant;
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
    public function setId($id){
        $id = (int) $id;

        if($id >0){
            $this->_id = $id;
        }
    }

    public function setNom($nom){
        if(is_string($nom))
            $this->_nom = $nom;
    }

    public function setPrenom($prenom){
        if(is_string($prenom))
            $this->_prenom = $prenom;
    }

    public function setSex($sex){
        if(is_string($sex) and ($sex=='F' or $sex=='M'))
            $this->_sex = $sex;
    }

    public function setnumSecu($numSecu){
        $numSecu = (int) $numSecu;

        if($numSecu >0){
            $this->_numSecu = $numSecu;
        }
    }

    public function setmedecinTraitant($medecinTraitant){
        if(is_string($medecinTraitant))
            $this->_medecinTraitant = $medecinTraitant;
    }

    public function setdateNaissance($dateNaissance){
        $this->_dateNaissance = $dateNaissance;
    }

    //getters

    public function id(){
        return $this->_id;
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

    public function numSecu(){
        return $this->_numSecu;
    }

    public function medecinTraitant(){
        return $this->_medecinTraitant;
    }

    public function dateNaissance(){
        return $this->_dateNaissance;
    }


}