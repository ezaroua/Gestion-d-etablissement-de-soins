<?php
class Router
{
    private $_ctrl;
    private $_view;

    public function routeReq()
    {
        try {
            // Chargement automatique des classes
             spl_autoload_register(function ($class) {
            if (file_exists('src/models/' . $class . '.php')) {
                require_once('src/models/' . $class . '.php');
            }
        });

            $url = '';

            //le controller est inclus selon l'action de l'utilisateur
            if (isset($_GET['url'])) {
                $url = explode('/', filter_var(
                    $_GET['url'],
                    FILTER_SANITIZE_URL
                ));

                $controller = ucfirst(strtolower($url[0]));
                $controllerClass = "Controller" . $controller;
                //$controllerFile = "controllers/".$controllerClass."php";
                $controllerFile = "src/controllers/" . $controllerClass . ".php";

                if (file_exists($controllerFile)) {
                    require_once($controllerFile);
                    $this->_ctrl = new $controllerClass($url);
                } else {
                    throw new Exception('Page introuvable');
                }
            } else {
                require_once('src/controllers/ControllerConnexionEmploye.php');
                $this->_ctrl = new ControllerConnexionEmploye($url);
            }

            // Gestion des erreurs
        } catch (Exception $e) {
            $errorMsg = $e->getMessage();
            require_once('src/views/viewError.php');
        }
    }
}
?>
