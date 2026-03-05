<?php

header("Content-Type: application/json");

include_once '../config/Database.php';
include_once '../models/Mahasiswa.php';

$database = new Database();
$db = $database->getConnection();

$mahasiswa = new Mahasiswa($db);

$data = json_decode(file_get_contents("php://input"));

$mahasiswa->npm = $data->npm;
$mahasiswa->nama = $data->nama;
$mahasiswa->jurusan = $data->jurusan;

if($mahasiswa->create()){
    echo json_encode(["message"=>"Data berhasil ditambahkan"]);
}else{
    echo json_encode(["message"=>"Gagal menambahkan"]);
}

?>