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

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->name) && !empty($data->address) && !empty($data->marks)) {
    if ($student->addStudent($data->name, $data->address, $data->marks)) {
        echo json_encode(["message" => "Student added successfully"]);
    } else {
        echo json_encode(["message" => "Student could not be added"]);
    }
} else {
    echo json_encode(["message" => "Incomplete data"]);
}
?>
