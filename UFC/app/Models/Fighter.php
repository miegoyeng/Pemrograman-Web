<?php

namespace app\Models;

include "app/Config/DatabaseConfig.php";

use app\Config\DatabaseConfig;
use mysqli;

class Fighter extends DatabaseConfig {
    public $conn;

    public function __construct() {
        // Connect ke database MySQL
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->database_name, $this->port);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Function menampilkan semua data fighter
    public function findAll() {
        $sql = "SELECT * FROM fighters";  // Mengambil semua data fighter
        $result = $this->conn->query($sql);
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    // Function menampilkan data fighter berdasarkan ID
    public function findById($id) {
        $sql = "SELECT * FROM fighters WHERE id = ?";  // Mengambil fighter berdasarkan ID
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    // Function untuk membuat fighter baru
    public function create($data) {
        $name = $data['name'];  
        $weightClass = $data['weight_class'];  
        $record = $data['record'];  
        $country = $data['country'];
    
        // Query untuk insert data fighter
        $query = "INSERT INTO fighters (name, weight_class, record, country) VALUES (?, ?, ?, ?)";  
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssss", $name, $weightClass, $record, $country);  
        $stmt->execute();
    }

    // Function untuk update fighter
    public function update($data, $id) {
        $name = $data['name'];  
        $weightClass = $data['weight_class'];  
        $record = $data['record'];  
        $country = $data['country'];  
    
        // Query untuk update data fighter
        $query = "UPDATE fighters SET name = ?, weight_class = ?, record = ?, country = ? WHERE id = ?";  
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssssi", $name, $weightClass, $record, $country, $id); 
        $stmt->execute();
    }

    // Function untuk menghapus fighter berdasarkan ID
    public function delete($id) {
        $query = "DELETE FROM fighters WHERE id = ?";  // Query untuk menghapus fighter berdasarkan ID
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
}
?>
