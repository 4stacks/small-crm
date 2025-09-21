<?php

namespace App\Models;

use App\Core\Model;

class User extends Model
{
    protected $table = 'users';
    protected $fillable = ['name', 'email', 'password', 'phone', 'type'];

    /**
     * Authenticate user
     * @param string $email
     * @param string $password
     * @return array|false
     */
    public function authenticate($email, $password)
    {
        $user = $this->findByEmail($email);
        
        if ($user && $this->verifyPassword($password, $user['password'])) {
            unset($user['password']); // Don't return password hash
            return $user;
        }
        
        return false;
    }

    /**
     * Find user by email
     * @param string $email
     * @return array|false
     */
    public function findByEmail($email)
    {
        $sql = "SELECT * FROM {$this->table} WHERE email = :email LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }

    /**
     * Create a new user
     * @param array $data
     * @return int|false
     */
    public function create(array $data)
    {
        if (isset($data['password'])) {
            $data['password'] = $this->hashPassword($data['password']);
        }
        
        return parent::create($data);
    }

    /**
     * Update user
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update($id, array $data)
    {
        if (isset($data['password'])) {
            $data['password'] = $this->hashPassword($data['password']);
        }
        
        return parent::update($id, $data);
    }

    /**
     * Verify password
     * @param string $password
     * @param string $hash
     * @return bool
     */
    public function verifyPassword($password, $hash)
    {
        return password_verify($password, $hash);
    }

    /**
     * Hash password
     * @param string $password
     * @return string
     */
    private function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * Change user password
     * @param int $id
     * @param string $oldPassword
     * @param string $newPassword
     * @return bool
     */
    public function changePassword($id, $oldPassword, $newPassword)
    {
        $user = $this->find($id);
        
        if ($user && $this->verifyPassword($oldPassword, $user['password'])) {
            return $this->update($id, ['password' => $newPassword]);
        }
        
        return false;
    }
}