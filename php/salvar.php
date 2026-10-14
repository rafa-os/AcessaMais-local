<?php
// ===== SALVAR A MENSAGEM NO BANCO =====
// o formulário do index.html manda os dados pra cá
// (por causa do action="php/salvar.php" e method="POST")
//
// caminho: formulário → salvar.php → INSERT → tabela mensagens

// 1. conecta no banco (traz a variável $conexao do conexao.php)
include "conexao.php";

// 2. pega o que a pessoa digitou no formulário
// $_POST["nome"] é o campo que tem name="nome" lá no HTML
// o mysqli_real_escape_string arruma as aspas do texto
// (sem ele, uma mensagem como "copo d'água" quebra o comando SQL)
$nome     = mysqli_real_escape_string($conexao, $_POST["nome"]);
$email    = mysqli_real_escape_string($conexao, $_POST["email"]);
$tema     = mysqli_real_escape_string($conexao, $_POST["tema"]);
$recurso  = mysqli_real_escape_string($conexao, $_POST["recurso"]);
$mensagem = mysqli_real_escape_string($conexao, $_POST["mensagem"]);

// 3. monta o comando SQL que cria uma linha nova na tabela
// o id e a data_envio o próprio banco preenche
$sql = "INSERT INTO mensagens (nome, email, tema, recurso, mensagem)
        VALUES ('$nome', '$email', '$tema', '$recurso', '$mensagem')";

// 4. manda o comando pro banco
// $deuCerto vira true se salvou, ou false se deu algum erro
$deuCerto = mysqli_query($conexao, $sql);

// 5. fecha a conexão (já terminamos de usar o banco)
mysqli_close($conexao);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Envio da mensagem | Acessa+</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <main>
    <section class="secao">
      <div class="container">

        <!-- 6. mostra uma mensagem diferente se salvou ou não -->
        <?php if ($deuCerto) { ?>
          <h2>✓ Mensagem enviada!</h2>
          <p>Obrigado! Sua mensagem foi salva no banco de dados.</p>
        <?php } else { ?>
          <h2>✕ Não foi possível enviar</h2>
          <p>Algo deu errado ao salvar. Tente de novo.</p>
        <?php } ?>

        <a href="../index.html#contato" class="botao">Voltar para o site</a>
        <a href="mensagens.php" class="botao">Ver mensagens enviadas</a>
      </div>
    </section>
  </main>

  <!-- aplica as escolhas do painel aqui também -->
  <script src="../js/aplicar.js"></script>
</body>
</html>
