<?php

header("Content-Type: application/json; charset=UTF-8");

include_once '../config/Database.php';
include_once '../models/Mahasiswa.php';

$database = new Database();
$db = $database->getConnection();

$mahasiswa = new Mahasiswa($db);


$data = json_decode(file_get_contents("php://input"));


if (!empty($data->id)) {

    $mahasiswa->id = $data->id;

    if ($mahasiswa->delete()) {

        echo json_encode(
            array(
                "status" => "success",
                "message" => "Data berhasil dihapus"
            ),
            JSON_PRETTY_PRINT
        );

    } else {

        echo json_encode(
            array(
                "status" => "error",
                "message" => "Data gagal dihapus"
            ),
            JSON_PRETTY_PRINT
        );

    }

} else {

    echo json_encode(
        array(
            "status" => "error",
            "message" => "ID tidak ditemukan"
        ),
        JSON_PRETTY_PRINT
    );

}