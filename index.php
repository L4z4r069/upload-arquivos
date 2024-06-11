<?php
$conexao = mysqli_connect("localhost","root","","upload_arquivo");
$sql = "SELECT * FROM arquivo";
$resultado = mysqli_query($conexao, $sql);
if ($resultado != false) {
    $arquivos = mysqli_fetch_all($resultado, MYSQLI_BOTH);
} else {
    echo "Erro ao executar comando SQL.";
    die();
} 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="upload.php" method="post" enctype="multipart/form-data">
    Selecione a imagem para dar upload: <br>
        <input type="file" name="arquivo"> <br>
        <input type="submit" value="Upload Image" bname="submit"> <br>
</form>
<br> <br>
<table border="2">
    <thead>
        <tr>
             <th>Nome do Arquivo</th>
             <th colspan="2">Opções</th>
        </tr>
    </thead>
    <tbody>
     <?php
     foreach ($arquivos as $arquivo) {
        $arq = $arquivo['nome_arquivo'];

        echo "<tr>"; //Iniciar a linha
        echo "<td>$arq</td>"; // 1ª coluna  com o nome do arquivo
        echo "<td>"; //Iniciar a 2ª coluna
        echo "<a "; //Abriu o link (abriu a tag "A")
        echo "href='alterar?nome_arquivo=$arq'>"; //Inserir o link
        echo "Alterar"; // Imprimiu o texto da tag "A"
        echo "</a>"; //Fechei o link
        echo "</td>"; // Fechei a 2ª coluna
        echo "<td>"; // Abri a 3ª coluna
        echo "<button "; // Abrir o botão
        echo "onclick="; // Criou o atributo onclick    
        echo "'excluir(\"$arq\");'>"; // Chamamos a função excluir
        echo "Excluir"; // Mostrar o texto do botão
        echo "</button>"; // Fechar o botão
        echo "</td>"; // Fechar a linha

     }
     ?>
    </tbody>
    </table>

    <script>

        function excluir(nome_arquivo) {
            let deletar = confirm("Você tem certeza que deseja excluir o arquivo " + nome_arquivo + "?");
            if (deletar == true) {
                window.location.href = "deletar.php?nome_arquivo=" + nome_arquivo;
            }
        }

    </script>
</body>
</html>