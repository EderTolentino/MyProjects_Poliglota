// Array com os ID's que já foram feitos
var arrayID = [];
var ID;
var tamanhoCategoria;
var categoria_selecionada;
var ID_pulado;
var ID_NaoConferido;
var ID_Conferido;


function limparDados() {
    arrayID = [];
    ID = 0;

    ID_NaoConferido = ID;
    ID_Conferido = ID;

    document.getElementById('palavraPortugues').innerHTML = "";

    document.getElementById('palavraTestada').innerHTML = "PALAVRA";
    document.getElementById('palavraPortugues').innerHTML = "";
    document.getElementById('palavraIngles').innerHTML = "";
    document.getElementById('palavraEspanhol').innerHTML = "";
    document.getElementById('palavraFrances').innerHTML = "";
    document.getElementById('palavraItaliano').innerHTML = "";
    document.getElementById('palavraAlemao').innerHTML = "";
    document.getElementById('palavraChines').innerHTML = "";
    document.getElementById('palavraRusso').innerHTML = "";

    document.getElementById('total').innerHTML = 0;

    zerarEstatisticas('Ingles');
    zerarEstatisticas('Espanhol');
    zerarEstatisticas('Frances');
    zerarEstatisticas('Italiano');
    zerarEstatisticas('Alemao');
    zerarEstatisticas('Chines');
    zerarEstatisticas('Russo');
}

// SELEÇÃO DA CATEGORIA E PRIMEIRA PALAVRA:
$('button#selecionar').click(function() {

    limparDados();  

    var select = document.getElementById('selecao');
    categoria_selecionada = select.options[select.selectedIndex].value;


    // DESTACAR O NOME DA CATEGORIA ESCOLHIDA:                
    document.getElementById('categoriaEscolhida').innerHTML = select.options[select.selectedIndex].innerText.toUpperCase();
    console.log(categoria_selecionada);


    var nome_arquivo = 'gerar_json/gerar_json_' + categoria_selecionada + '.php';

    carregarDados(nome_arquivo, ID);
    quantidadeElementos (nome_arquivo);
}); 

// PRÓXIMA PALAVRA EM PORTUGUÊS:
function palavraSeguinte() {

    if (ID_NaoConferido == ID_Conferido) {
        conferirRespostas();
        ID_Conferido = ID_Conferido + 1;
    } else {
        /*
        var categoria_selecionada = document.getElementById('categoriaEscolhida').innerHTML;
        categoria_selecionada = categoria_selecionada.toLowerCase();
        */
        console.log(categoria_selecionada);

        if ( (ID == (tamanhoCategoria - 1)) & (arrayID.length <= (tamanhoCategoria - 2)) ) {
            ID = 1;
        } else {
            ID = ID + 1;
        }

        if(verificarID (arrayID, ID)) {
            var nome_arquivo = 'gerar_json/gerar_json_' + categoria_selecionada + '.php';
            carregarDados(nome_arquivo, ID);
            arrayID.push(ID);

            if (arrayID.length == tamanhoCategoria) {
                alert("FIM DE PALAVRAS NESTA CATEGORIA. ESCOLHA A PRÓXIMA!")
                location.reload();
            }

        } else {
            palavraSeguinte();
        }
    }
}


// ESCOLHER PRÓXIMA PALAVRA DE FORMA ALEATÓRIA:
function sortearPalavra() {
    if (ID_NaoConferido == ID_Conferido) {
        conferirRespostas();
        ID_Conferido = ID_Conferido + 1;
    } else {


        ID = sortearID();

        if (arrayID.length == (tamanhoCategoria - 1)) {
            alert("FIM DE PALAVRAS NESTA CATEGORIA. ESCOLHA A PRÓXIMA!")
            location.reload();
        } else {
            if(verificarID (arrayID, ID)) {

                var nome_arquivo = 'gerar_json/gerar_json_' + categoria_selecionada + '.php';

                carregarDados(nome_arquivo, ID);
                arrayID.push(ID);

            } else {

                // SE POSSÍVEL, ALTERAR ESTA PARTE
                sortearPalavra();
            }
        }
    }
}


// SORTEIA UM NÚMERO ALEATÓRIO ENTRE 1 E O MAIOR ID DA CATEGORIA SELECIONADA:
function sortearID () {
    var num = Math.ceil(Math.random()*(tamanhoCategoria - 1));
    return num;
}

// VERIFICA SE O ID AINDA NÃO FOI USADO:
function verificarID (array, n) {
    for (let i = 0; i < tamanhoCategoria; i ++) {
        if (n == array[i]) {
            return false
        } 
    }
    return true
}


// VERIFICA QUANTOS ELEMENTOS EXISTEM NA CATEGORIA SELECIONADA:
function quantidadeElementos ($cat) {
    $.getJSON($cat, function(data) {
        tamanhoCategoria = data.length;

    });
}    

// BUSCA A CATEGORIA NO BANCO DE DADOS E CARREGA A PRIMEIRA PALAVRA:
function carregarDados($cat, n) {

    var elementos = document.getElementsByClassName("col-2")
    for (var i = 0; i < elementos.length; i++) {
        elementos[i].style.color = 'white';
    }

    var elementos2 = document.getElementsByClassName("inputEntrada")
    for (var i = 0; i < elementos2.length; i++) {
        elementos2[i].value = "";
    }

    var elementos3 = document.getElementsByClassName("col-4")
    for (var i = 1; i < elementos3.length; i++) {
        elementos3[i].style.backgroundColor = 'white';
        elementos3[i].innerHTML = "";

    }


    ID_NaoConferido = n;
    ID_Conferido = n;

    $.getJSON($cat, function(data) {

        // CRIAR FUNÇÃO PARA REDUZIR LINHAS:       
        document.getElementById('palavraTestada').innerHTML = (data[n].portugues).toUpperCase();
        document.getElementById('palavraPortugues').innerHTML = (data[n].portugues).toUpperCase();
        document.getElementById('palavraIngles').innerHTML = (data[n].ingles).toUpperCase();
        document.getElementById('palavraEspanhol').innerHTML = (data[n].espanhol).toUpperCase();
        document.getElementById('palavraFrances').innerHTML = (data[n].frances).toUpperCase();
        document.getElementById('palavraItaliano').innerHTML = (data[n].italiano).toUpperCase();
        document.getElementById('palavraAlemao').innerHTML = (data[n].alemao).toUpperCase();
        document.getElementById('palavraChines').innerHTML = (data[n].chines).toUpperCase();
        document.getElementById('palavraRusso').innerHTML = (data[n].russo).toUpperCase();

    });
}

function conferirRespostas() {

    if (ID >= 0 & (ID_NaoConferido == ID)) {
        conferirPorIdioma ('Ingles');
        conferirPorIdioma ('Espanhol');
        conferirPorIdioma ('Frances');
        conferirPorIdioma ('Italiano');
        conferirPorIdioma ('Alemao');
        conferirPorIdioma ('Chines');
        conferirPorIdioma ('Russo'); 

        document.getElementById('total').innerHTML = Number(document.getElementById('total').innerHTML) + 1;

        ID_NaoConferido = ID_NaoConferido + 1;
        console.log('ID_NaoConferido');
        console.log(ID_NaoConferido);

    }

    ID_Conferido = ID_Conferido + 2;

    console.log('ID_Conferido');
    console.log(ID_Conferido);

}


function ocultarRespostas(botao) {

    // APRENDER A MANIPULAR O GET ELEMENTS BY CLASS
    document.getElementById('palavraIngles').style.color = 'white';
    document.getElementById('palavraEspanhol').style.color = 'white';
    document.getElementById('palavraFrances').style.color = 'white';
    document.getElementById('palavraItaliano').style.color = 'white';
    document.getElementById('palavraAlemao').style.color = 'white';
    document.getElementById('palavraChines').style.color = 'white';
    document.getElementById('palavraRusso').style.color = 'white';

    document.getElementById('mostrarTodos').innerHTML = 'RESPOSTAS';
    botao.setAttribute("onclick","mostrarRespostas(this);");
    botao.style.backgroundColor = 'skyblue';
    botao.style.color = 'black';

}

function mostrarRespostas(botao) {

    // APRENDER A MANIPULAR O GET ELEMENTS BY CLASS
    document.getElementById('palavraIngles').style.color = 'black';
    document.getElementById('palavraEspanhol').style.color = 'black';
    document.getElementById('palavraFrances').style.color = 'black';
    document.getElementById('palavraItaliano').style.color = 'black';
    document.getElementById('palavraAlemao').style.color = 'black';
    document.getElementById('palavraChines').style.color = 'black';
    document.getElementById('palavraRusso').style.color = 'black';

    document.getElementById('mostrarTodos').innerHTML = 'OCULTAR';
    botao.setAttribute("onclick","ocultarRespostas(this);");
    botao.style.backgroundColor = '#0066b8';
    botao.style.color = 'white';

}


function conferirPorIdioma (chave) {

    let palavra = document.getElementById('palavra' + chave).innerHTML;

    let entrada = document.getElementById('entrada' + chave);
    entrada = entrada.value.toUpperCase();

    // APRENDER A MANIPULAR O GET ELEMENTS BY CLASS
    // POR ID eu havia feito assim: document.getElementById('palavra' + chave).style.color = 'black';
    var elements = document.getElementsByClassName("col-2")
    for (var i = 0; i < elements.length; i++) {
        elements[i].style.color = 'black';
    }

    if(ID >= 0 & (ID_NaoConferido == ID)) {

        if (entrada) {
            if (palavra == entrada) {
                //document.getElementById('col-resultado').style.color = 'black';
                //document.getElementById('col-resultado').style.backgroundColor = 'white';

                document.getElementById('acertos' + chave).innerHTML = Number(document.getElementById('acertos' + chave).innerHTML) +1;

                document.getElementById('resposta' + chave).innerHTML = 'CORRETO';
                document.getElementById('resposta' + chave).style.color = 'black';
                document.getElementById('resposta' + chave).style.backgroundColor = 'yellow';
            } else {
                //document.getElementById('col-resultado').style.color = 'black';
                //document.getElementById('col-resultado').style.backgroundColor = 'white';

                document.getElementById('erros' + chave).innerHTML = Number(document.getElementById('erros' + chave).innerHTML) +1;

                document.getElementById('resposta' + chave).innerHTML = 'X';
                document.getElementById('resposta' + chave).style.color = 'black';
                document.getElementById('resposta' + chave).style.backgroundColor = 'red'; 
            }
        } else {
            //document.getElementById('col-resultado').style.color = 'black';
            //document.getElementById('col-resultado').style.backgroundColor = 'white';

            document.getElementById('pulos' + chave).innerHTML = Number(document.getElementById('pulos' + chave).innerHTML) +1;

            document.getElementById('resposta' + chave).innerHTML = 'X';
            document.getElementById('resposta' + chave).style.color = 'black';
            document.getElementById('resposta' + chave).style.backgroundColor = 'white'; 
        }

    }
}


document.getElementById('total').innerHTML = 0;

function zerarEstatisticas(chave) {
    document.getElementById('acertos' + chave).innerHTML = 0;
    document.getElementById('erros' + chave).innerHTML = 0;
    document.getElementById('pulos' + chave).innerHTML = 0;

}

function mouseDown(botao) {
    document.getElementById(botao).style.color = "black";

}

function mouseUp(botao) {
    document.getElementById(botao).style.color = 'white';
} 