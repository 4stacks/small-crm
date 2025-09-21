<?php

namespace App\Core;

use PDO;

/**
 * Base Model Class
 */
abstract class Model
{
    /**
     * Database connection
     * @var PDO
     */
    protected $db;

    /**
     * Table name
     * @var string
     */
    protected $table;

    /**
     * Primary key
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /**
     * Find a record by ID
     * @param int $id
     * @return array|false
     */
    public function find($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE {$this->primaryKey} = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    /**
     * Get all records
     * @return array
     */
    public function all()
    {
        $sql = "SELECT * FROM {$this->table}";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Create a new record
     * @param array $data
     * @return int|false
     */
    public function create(array $data)
    {
        $fields = array_keys($data);
        $values = array_fill(0, count($fields), '?');
        
        $sql = "INSERT INTO {$this->table} (" . implode(', ', $fields) . ") 
                VALUES (" . implode(', ', $values) . ")";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array_values($data));
        
        return $this->db->lastInsertId();
    }

    /**
     * Update a record
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update($id, array $data)
    {
        $fields = array_keys($data);
        $set = implode('=?, ', $fields) . '=?';
        
        $sql = "UPDATE {$this->table} SET {$set} WHERE {$this->primaryKey} = ?";
        
        $values = array_values($data);
        $values[] = $id;
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($values);
    }

    /**
     * Delete a record
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE {$this->primaryKey} = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    /**
     * Find records by conditions
     * @param array $conditions
     * @return array
     */
    public function where(array $conditions)
    {
        $where = implode('=? AND ', array_keys($conditions)) . '=?';
        $sql = "SELECT * FROM {$this->table} WHERE {$where}";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array_values($conditions));
        return $stmt->fetchAll();
    }
}