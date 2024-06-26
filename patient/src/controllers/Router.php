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
                $file = 'src/models/' . $class . '.php';
                if (file_exists($file)) {
                    require_once($file);
                } else {
                    throw new Exception('File ' . $file . ' not found.');
                }
            });

            $url = '';

            // Le contrôleur est inclus selon l'action de l'utilisateur
            if (isset($_GET['url'])) {
                $url = explode('/', filter_var($_GET['url'], FILTER_SANITIZE_URL));

                $controller = ucfirst(strtolower($url[0]));
                $controllerClass = "Controller" . $controller;
                $controllerFile = "src/controllers/" . $controllerClass . ".php";

                if (file_exists($controllerFile)) {
                    require_once($controllerFile);
                    $this->_ctrl = new $controllerClass($url);
                } else {
                    throw new Exception('Controller file ' . $controllerFile . ' not found.');
                }
            } else {
                require_once('src/controllers/ControllerAccueilPatient.php');
                $this->_ctrl = new ControllerAccueilPatient($url);
            }

            // Gestion des erreurs
        } catch (Exception $e) {
            $errorMsg = $e->getMessage();
            require_once('src/views/viewError.php');
        }
    }
}
