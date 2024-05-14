<?php

class ControllerModificationPassword
{
    private $_view;

    public function __construct($url)
    {
        // Vérifiez si des paramètres supplémentaires sont fournis dans l'URL
        // et gérez-les ou lancez une exception si l'URL n'est pas valide
        if (isset($url) && is_array($url) && count($url) > 1)
            throw new Exception('Page introuvable');
        else
            $this->changePassword();
    }


    private function changePassword()
    {       
        require_once('src/views/ViewModificationPassword.php');
    }
}

?>