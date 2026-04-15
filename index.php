<?php
require_once 'Controller/FuncionarioController.php';

$app = new FuncionarioController();
$action = $_GET['action'] ?? 'index';

switch ($action) {
    case 'validar':
        $app->validarBiometria(); 
        break;
    default:
        $app->index();
        break;
}
?>