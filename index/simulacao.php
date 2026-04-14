<?php
require_once '../config/Database-pro.php';


$database = new Database_pro();
$db = $database->getConnection();


$funcionario_id = "uuid-ana-002"; 
$dados_falsos_iris = "padrão_ocular_aleatorio_" . rand(1000, 9999);

$hash_iris = hash('sha256', $dados_falsos_iris);

try {
    $sql = "INSERT INTO biometria_iris (funcionario_id, hash_iris, algoritmo_versao) 
            VALUES (:id, :hash, 'simulador_v1')";
    
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $funcionario_id);
    $stmt->bindParam(':hash', $hash_iris);
    
    $stmt->execute();
    echo "### Simulação de Biometria concluída com sucesso! ###\n";
    echo "Hash gerado: " . $hash_iris;
} catch (PDOException $e) {
    echo "Erro ao simular: " . $e->getMessage();
}
?>