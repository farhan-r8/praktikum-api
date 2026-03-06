<?php

header("Content-Type: application/json; charset=UTF-8");

include_once '../config/Database.php';
include_once '../models/Mahasiswa.php';

$database = new Database();
$db = $database->getConnection();

$mahasiswa = new Mahasiswa($db);

$stmt = $mahasiswa->read();

$data = array();
$data["records"] = array();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    extract($row);

    $item = array(
        "id" => $id,
        "npm" => $npm,
        "nama" => $nama,
        "jurusan" => $jurusan
    );

    array_push($data["records"], $item);
}

echo json_encode($data, JSON_PRETTY_PRINT);

?>