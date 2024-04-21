<?php

include_once 'db.php';

include_once 'operations.php';

// Endpoints like: index.php?action=list
$action = $_GET['action'] ?? null;
$id = $_GET['id'] ?? null;

switch ($action) {
    case 'list':
        echo listDoctors($pdo);
        break;
    case 'detail':
        if ($id !== null) {
            echo getDoctor($pdo, $id);
        } else {
            echo json_encode(['error' => 'Doctor ID is required']);
        }
        break;
    case 'availability':
        if ($id !== null) {
            echo checkAvailability($pdo, $id);
        } else {
            echo json_encode(['error' => 'Doctor ID is required']);
        }
        break;
    case 'book':
        $patientName = $_POST['patient_name'] ?? null;
        $date = $_POST['date'] ?? null;
        $time = $_POST['time'] ?? null;
        
        if ($id !== null && $patientName && $date && $time) {
            echo bookAppointment($pdo, $id, $patientName, $date, $time);
        } else {
            echo json_encode(['error' => 'Doctor ID, patient name, date, and time are required']);
        }
        break;
    default:
        echo json_encode(['error' => 'Invalid action']);
        break;
}

