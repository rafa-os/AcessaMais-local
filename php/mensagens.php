<?php
// ===== MOSTRAR AS MENSAGENS SALVAS =====
// busca tudo que está na tabela mensagens e mostra numa tabela HTML

// 1. conecta no banco
include "conexao.php";

// 2. comando SQL: pega todas as mensagens, da mais nova pra mais antiga
$sql = "SELECT * FROM mensagens ORDER BY data_envio DESC";

// 3. manda pro banco; $resultado guarda todas as linhas que voltaram
$resultado = mysqli_query($conexao, $sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mensagens | Acessa+</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <main>
    <section class="secao">
      <div class="container">
        <h2>Mensagens enviadas</h2>
        <p><a href="../index.html#contato">Voltar para o site</a></p>

        <!-- mysqli_num_rows conta quantas linhas vieram do banco -->
        <?php if (mysqli_num_rows($resultado) == 0) { ?>
          <p>Nenhuma mensagem ainda. Envie a primeira pelo formulário!</p>
        <?php } else { ?>
          <table class="tabela">
            <tr>
              <th>Nome</th>
              <th>Tema</th>
              <th>Recurso favorito</th>
              <th>Mensagem</th>
              <th>Data</th>
            </tr>

            <!-- 4. o while pega uma linha do banco por vez, até acabar -->
            <!-- $linha["nome"] é o valor da coluna "nome" daquela linha -->
            <?php while ($linha = mysqli_fetch_assoc($resultado)) { ?>
              <tr>
                <td><?php echo $linha["nome"]; ?></td>
                <td><?php echo $linha["tema"]; ?></td>
                <td><?php echo $linha["recurso"]; ?></td>
                <td><?php echo $linha["mensagem"]; ?></td>
                <td><?php echo $linha["data_envio"]; ?></td>
              </tr>
            <?php } ?>
          </table>
        <?php } ?>
      </div>
    </section>
  </main>

  <!-- aplica as escolhas do painel aqui também -->
  <script src="../js/aplicar.js"></script>
</body>
</html>
<?php
// 5. fecha a conexão
mysqli_close($conexao);
?>
