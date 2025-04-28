<?php 
    include "../database/database.php";

    //CRUD
    //create (C)
    if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['nome'])) {
        $nome = (string)$_POST["nome"];
        $valor = (float)str_replace(",", ".", $_POST["valor"]);
        $quantidade_estoque = (int)$_POST["quantidade_estoque"];

        $sql = "INSERT INTO produtos (produto, valor, quantidade_estoque) VALUES (?, ?, ?)";

        $stmt = $connection->prepare($sql);
        $stmt->bind_param("sdi", $nome, $valor, $quantidade_estoque);
        $stmt->execute();

        header("Location: ../../frontend/src/pages/index.html"); 
    }
?>