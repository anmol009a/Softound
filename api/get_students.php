<?php

if ($_SERVER['REQUEST_METHOD'] !== 'GET'){
    exit;
}

header("Content-Type: application/json");

require_once '../models/Database.php';
require_once '../models/Student.php';

$database = new Database();
$db = $database->connect();
$student = new Student($db);

$students = $student->getStudents();

header('Content-Type: application/json');
echo json_encode($students);
