const body = document.body;

//recursos que viram uma classe no <body>
const recursos = [
  "modo-foco",
  "modo-daltonismo",
  "ler-voz",
  "espacamento",
  "alto-contraste",
  "escala-cinza",
  "destacar"
];

//confere no localStorage:
function aplicarConfiguracoes() {
  recursos.forEach(function (classe) {
    if (localStorage.getItem(classe) === "ligado") {
      body.classList.add(classe);
    } else {
      body.classList.remove(classe);
    }
  });

  //tamanho do texto salvo
  //muda o tamanho do <html>; como o CSS usa rem, o site todo acompanha
  const tamanho = localStorage.getItem("tamanho") || 100;
  document.documentElement.style.fontSize = tamanho + "%";
}

//roda assim que a página abre
aplicarConfiguracoes();


//abrir e fechar painel
//botão e quadro só existem no index.html,
//por isso o "if": nas outras páginas ele não faz nada
const btnPainel = document.getElementById("btn-abrir-painel");
const painel = document.getElementById("painel");

if (btnPainel) {
  btnPainel.addEventListener("click", function () {
    //hidden = escondido. se está escondido mostra, se está aparecendo esconde
    painel.hidden = !painel.hidden;
  });
}


//leitura com voz
//"mouseup" = quando a pessoa solta o botão do mouse (fim da seleção)
document.addEventListener("mouseup", function () {
  //se o recurso estiver desligado, não faz nada
  if (!body.classList.contains("ler-voz")) return;

  //pega o texto que a pessoa selecionou
  const texto = window.getSelection().toString().trim();

  if (texto !== "") {
    falar(texto);
  }
});

//fala um texto em voz alta
//speechSynthesis: voz que já vem no navegador
function falar(texto) {
  //se já estava falando, para antes
  if (speechSynthesis.speaking) {
    speechSynthesis.cancel();
  }

  const fala = new SpeechSynthesisUtterance(texto);
  fala.lang = "pt-BR";

  //espera um pouquinho antes de falar
  //(o Chrome às vezes ignora a fala que vem logo depois do cancel)
  setTimeout(function () {
    speechSynthesis.speak(fala);
  }, 100);
}
