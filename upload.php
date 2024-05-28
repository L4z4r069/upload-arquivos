<?php

// Definiu a pasta de destino
$pastaDestino = "/uploads/";

var_dump($_FILES);

var_dump($_FILES['arquivo']['size']);

//verificar se o tamanho do arquivo é maior que 2 MB
if($_FILES['arquivo']['size'] > 2000000)
/*
// Pegamos o nome do arquivo
$nomeArquivo = $_FILES['arquivo']['name'];


var_dump($_FILES['arquivo']['name']);

// Verificar se o arquivo já existe
if (file_exists(__DIR__ . $pastaDestino . $nomeArquivo)){
    echo "Arquivo já existe";
    exit;
}

var_dump(__DIR__ . $pastaDestino . $nomeArquivo);

if ($_FILES['arquivo']['size'] > 10000000){ //10M
    echo "Arquivo muito grande";
    exit;
}
*/
?>