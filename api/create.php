<?php

header("Content-Type: application/json; charset=UTF-8");

include_once '../config/Database.php';
include_once '../models/Mahasiswa.php';

$database = new Database();
$db = $database->getConnection();

$mahasiswa = new Mahasiswa($db);

// ambil data JSON dari body
$data = json_decode(file_get_contents("php://input"));

// validasi input
if(
    !empty($data->npm) &&
    !empty($data->nama) &&
    !empty($data->jurusan)
){

    $mahasiswa->npm = $data->npm;
    $mahasiswa->nama = $data->nama;
    $mahasiswa->jurusan = $data->jurusan;

    if($mahasiswa->create()){

        echo json_encode(
            array(
                "status" => "success",
                "message" => "Data berhasil ditambahkan"
            ),
            JSON_PRETTY_PRINT
        );

    }else{

        echo json_encode(
            array(
                "status" => "error",
                "message" => "Gagal menambahkan data"
            ),
            JSON_PRETTY_PRINT
        );

    }

}else{

    echo json_encode(
        array(
            "status" => "error",
            "message" => "Data tidak lengkap"
        ),
        JSON_PRETTY_PRINT
    );

}

?>