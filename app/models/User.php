<?php

require_once __DIR__ . '/../../config/database.php';

class User
{
    private PDO $db;

    public function __construct()
    {
        $this->db = (new Database())->connect();
    }

    public function findByEmail($email)
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE email = ? LIMIT 1');
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function findById($id)
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE id = ? LIMIT 1');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data)
    {
        $sql = 'INSERT INTO users (name,email,password,phone,blood_group,location,availability,role,status)
                VALUES (?,?,?,?,?,?,?,?,?)';
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $data['name'],
            $data['email'],
            $data['password'],
            $data['phone'],
            $data['blood_group'] ?: null,
            $data['location'] ?: null,
            $data['availability'] ?? 'Not Available',
            $data['role'],
            $data['status'] ?? 'active'
        ]);
    }

    public function updatePassword($userId, $password)
    {
        $stmt = $this->db->prepare('UPDATE users SET password = ? WHERE id = ?');
        return $stmt->execute([$password, $userId]);
    }

    public function updateProfile($userId, $data)
    {
        $stmt = $this->db->prepare('UPDATE users SET name=?, phone=?, blood_group=?, location=? WHERE id=?');
        return $stmt->execute([
            $data['name'],
            $data['phone'],
            $data['blood_group'] ?: null,
            $data['location'] ?: null,
            $userId
        ]);
    }

    public function updateAvailability($userId, $availability)
    {
        $stmt = $this->db->prepare('UPDATE users SET availability=? WHERE id=? AND role="donor"');
        return $stmt->execute([$availability, $userId]);
    }

    public function resetPasswordByIdentity($email, $phone, $role, $password)
    {
        $stmt = $this->db->prepare('UPDATE users SET password=? WHERE email=? AND phone=? AND role=?');
        $stmt->execute([$password, $email, $phone, $role]);
        return $stmt->rowCount() > 0;
    }

    public function searchDonors($bloodGroup, $location = '')
    {
        $sql = 'SELECT id,name,email,phone,blood_group,location,availability
                FROM users
                WHERE role="donor" AND status="active" AND blood_group=? AND availability="Available"';
        $params = [$bloodGroup];
        if ($location !== '') {
            $sql .= ' AND location LIKE ?';
            $params[] = '%' . $location . '%';
        }
        $sql .= ' ORDER BY name ASC';
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function countByRole($role)
    {
        $stmt = $this->db->prepare('SELECT COUNT(*) FROM users WHERE role=?');
        $stmt->execute([$role]);
        return (int)$stmt->fetchColumn();
    }

    public function getAllByRole($role)
    {
        $stmt = $this->db->prepare('SELECT id,name,email,phone,blood_group,location,availability,role,status,created_at FROM users WHERE role=? ORDER BY id DESC');
        $stmt->execute([$role]);
        return $stmt->fetchAll();
    }

    public function getAll()
    {
        return $this->db->query('SELECT id,name,email,phone,blood_group,location,availability,role,status,created_at FROM users ORDER BY id DESC')->fetchAll();
    }

    public function updateStatus($id, $status)
    {
        $stmt = $this->db->prepare('UPDATE users SET status=? WHERE id=? AND role<>"admin"');
        return $stmt->execute([$status, $id]);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare('DELETE FROM users WHERE id=? AND role<>"admin"');
        return $stmt->execute([$id]);
    }
}
