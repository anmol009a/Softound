<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST'){
    exit;
}

header("Content-Type: application/json");

require_once '../models/Database.php';
require_once '../models/Student.php';

$database = new Database();
$db = $database->connect();
$student = new Student($db);

// Get query parameters
$data = json_decode(file_get_contents("php://input"));

$students = $student->findStudentsByMarks($data->marks);

header('Content-Type: application/json');
echo json_encode($students);
