<?php
    class Funcionario {
        private $conn_infos;
        private $conn_iris;

        public function __construct($db_infos, $db_iris = null){
            $this->conn_infos = $db_infos;
            $this->conn_iris = $db_iris;
        }

        public function buscarTodosComIris(){
            $query = "SELECT 
                    f.nome_completo AS 'Funcionário',
                    f.registro_corporativo AS 'Matricula',
                    fun.nome_funcao AS 'Cargo',
                    n.descricao_nivel AS 'Nível',
                    a.data_inicio AS 'Data de Início'
                FROM atribuicao_colaborador a
                JOIN funcionario f ON a.id_funcionario = f.id_funcionario
                JOIN funcao fun ON a.id_funcao = fun.id_funcao
                JOIN nivel n ON a.id_nivel = n.id_nivel
                ORDER BY f.nome_completo;";

            $stmt = $this->conn_infos->prepare($query);
            $stmt->execute();
            $funcionarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($this->conn_iris){
                foreach ($funcionarios as &$f) {
                    $sql_iris = "SELECT b.hash_iris, b.funcionario_id 
                                FROM funcionarios func
                                JOIN biometria_iris b ON func.id_funcionario = b.funcionario_id
                                WHERE func.matricula = :mat";
                
                    $stmt_iris = $this->conn_iris->prepare($sql_iris);
                    $stmt_iris->bindParam(':mat', $f['Matricula']);
                    $stmt_iris->execute();
                    $dados_iris = $stmt_iris->fetch(PDO::FETCH_ASSOC);
                
                    // Verificamos se $dados_iris existe antes de acessar as chaves
                    if ($dados_iris) {
                        $f['Iris_Hash'] = $dados_iris['hash_iris'];
                        $f['id_funcionario_iris'] = $dados_iris['funcionario_id'];
                    } else {
                        $f['Iris_Hash'] = 'Não Registrado';
                        $f['id_funcionario_iris'] = null;
                    }
                
            }
            return $funcionarios;

        }

    }

}
?>