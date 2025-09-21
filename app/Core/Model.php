<?php
namespace App\Core;

abstract class Model {
    protected $db;
    protected $table;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function findAll() {
        $result = $this->db->query("SELECT * FROM {$this->table}");
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function findById($id) {
        $id = $this->db->escapeString($id);
        $result = $this->db->query("SELECT * FROM {$this->table} WHERE id = '{$id}' LIMIT 1");
        return mysqli_fetch_assoc($result);
    }

    public function create($data) {
        $keys = array_keys($data);
        $values = array_map([$this->db, 'escapeString'], array_values($data));
        $query = "INSERT INTO {$this->table} (" . implode(',', $keys) . ") 
                 VALUES ('" . implode("','", $values) . "')";
        return $this->db->query($query);
    }

    public function update($id, $data) {
        $id = $this->db->escapeString($id);
        $updates = [];
        foreach ($data as $key => $value) {
            $value = $this->db->escapeString($value);
            $updates[] = "{$key} = '{$value}'";
        }
        $query = "UPDATE {$this->table} SET " . implode(',', $updates) . " WHERE id = '{$id}'";
        return $this->db->query($query);
    }

    public function delete($id) {
        $id = $this->db->escapeString($id);
        return $this->db->query("DELETE FROM {$this->table} WHERE id = '{$id}'");
    }
}