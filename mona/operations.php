<?php

function listDoctors($pdo) {
    $stmt = $pdo->query("SELECT * FROM doctors");
    return json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
}

function getDoctor($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM doctors WHERE id = ?");
    $stmt->execute([$id]);
    $doctor = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($doctor) {
        return json_encode($doctor);
    } else {
        return json_encode(['error' => 'Doctor not found']);
    }
}

function checkAvailability($pdo, $id) {
    $stmt = $pdo->prepare("SELECT day_of_week, time_slot FROM availability WHERE doctor_id = ?");
    $stmt->execute([$id]);
    $availability = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if ($availability) {
        return json_encode(['availability' => $availability]);
    } else {
        return json_encode(['error' => 'Availability not found']);
    }
}

function bookAppointment($pdo, $id, $patientName, $date, $time) {
    $stmt = $pdo->prepare("INSERT INTO appointments (doctor_id, patient_name, appointment_date, appointment_time) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$id, $patientName, $date, $time])) {
        return json_encode(['message' => 'Appointment booked successfully']);
    } else {
        return json_encode(['error' => 'Failed to book appointment']);
    }
}