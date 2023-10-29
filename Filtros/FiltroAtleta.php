<?php
$authManager = new AuthorizationManager(['Atleta']);
$userType = null;
if (isset($_SESSION['id_usuario'])) {
    $recuerda = $conexion->prepare('SELECT Tipo FROM usuarios WHERE id_usuario = :id_usuario');
    $recuerda->bindParam(':id_usuario', $_SESSION['id_usuario']);
    $recuerda->execute();
    $userType = $recuerda->fetchColumn();
}
if (!$authManager->checkAuthorization($userType)) {
    $authManager->redirectUnauthorized("../../login.php");
}

class AuthorizationManager {
    private $allowedTypes;

    public function __construct($allowedTypes = []) {
        $this->allowedTypes = $allowedTypes;
    }

    public function checkAuthorization($userType) {
        if (in_array($userType, $this->allowedTypes) || empty($this->allowedTypes)) {
            return true;
        } else {
            return false;
        }
    }

    public function redirectUnauthorized($redirectUrl) {
        header("location: $redirectUrl");
        exit();
    }
}


?>
