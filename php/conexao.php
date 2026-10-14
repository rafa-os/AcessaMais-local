<?php
//salvar.php e mensagens.php puxam esse arquivo com "include"
//conexão escrita num lugar só

//dados pra entrar no MySQL (os mesmos do Workbench)
$servidor = "localhost";      //o banco está no próprio computador
$usuario = "root";            //usuário do MySQL
$senha = "root";              //senha do root
$banco = "acessibilidade";    //banco criado pelo banco.sql
$porta = 3306;                //porta padrão do MySQL

//abre a conexão e guarda em $conexao
//é por essa variável que os outros arquivos conversam com o banco
$conexao = mysqli_connect($servidor, $usuario, $senha, $banco, $porta);

//se não conectou, para tudo e mostra o motivo
//(os erros mais comuns: senha errada ou MySQL desligado)
if (!$conexao) {
    die("Erro ao conectar no banco: " . mysqli_connect_error());
}

//faz os acentos chegarem certinhos no banco
mysqli_set_charset($conexao, "utf8mb4");
?>
