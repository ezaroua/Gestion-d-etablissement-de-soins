<?php
class ControllerAccueilMedical
{

    public function __construct($url)
    {
        if (isset($url) && is_array($url) && count($url) > 1)
            throw new Exception('Page introuvable');
        else
            $this->patients();
    }

    public function patients()
    {
        require_once('src/views/viewAccueilMedecin.php');
    }
}
