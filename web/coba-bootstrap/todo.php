<?php
require_once 'db.php';

class todo {
    private $db;

    public function __construct(){
       $database = new db();
       $this->db = $database->conn;
    }

    public function escape($data) {
        return $this->db->real_escape_string($data);
    }

    public function create($data) {
        $task = $this->escape($data['task']);
        $description = $this->escape($data['description']);
        $is_completed = isset($data['is_completed']) ? (int)$data['is_completed'] : 0;

        $query = "INSERT INTO todos (task, description, is_completed) VALUES ('$task', '$description', '$is_completed')";

        return $this->db->query($query);
    }

    public function getById($id) {
        $id = (int)$id; 
        $query = "SELECT * FROM todos WHERE id = $id";
        $result = $this->db->query($query);
        return $result->fetch_assoc();
    }

    public function update($id, $data) {
        $id = (int)$id;
        $task = $this->escape($data['task']);
        $description = $this->escape($data['description']);
        $is_completed = $this->escape($data['is_completed']);

        $query = " UPDATE todos SET task = '$task',
                    description = '$description',
                    is_completed = '$is_completed'
                    WHERE id = '$id'";

        return $this->db->query($query);
    }

    public function delete($id) {
        $id = (int)$id;
        $query = "DELETE FROM todos WHERE id = $id";
        return $this->db->query($query);
    }

    public function deleteAll() {
        $query = "DELETE FROM todos";
        return $this->db->query($query);
    }

    public function getError() {
        return $this->db->error;
    }

    public function getAll() {
        $query = "SELECT * FROM todos";
        return $this->db->query($query);
    }

};
?>