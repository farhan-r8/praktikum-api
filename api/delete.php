<?php

header("Content-Type: application/json");

include_once '../config/Database.php';
include_once '../models/Mahasiswa.php';

$database = new Database();
$db = $database->getConnection();

$mahasiswa = new Mahasiswa($db);

$data = json_decode(file_get_contents("php://input"));

if(isset($data->id)){

    $mahasiswa->id = $data->id;

    if($mahasiswa->delete()){
        echo json_encode(["message" => "Data berhasil dihapus"]);
    }else{
        echo json_encode(["message" => "Data gagal dihapus"]);
    }

}else{
    echo json_encode(["message" => "ID tidak ditemukan"]);
}