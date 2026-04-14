<?php
class Database_infos {
    private $db_name = "sistema_infos";
    private $host = "localhost";
    private $user = "root";
    private $password = "alunolab";
    public $conn;

    public function getConnection() {
        $this -> conn = null;
        try {
            $this -> conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->user, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            echo "Erro na conexão". $e->getMessage();
        }
        return $this->conn;
    }

}
?>