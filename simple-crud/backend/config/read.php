<?php 
    include "../database/database.php";

    header("Content-Type: application/json");

     //read (R)
    $sql = "SELECT * FROM produtos";
    $result = $connection->query($sql);

    if($result && $result->num_rows > 0) {
        $produtos = [];

        while ($row = $result->fetch_assoc()) {
            $produtos[] = $row;
        }

        //faz um json para um fetch com javascript
        echo json_encode($produtos);
    } else {
        //retorna um array vazio
        echo json_encode([]);
    }
?>