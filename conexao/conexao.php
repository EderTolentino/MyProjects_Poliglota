<?php 
    

    // passo 1
    $servidor   = "localhost";
    $usuario    = "root";
    $senha      = "";
    $banco      = "poliglota";
    $conecta    = mysqli_connect($servidor,$usuario,$senha,$banco);

    // passo 2
    if ( mysqli_connect_errno()) {
        die("Conexão falhou: " . mysqli_connect_errno() );
    }
    
    

?>