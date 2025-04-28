<?php 
    include "../database/database.php";

    if($_SERVER["REQUEST_METHOD"] === "POST") {
        $id = (int)$_POST["id"];
        $nome = (string)$_POST["nome"];
        $valor = (float)str_replace(",", ".", $_POST["valor"]);
        $quantidade_estoque = (int)$_POST["quantidade_estoque"];

        $sql = "UPDATE produtos SET produto=?, valor=?, quantidade_estoque=? WHERE id=?";

        $stmt = $connection->prepare($sql);
        $stmt->bind_param("sdii", $nome, $valor, $quantidade_estoque, $id);
        $stmt->execute();
    } else {
        echo("Erro ao atualizar o produto!");
    }
?>