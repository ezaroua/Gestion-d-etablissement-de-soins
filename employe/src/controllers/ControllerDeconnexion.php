<?php 

class UserController {
    public function logout() { //A FAIRE FONCTIONNER
        session_start();
        session_destroy();
        header('Location: src/controllers/ControllerConnexionEmploye.php'); // Redirige vers la page de connexion

        echo "<script language='Javascript'>alert('$error')</script>";
        header("Refresh: 0.1; " . $_SERVER['REQUEST_URI']);
        exit();
        }
}

?>
