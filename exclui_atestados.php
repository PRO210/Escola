<?php
ob_start();
include_once 'valida_cookies.inc';
//Abre a conexão com o banco de dados
include_once './inc.conf.php';
$Conexao = mysqli_connect("127.0.0.1", $Usuario, $Senha, $Base);
mysqli_set_charset($Conexao, "utf8");
//
$nomes = "";
foreach (($_POST['servidor_selecionado']) as $lista_id) {
//
    $Consuta_backup = mysqli_query($Conexao, "SELECT * FROM atestados_servidor WHERE id = '$lista_id' ");
//
    while ($row_backup = mysqli_fetch_array($Consuta_backup)) {
//
        $nomebackup = $row_backup['servidor'];
        $nomes .= $nomebackup . ",";
        $nomes2 = substr($nomes, 0, -1);
    }
}
//EXCLUI OS ATESTADOS DA TABELA ATESTADOS_SERVIDOR
foreach ($_POST['servidor_selecionado'] as $lista_id) {
//
    $Consulta = mysqli_query($Conexao, "UPDATE `atestados_servidor` SET `excluido`= 'S' WHERE `id` = '$lista_id' ");
    //
}
//
if ($Consulta) {
//
    $SQL_logar2 = "INSERT INTO log (`usuario`, `acao`,`data`) "
            . "VALUES ( '$usuario_logado', 'Excluiu o(s) Atestado(s): $nomes2', now())";
    $Consulta3 = mysqli_query($Conexao, $SQL_logar2);
    header("location: pesquisar_atestado.php?id=6");
} else {
    echo "Deculpa ocorreu um erro";
}