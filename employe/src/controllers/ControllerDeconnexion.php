<?php 

class UserController {
    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header('Location: ViewConnexionEmploye.php'); // Redirige vers la page de connexion
        exit();
        session_start();

    /*if ($_SESSION == null) {
        header("location: ../../template/connexion.php");
    }*/
    $id_user = $_SESSION["id_user"];
    $id_job = $_SESSION["roles_user"];
        }
}

?>
