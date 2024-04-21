<?php

$q1 = 'CREATE TABLE doctors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    specialty VARCHAR(255) NOT NULL,
    max_patients INT NOT NULL
)';

$q2 = 'CREATE TABLE availability (
    id INT AUTO_INCREMENT PRIMARY KEY,
    doctor_id INT NOT NULL,
    day_of_week VARCHAR(255) NOT NULL,
    time_slot VARCHAR(255) NOT NULL,
    FOREIGN KEY (doctor_id) REFERENCES doctors(id)
)';

$q3 = 'CREATE TABLE appointments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    doctor_id INT NOT NULL,
    patient_name VARCHAR(255) NOT NULL,
    appointment_date DATE NOT NULL,
    appointment_time TIME NOT NULL,
    FOREIGN KEY (doctor_id) REFERENCES doctors(id)
)';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $pdo->exec($q1);
    $pdo->exec($q2);
    $pdo->exec($q3);
    
    echo 'Tables created successfully';
} catch (PDOException $e) {
    die("Error creating tables: " . $e->getMessage());
}
