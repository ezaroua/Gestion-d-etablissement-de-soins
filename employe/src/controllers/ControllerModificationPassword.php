<?php
session_start();

class ControllerModificationPassword
{
    private $_model;

    public function __construct($url)
    {
        // Vérifiez si des paramètres supplémentaires sont fournis dans l'URL
        // et gérez-les ou lancez une exception si l'URL n'est pas valide
        // Vérifier si les variables de session 'nom' et 'prenom' sont présentes
        if (!isset($_SESSION['nom']) || !isset($_SESSION['prenom'])) {
            // Rediriger vers une page de connexion ou afficher un message d'erreur
            header('Location: index.php');
            exit(); // Arrêter l'exécution du script
        }
        if (isset($url) && is_array($url) && count($url) > 1)
            throw new Exception('Page introuvable');
        else
            $this->handleRequest();
    }

    public function handleRequest()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->handleChangePassword();
        } else {
            $this->showChangePasswordForm();
        }
    }

    
    private function handleChangePassword()
    {
        $currentPassword = htmlspecialchars($_POST['currentPassword']);
        $newPassword = htmlspecialchars($_POST['newPassword']);
        $confirmNewPassword = htmlspecialchars($_POST['confirmNewPassword']);

        if ($newPassword !== $confirmNewPassword) {
            echo "<script>alert('Les nouveaux mots de passe ne correspondent pas.');</script>";
            header("Refresh: 0.1; " . $_SERVER['REQUEST_URI']);
            exit();
        }

        $userId = $_SESSION['id_user'];

        if ($this->_model->checkCurrentPassword($userId, $currentPassword)) {
            if ($this->_model->updatePassword($userId, $newPassword)) {
                echo "<script>alert('Le mot de passe a été changé avec succès.');</script>";
                header('Location: ?url=Accueil');
                exit();
            } else {
                echo "<script>alert('Erreur lors de la mise à jour du mot de passe.');</script>";
            }
        } else {
            echo "<script>alert('Le mot de passe actuel est incorrect.');</script>";
        }

        //header("Refresh: 0.1; " . $_SERVER['REQUEST_URI']);
        //exit();
    }

    private function showChangePasswordForm()
    {
        require_once "src/views/ViewModificationPassword.php";
    }
}
?>
