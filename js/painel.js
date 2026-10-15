//✓ os botões que já estavam ligados
recursos.forEach(function (classe) {
  if (localStorage.getItem(classe) === "ligado") {
    document.getElementById("btn-" + classe).classList.add("ativo");
  }
});

//"parent" é a página do site que está por fora do painel
function atualizarSite() {
  aplicarConfiguracoes();
  parent.aplicarConfiguracoes();
}

//liga ou desliga recurso
//é chamada pelo onclick do botão, ex: alternar('alto-contraste', this)
//"this" é o próprio botão que foi clicado
function alternar(classe, botao) {
  //se já estava ligado, apaga do localStorage; se não, salva "ligado"
  if (localStorage.getItem(classe) === "ligado") {
    localStorage.removeItem(classe);
  } else {
    localStorage.setItem(classe, "ligado");
  }

  botao.classList.toggle("ativo"); //coloca/tira ✓ do botão
  atualizarSite();

  //quando liga a voz, ela já fala uma vez pra mostrar que está funcionando
  if (classe === "ler-voz" && localStorage.getItem("ler-voz") === "ligado") {
    parent.falar("Leitura em voz ligada. Selecione um texto do site para ouvir.");
  }
}

//aumenta/diminui texto
//A+ chama mudarTamanho(10) e A- chama mudarTamanho(-10)
function mudarTamanho(valor) {
  //Number() transforma o texto salvo em número
  let tamanho = Number(localStorage.getItem("tamanho")) || 100;
  tamanho = tamanho + valor;

  if (tamanho > 150) tamanho = 150;
  if (tamanho < 80) tamanho = 80;

  localStorage.setItem("tamanho", tamanho);
  atualizarSite();
}

//volta tudo ao normal
function restaurar() {
  localStorage.clear(); //apaga tudo que estava salvo

  //tira ✓ de todos os botões
  document.querySelectorAll(".ativo").forEach(function (botao) {
    botao.classList.remove("ativo");
  });

  parent.speechSynthesis.cancel(); //para a voz
  atualizarSite();
}

//fecha o painel: esconde o iframe que está lá no site
function fecharPainel() {
  const quadro = parent.document.getElementById("painel");
  if (quadro) {
    quadro.hidden = true;
  }
}