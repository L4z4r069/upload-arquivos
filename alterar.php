<?php

$nome_arquivo = $_GET['nome_arquivo'];

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar arquivo</title>
</head>
<body>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        Alterando o arquivo <?= $nome_arquivo ?> <br>
        <input type="hidden" name="nome_arquivo">
        <input type="file" name="arquivo"> <br>
        <input type="submit" value="Upload Image" bname="submit"> <br>
    </form>
</body>
</html>