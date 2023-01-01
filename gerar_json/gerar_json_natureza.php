<?php require_once("../conexao/conexao.php"); ?>

<?php

    // Configurações gerais
    header('Acces-Control-Allow-Origin:*');


    // Abrir conexão
    //$conecta = mysqli_connect("localhost","root","","andes");

    $selecao = "SELECT * FROM natureza WHERE ID >= 1 ";
    $categoria_escolhida = mysqli_query($conecta, $selecao);

    $retorno = array();
    while($linha = mysqli_fetch_object($categoria_escolhida)) {
        $retorno[] = $linha;
        
    }

    echo json_encode($retorno);

    // Fechar conexão
    mysqli_close($conecta);
?>