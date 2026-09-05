<?php

require_once __DIR__ . '/../../config/database.php';

class Donation
{
    private PDO $db;

    public function __construct()
    {
        $this->db = (new Database())->connect();
    }

    public function getByUserId($userId)
    {
        $sql = 'SELECT d.*,br.patient_name,br.blood_group,br.hospital_name AS request_hospital
                FROM donations d LEFT JOIN blood_requests br ON d.blood_request_id=br.id
                WHERE d.donor_id=? ORDER BY d.donation_date DESC,d.id DESC';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    public function getAll()
    {
        return $this->db->query('SELECT d.*,u.name AS donor_name,u.email AS donor_email,br.patient_name,br.blood_group
                                 FROM donations d JOIN users u ON d.donor_id=u.id
                                 LEFT JOIN blood_requests br ON d.blood_request_id=br.id ORDER BY d.donation_date DESC,d.id DESC')->fetchAll();
    }

    public function create($data)
    {
        $stmt = $this->db->prepare('INSERT INTO donations (donor_id,blood_request_id,donation_date,hospital_name,notes) VALUES (?,?,?,?,?)');
        return $stmt->execute([
            $data['donor_id'],
            $data['blood_request_id'] ?: null,
            $data['donation_date'],
            $data['hospital_name'] ?: null,
            $data['notes'] ?: null
        ]);
    }
}
