<?php 
    $connection = new mysqli("localhost", "root", "", "simple-crud");

    if($connection->connect_error) {
        header("Content-Type: application/json");
        echo json_encode(["error: " => "Não foi possível fazer a conexão! " . $connection->connect_error]);

        exit();
    }
?>