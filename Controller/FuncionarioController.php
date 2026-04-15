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
       
        if (empty($f['id_funcionario_iris']) || $f['Iris_Hash'] === 'Não Registrado') {
            
           
            foreach ($funcionarios as $funcionario_atual) {
        
                // Verifica se o hash não existe no banco de dados
                if ($funcionario_atual['Iris_Hash'] === 'Não Registrado' || is_null($funcionario_atual['id_funcionario_iris'])) {
                    
                    // Estilização da tela de trava (Acesso Negado)
                    echo "<div style='background: #900; color: white; padding: 50px; font-family: sans-serif; text-align: center; min-height: 100vh;'>";
                    echo "<h1>🚨 SISTEMA TRAVADO - ERRO DE INTEGRIDADE</h1>";
                    echo "<hr style='border: 1px solid #f00; width: 50%;'>";
                    
                    // Aqui usamos a variável correta do loop para mostrar quem está sem hash
                    echo "<p style='font-size: 1.2em; margin-top: 20px;'>";
                    echo "A tabela de segurança (sistema_iris_pro) não possui registro para o funcionário: <br>";
                    echo "<strong style='font-size: 1.5em;'>" . htmlspecialchars($funcionario_atual['Funcionário']) . "</strong>";
                    echo "</p>";
                    
                    echo "<p>Matrícula afetada: <strong>" . htmlspecialchars($funcionario_atual['Matricula']) . "</strong></p>";
                    echo "<div style='background: #000; padding: 15px; display: inline-block; margin-top: 20px; border: 2px solid gold;'>";
                    echo "CADASTRO BIOMÉTRICO OBRIGATÓRIO AUSENTE NO BANCO DE DADOS";
                    echo "</div>";
                    echo "<p style='margin-top: 30px;'><button onclick='location.reload()' style='padding: 10px 20px; cursor: pointer;'>Tentar Novamente</button></p>";
                    echo "</div>";
                    
                    exit; // Interrompe o carregamento do resto da página
                }
            }
        }
    
        require_once dirname(__DIR__) . '/View/tabela_funcionarios.php';
    } 

    public function validarBiometria() {
        // 1. Captura o ID que o botão enviou via URL
        $id = $_GET['id'] ?? null;
    
        if (!$id) {
            header("Location: index.php?status=erro&msg=ID do funcionário não informado.");
            exit;
        }
    
        // 2. Chama o Model para verificar o banco sistema_iris_pro
        // Certifique-se de que o método verificarHashNoBanco existe no seu Model!
        $temHash = $this->funcionario->verificarHashNoBanco($id);
    
        // 3. Redireciona com o feedback visual
        if ($temHash) {
            header("Location: index.php?status=sucesso&msg=Sucesso! Biometria encontrada e válida.");
        } else {
            header("Location: index.php?status=erro&msg=Erro! Nenhum hash de íris encontrado para este usuário.");
        }
        exit;
    }
}
?>