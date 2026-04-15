<?php
// Verifique se o caminho para o Database-pro está correto (depende de onde este arquivo está)
require_once '../config/Database-pro.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['matricula'])) {
    $database = new Database_pro();
    $db = $database->getConnection();
    $matricula = $_POST['matricula'];

    try {
        // Query para deletar o hash baseado na matrícula do funcionário
        $sql = "DELETE b FROM biometria_iris b 
                JOIN funcionarios f ON b.funcionario_id = f.id_funcionario 
                WHERE f.matricula = :mat";
        
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':mat', $matricula);
        $stmt->execute();

        // Volta para a página inicial (ajuste o caminho se necessário)
        header("Location: ../index/index.php"); 
        exit();
    } catch (PDOException $e) {
        echo "Erro ao resetar: " . $e->getMessage();
    }
}