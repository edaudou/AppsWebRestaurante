<?php
class TablesModel extends Model {

    public function getAllTables() {
        $this->query("SELECT * FROM tables ORDER BY table_number ASC");
        return $this->resultSet();
    }

    public function getAvailableTables() {
        $this->query("SELECT * FROM tables WHERE status = 'Disponible' ORDER BY table_number ASC");
        return $this->resultSet();
    }

    public function getTableById($id) {
        $this->query("SELECT * FROM tables WHERE id = :id");
        $this->bind(':id', $id);
        return $this->single();
    }

    public function addTable($data) {
        $this->query("INSERT INTO tables (table_number, capacity, status) VALUES (:table_number, :capacity, :status)");
        $this->bind(':table_number', $data['table_number']);
        $this->bind(':capacity', $data['capacity']);
        $this->bind(':status', $data['status']);
        return $this->execute();
    }

    public function updateTable($data) {
        $this->query("UPDATE tables SET table_number = :table_number, capacity = :capacity, status = :status WHERE id = :id");
        $this->bind(':id', $data['id']);
        $this->bind(':table_number', $data['table_number']);
        $this->bind(':capacity', $data['capacity']);
        $this->bind(':status', $data['status']);
        return $this->execute();
    }

    public function deleteTable($id) {
        $this->query("DELETE FROM tables WHERE id = :id");
        $this->bind(':id', $id);
        return $this->execute();
    }
}
?>
