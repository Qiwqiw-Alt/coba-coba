<?php
    require_once "db.php";

    class trx {
        private $db;

        public function __construct() {
            $database = new db();
            $this->db = $database->conn;
        }

        public function escape($data) {
            return $this->db->real_escape_string($data);
        }

        public function create($data) {
            $transaction_date = $this->escape($data['transaction_date']);
            $amount = $this->escape($data['amount']);
            $category = $this->escape($data['category']);
            $type = $this->escape($data['type']);
            $asset = $this->escape($data['asset']);
            $description = $this->escape($data['description']);

            $query = "INSERT INTO transactions 
            (transaction_date, amount, category, type, asset, description) 
            VALUES ('$transaction_date', '$amount', '$category', '$type', '$asset', '$description')";

            return $this->db->query($query);
        }

        public function getById($id) {
            $id = (int)$id; 
            $query = "SELECT * FROM transactions WHERE id = $id";
            $result = $this->db->query($query);
            return $result->fetch_assoc();
        }

        public function update($id, $data) {
            $id = (int)$id;
            $transaction_date = $this->escape($data['transaction_date']);
            $amount = $this->escape($data['amount']);
            $category = $this->escape($data['category']);
            $type = $this->escape($data['type']);
            $asset = $this->escape($data['asset']);
            $description = $this->escape($data['description']);

            $query = " UPDATE transactions SET transaction_date = '$transaction_date',
                        amount = '$amount',
                        category = '$category',
                        type = '$type',
                        asset = '$asset',
                        description = '$description'
                        WHERE id = '$id'";

            return $this->db->query($query);
        }

        public function delete($id) {
            $id = (int)$id;
            $query = "DELETE FROM transactions WHERE id = $id";
            return $this->db->query($query);
        }

        public function getError() {
            return $this->db->error;
        }

        public function getAll() {
            $query = "SELECT * FROM transactions ORDER BY transaction_date DESC, id DESC";
            return $this->db->query($query);
        }

        public function getTotalIncome() {
            $query = "SELECT SUM(amount) AS total_income FROM transactions WHERE type = 'Income'";
            $result = $this->db->query($query);
            $row = $result->fetch_assoc();
            return $row['total_income'] ?? 0;
        }

        public function getTotalOutcome() {
            $query = "SELECT SUM(amount) AS total_outcome FROM transactions WHERE type = 'Outcome'";
            $result =  $this->db->query($query);
            $row = $result->fetch_assoc();
            return $row['total_outcome'] ?? 0;
        }

    };
?>