<?php 
    include "../database/database.php";

    //delete (D)
    if($_SERVER["REQUEST_METHOD"] === "DELETE") {
        $id = (int)$_GET["id"];

        $nome = (string)$_POST["nome"];
        $valor = (float)str_replace(",", ".", $_POST["valor"]);
        $quantidade_estoque = (int)$_POST["quantidade_estoque"];

        $sql = "DELETE FROM produtos WHERE id = ?";

        //previnir sql injection e execução da query
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
?>