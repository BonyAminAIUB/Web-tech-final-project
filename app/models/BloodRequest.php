<?php

require_once __DIR__ . '/../../config/database.php';

class BloodRequest
{
    private PDO $db;

    public function __construct()
    {
        $this->db = (new Database())->connect();
    }

    public function create($data)
    {
        $sql = 'INSERT INTO blood_requests
                (user_id,patient_name,blood_group,location,contact_phone,required_date,hospital_name,urgency,description,request_status)
                VALUES (?,?,?,?,?,?,?,?,?,?)';
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $data['user_id'],
            $data['patient_name'],
            $data['blood_group'],
            $data['location'],
            $data['contact_phone'],
            $data['required_date'],
            $data['hospital_name'],
            $data['urgency'],
            $data['description'],
            'Pending'
        ]);
    }

    public function findById($id)
    {
        $stmt = $this->db->prepare('SELECT br.*,u.name AS requester_name,u.email AS requester_email,u.phone AS requester_phone
                                    FROM blood_requests br LEFT JOIN users u ON br.user_id=u.id
                                    WHERE br.id=? LIMIT 1');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function getByUserId($userId)
    {
        $stmt = $this->db->prepare('SELECT * FROM blood_requests WHERE user_id=? ORDER BY id DESC');
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    public function getAll()
    {
        return $this->db->query('SELECT br.*,u.name AS requester_name,u.email AS requester_email,u.phone AS requester_phone
                                 FROM blood_requests br LEFT JOIN users u ON br.user_id=u.id ORDER BY br.id DESC')->fetchAll();
    }

    public function getPending()
    {
        $stmt = $this->db->prepare('SELECT br.*,u.name AS requester_name,u.email AS requester_email,u.phone AS requester_phone
                                    FROM blood_requests br LEFT JOIN users u ON br.user_id=u.id
                                    WHERE br.request_status="Pending" ORDER BY br.id DESC');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function updateStatus($id, $status)
    {
        $stmt = $this->db->prepare('UPDATE blood_requests SET request_status=? WHERE id=?');
        return $stmt->execute([$status, $id]);
    }

    public function delete($id, $userId)
    {
        $stmt = $this->db->prepare('DELETE FROM blood_requests WHERE id=? AND user_id=?');
        return $stmt->execute([$id, $userId]);
    }

    public function countRequests()
    {
        return (int)$this->db->query('SELECT COUNT(*) FROM blood_requests')->fetchColumn();
    }

    public function countByStatus($status)
    {
        $stmt = $this->db->prepare('SELECT COUNT(*) FROM blood_requests WHERE request_status=?');
        $stmt->execute([$status]);
        return (int)$stmt->fetchColumn();
    }

    public function search($bloodGroup, $location = '')
    {
        $sql = 'SELECT br.*,u.name AS requester_name,u.email AS requester_email,u.phone AS requester_phone
                FROM blood_requests br LEFT JOIN users u ON br.user_id=u.id
                WHERE br.blood_group=? AND br.request_status="Pending"';
        $params = [$bloodGroup];
        if ($location !== '') {
            $sql .= ' AND br.location LIKE ?';
            $params[] = '%' . $location . '%';
        }
        $sql .= ' ORDER BY br.id DESC';
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
}
