# Acessa+ | Acessibilidade Digital para TDAH e Daltonismo

Projeto da disciplina **Programação Front-end II** (SENAI São Paulo), Prof.ª Noemi.

## Integrantes

- Daniel
- Rafael
- Sophia

## Perfil de acessibilidade

**TDAH + Daltonismo**: reduzir distrações e melhorar a visualização.

## Objetivo

Criar um site que explica o que é acessibilidade digital, mostra as barreiras que pessoas com TDAH e daltonismo podem encontrar na internet e traz um **Painel de Acessibilidade** com 8 recursos para adaptar a página.

Barreiras que consideramos:

- **TDAH:** páginas com muitos elementos, animações e informações desorganizadas, que dificultam manter a atenção.
- **Daltonismo:** informações passadas só pela cor (ex.: vermelho = ocupado, verde = livre).

## Tecnologias

- HTML
- CSS
- JavaScript (sem bibliotecas)
- PHP (recebe o formulário)
- MySQL 8 (banco de dados), gerenciado pelo **MySQL Workbench 8.0**
- XAMPP (usamos só o **Apache**, para rodar o PHP)

## Estrutura de pastas

```
AcessaMais-local/
├── index.html          → página do site (conteúdo + formulário)
├── painel.html         → página do painel (abre no canto do site)
├── css/style.css       → visual do site e dos recursos
├── js/aplicar.js       → roda em todas as páginas: aplica as escolhas e abre/fecha o painel
├── js/painel.js        → roda só no painel: funções dos botões
├── img/                → imagens do site
├── php/
│   ├── conexao.php     → conecta no banco
│   ├── salvar.php      → recebe o formulário e salva no banco
│   └── mensagens.php   → mostra as mensagens salvas
└── banco/banco.sql     → cria o banco e a tabela
```

## Os 8 recursos do painel

| # | Recurso | Para que serve? | Por que escolhemos? |
|---|---------|-----------------|---------------------|
| 1 | **Modo foco** | Esconde a imagem decorativa do início e para a animação dela. | Excesso de elementos e movimento tira a atenção de quem tem TDAH. |
| 2 | **Modo daltonismo** | Troca as cores do site por uma paleta segura para daltonismo (Okabe-Ito: azul, laranja e verde-azulado), coloca ✕ e ✓ nas bolinhas, deixa os links em negrito com sublinhado grosso, coloca uma seta nas frases importantes e listras na tabela. | Muitas pessoas com daltonismo confundem vermelho e verde. Além de trocar as cores, o modo adiciona marcas que não dependem de cor. |
| 3 | **Ler com voz** | Depois de ligado no painel, o navegador lê em voz alta o texto que a pessoa selecionar com o mouse. | Ouvir o texto ajuda a manter o foco e facilita a compreensão. |
| 4 | **Tamanho do texto** | Botões A+ e A− aumentam ou diminuem as letras (de 80% a 150%). | Texto maior cansa menos e facilita a leitura. |
| 5 | **Espaçamento** | Aumenta o espaço entre letras, palavras e linhas. | Separa o texto "grudado", o que deixa a leitura mais tranquila. |
| 6 | **Alto contraste** | Deixa o fundo preto, o texto branco e os destaques em amarelo. | Cores bem diferentes entre si ajudam quem tem dificuldade para diferenciar tons. |
| 7 | **Escala de cinza** | Tira as cores da página. | Mostra se o site depende só da cor para passar informação e reduz estímulos visuais. |
| 8 | **Destacar informações** | Marca os links e pinta de amarelo os trechos importantes. | Ajuda a achar rápido o que importa na página. |

Também tem o botão **Restaurar configurações**, que volta tudo ao normal.

Detalhe pensado para daltonismo: quando um recurso está ligado, o botão ganha a classe `ativo`, muda de cor **e** aparece um ✓, então não depende só da cor para saber se está ativo.

## Como o painel funciona

O painel é uma **página HTML separada** (`painel.html`). No site, ela abre pequena no canto da tela, dentro de um `<iframe>`, quando a pessoa clica em **♿ Acessibilidade**.

As escolhas ficam salvas no navegador com `localStorage`, então valem em todas as páginas e continuam ligadas mesmo depois de fechar o navegador.

**Quando a pessoa clica em um recurso:**

```
Clique no botão do painel
↓
onclick chama alternar('alto-contraste', this)
↓
Salva "ligado" no localStorage e marca o botão com ✓
↓
Chama aplicarConfiguracoes() no site (parent)
↓
O site coloca a classe "alto-contraste" no <body>
↓
CSS da classe muda a página
```

**Quando qualquer página abre:**

```
aplicar.js lê o localStorage
↓
Coloca no <body> as classes que estão salvas
↓
CSS dessas classes muda a página
```

## Integração com o banco de dados

```
Formulário (index.html)
↓  a pessoa clica em "Enviar mensagem"
Os dados vão por POST para o php/salvar.php
↓
salvar.php conecta no banco (conexao.php)
↓
Pega os dados com $_POST["nome"], $_POST["email"]...
↓
Executa INSERT INTO mensagens (...) VALUES (...)
↓
O MySQL guarda uma linha nova na tabela "mensagens"
```

- **Onde o formulário é criado:** `index.html`, na seção "Deixe sua opinião".
- **Como os dados são enviados:** `<form action="php/salvar.php" method="POST">`.
- **Qual código processa:** `php/salvar.php`. Ele conecta no banco (`include "conexao.php"`), pega os dados com `$_POST`, monta o comando `INSERT INTO mensagens ...` e executa com `mysqli_query`.
- **Qual tabela armazena:** `mensagens`, no banco `acessibilidade` (id, nome, email, tema, recurso, mensagem, data_envio).
- **Como verificar os dados:** pela página `php/mensagens.php` (link "Ver mensagens enviadas") ou pelo MySQL Workbench com `SELECT * FROM mensagens;`.

## Como executar

**1. Criar o banco no MySQL Workbench**

1. Abra o **MySQL Workbench 8.0** e entre na conexão `Local instance MySQL80` (usuário `root`).
2. Vá em **File → Open SQL Script** e abra `banco/banco.sql`.
3. Clique no **raio ⚡ (Execute)**. O banco `acessibilidade` e a tabela `mensagens` serão criados.
4. Clique em **atualizar (🔄)** no painel *Schemas* para ver o banco na lista.

**2. Configurar a conexão no PHP**

O arquivo `php/conexao.php` já está com usuário `root` e senha `root`. Se o MySQL de outro computador tiver outra senha, é só trocar lá.

**3. Rodar o site**

1. Abra o **XAMPP** e ligue **só o Apache** (não ligue o MySQL do XAMPP, porque o MySQL do Workbench já usa a porta 3306).
2. Copie a pasta `AcessaMais-local` para `C:\xampp\htdocs\`.
3. Abra no navegador: `http://localhost/AcessaMais-local/`

> Importante: abra pelo `localhost`. Se abrir o `index.html` com dois cliques, o formulário não salva (o PHP precisa do servidor) e o painel pode não conseguir mudar o site (o navegador bloqueia o iframe fora de um servidor).

**4. Conferir os dados**

Envie uma mensagem pelo formulário e, no Workbench, rode:

```sql
USE acessibilidade;
SELECT * FROM mensagens;
```
