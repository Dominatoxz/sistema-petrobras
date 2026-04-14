<?php
class Database_pro {
    private $db_name = "sistema_iris_pro";
    private $host = "localhost";
    private $user = "root";
    private $password = "alunolab";
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->user, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Erro na conexão Pro: " . $e->getMessage();
        }
        return $this->conn;
    }
}
?>