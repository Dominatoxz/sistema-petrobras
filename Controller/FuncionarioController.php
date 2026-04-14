<?php
require_once dirname(__DIR__) . '/Model/Funcionario.php';
require_once dirname(__DIR__) . '/config/Database-infos.php';
require_once dirname(__DIR__) . '/config/Database-pro.php';

class FuncionarioController {
    private $funcionario;

    public function __construct() {
        $db_infos = (new Database_infos())->getConnection();
        $db_iris = (new Database_pro())->getConnection();

        //instanciar a Model Estudante
        $this->funcionario = new funcionario($db_infos, $db_iris);
    }


    public function index() {

        $funcionarios = $this->funcionario->buscarTodosComIris();
        require_once dirname(__DIR__) . '/View/tabela_funcionarios.php';
    } 


}

?>