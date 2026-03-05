<?php

header("Content-Type: application/json");

include_once '../config/Database.php';
include_once '../models/Mahasiswa.php';

$database = new Database();
$db = $database->getConnection();

$mahasiswa = new Mahasiswa($db);

$stmt = $mahasiswa->read();

$data = array();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    $data[] = $row;
}

echo json_encode($data);

?>