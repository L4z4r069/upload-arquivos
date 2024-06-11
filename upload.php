<?php
// definiu a pasta de destino
$pastadestino = "./uploads/";
var_dump($_FILES);
//imprimir o tamanho do arquivo
var_dump($_FILES['arquivo']['size']);
//pegamos o nome do arquivo
$nomeArquivo = $_FILES['arquivo']['name'];

//verificar se o arquivo ja existe
if (file_exists(__DIR__ . $pastadestino . $nomeArquivo)) {
    echo "arquivo ja existe";
    exit;
}

var_dump(__DIR__ . $pastadestino . $nomeArquivo);

//verificar se o tamanho esperarado é maior que 10mb
if ($_FILES['arquivo']['size'] > 10000000) { //10M
    echo "arquivo muito grande";
    exit;
}
//verificar se o arquivo é uma imagem
$extensao = strtolower(pathinfo($nomeArquivo, PATHINFO_EXTENSION));
var_dump($_FILES['arquivo']['name']);
var_dump(pathinfo($_FILES['arquivo']['name'], PATHINFO_FILENAME));

if ($extensao != "jpg" && $extensao != "png" && $extensao != "gif" && $extensao != "jfif" && $extensao != "svg") {
    echo "Isso nao é uma imagem";
    exit;
}



// verificar se é uma imagem de fato
if (getimagesize($_FILES['arquivo']['tmp_name']) === false) {
    echo "Problemas ao enviar a imagem. Tente novamente.";
    die();
}

$nomearq = uniqid();
//se deu certo até aqui
$fezupload = move_uploaded_file($_FILES['arquivo']['tmp_name'], __DIR__ . $pastadestino . $nomearq . "." . $extensao);


if ($fezupload == true) {
    $conexao = mysqli_connect("localhost", "root", "", "upload_arquivo");
    $sql = "INSERT INTO arquivo (nome_arquivo) VALUES ('$nomearq.$extensao')";
    $resultado = mysqli_query($conexao, $sql);
    if ($resultado != false) {
        // se for uma alteração de arquivo
        if (isset($_POST['nome_arquivo'])) {
            $apagou = unlink(__DIR__ . $pastadestino . $_POST['nome_arquivo']);
            if ($apagou == true) {
                $sql = "DELETE FROM arquivo WHERE nome_arquivo='" . $_POST['nome_arquivo'] . "'";
                $resultado2 = mysqli_query($conexao, $sql);
                if ($resultado2 == false) {
                    echo "Erro ao apagar o arquivo do banco de dados.";
                    die();
                }
            } else {
                echo "Erro ao apagar o arquivo antigo.";
                die();
            }
        }
        header("location:index.php");
    } else {
        echo "erro ao mover arquivo";
    }
} else {
    echo "Erro ao registrar o arquivo no banco de dados.";
}
