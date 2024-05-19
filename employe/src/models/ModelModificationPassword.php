<?php
require 'Database.php'; // Inclure le fichier de connexion à la base de données

class ModelModificationPassword
{
    private $bdd;

    public function __construct()
    {
        $this->bdd = Database::getBdd();
    }

    public function checkCurrentPassword($userId, $currentPassword)
    {
        $stmt = $this->bdd->prepare("SELECT mot_de_passe_hash FROM users WHERE id_user = ?");
        $stmt->execute([$userId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result && password_verify($currentPassword, $result['mot_de_passe_hash'])) {
            return true;
        } else {
            return false;
        }
    }

    public function updatePassword($userId, $newPassword)
    {
        $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $this->bdd->prepare("UPDATE users SET mot_de_passe_hash = ? WHERE id_user = ?");
        return $stmt->execute([$newPasswordHash, $userId]);
    }
}
?>
