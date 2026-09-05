CREATE DATABASE IF NOT EXISTS bloodconnect CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE bloodconnect;

SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS donations;
DROP TABLE IF EXISTS blood_requests;
DROP TABLE IF EXISTS users;
SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    blood_group VARCHAR(5) DEFAULT NULL,
    location VARCHAR(150) DEFAULT NULL,
    availability ENUM('Available','Not Available') NOT NULL DEFAULT 'Not Available',
    role ENUM('user','donor','admin') NOT NULL DEFAULT 'user',
    status ENUM('active','inactive') NOT NULL DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_role (role),
    INDEX idx_blood_group (blood_group),
    INDEX idx_availability (availability),
    INDEX idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE blood_requests (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    patient_name VARCHAR(100) NOT NULL,
    blood_group VARCHAR(5) NOT NULL,
    location VARCHAR(150) NOT NULL,
    contact_phone VARCHAR(20) NOT NULL,
    required_date DATE NOT NULL,
    hospital_name VARCHAR(150) DEFAULT NULL,
    urgency ENUM('Normal','Emergency') NOT NULL DEFAULT 'Normal',
    description TEXT DEFAULT NULL,
    request_status ENUM('Pending','Approved','Rejected','Completed') NOT NULL DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_request_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_request_user (user_id),
    INDEX idx_request_blood (blood_group),
    INDEX idx_request_status (request_status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE donations (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    donor_id INT UNSIGNED NOT NULL,
    blood_request_id INT UNSIGNED DEFAULT NULL,
    donation_date DATE NOT NULL,
    hospital_name VARCHAR(150) DEFAULT NULL,
    notes TEXT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_donation_donor FOREIGN KEY (donor_id) REFERENCES users(id) ON DELETE CASCADE,
    CONSTRAINT fk_donation_request FOREIGN KEY (blood_request_id) REFERENCES blood_requests(id) ON DELETE SET NULL,
    INDEX idx_donation_donor (donor_id),
    INDEX idx_donation_request (blood_request_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Demo admin account. Password: admin123
INSERT INTO users (name,email,password,phone,blood_group,location,availability,role,status)
VALUES ('System Administrator','admin@bloodconnectbd.com',
        '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC8v5u7mQv7Q1G3vG6qW',
        '01700000000',NULL,'Dhaka','Not Available','admin','active');
