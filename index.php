<?php require_once("conexao/conexao.php"); ?>

<!DOCTYPE HTML>
<html>
    <head>
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">              
              
        <title>Poliglota</title>
        <link href="style.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
       
    </head>
    <body>
                 
        <div id="cabecalho">            
            <h1>P</h1>
            <img class="bandeirasTopo" src="imagens/portugues.jpg" alt="Bandeira do Brasil">
            <h1>O</h1>
            <img class="bandeirasTopo" src="imagens/ingles.jpg" alt="Bandeira dos Estados Unidos">
            <h1>L</h1>
            <img class="bandeirasTopo" src="imagens/espanhol.jpg" alt="Bandeira da Espanha">
            <h1>I</h1>
            <img class="bandeirasTopo" src="imagens/frances.jpg" alt="Bandeira da França">
            <h1>G</h1>
            <img class="bandeirasTopo" src="imagens/italiano.jpg" alt="Bandeira da Itália">
            <h1>L</h1>
            <img class="bandeirasTopo" src="imagens/alemao.jpg" alt="Bandeira da Alemanha">
            <h1>O</h1>
            <img class="bandeirasTopo" src="imagens/chines.jpg" alt="Bandeira da China">
            <h1>T</h1>
            <img class="bandeirasTopo" src="imagens/russo.jpg" alt="Bandeira da Rússia">
            <h1>A</h1>
        </div>
        
                
        <div id="escolha">
            <div id="linha1">
                            
                <div id="categoria">
                    <select id="selecao" name="categoria">

                        <!-- A cada categoria criada, deve-se atentar aos seguintes nomes: id e valor do option, o nome da tabela no BD, o nome do arquivo gerar JSON e o nome da tabela direcionada no JSON onde será feita a busca no BD -->
                        <!-- Carregar o BD com os valores do excel -->
                        <option value="" disabled selected>Categorias...</option>
                        <option id="adjetivos" value="adjetivos">Adjetivos</option>
                        <option id="adverbios" value="adverbios">Advérbios</option>
                        <option id="alimentos" value="alimentos">Alimentos</option>
                        <option id="animais" value="animais">Animais</option>
                        <option id="artigos" value="artigos">Artigos</option>
                        <option id="casa_moveis_objetos" value="casa_moveis_objetos">Casa, móveis e objetos</option>
                        <option id="conjuncoes" value="conjuncoes">Conjunções</option>
                        <option id="descricoes_de_objetos" value="descricoes_de_objetos">Descrições de objetos</option>
                        <option id="divisoes_do_tempo" value="divisoes_do_tempo">Divisões do tempo</option>
                        <option id="esportes" value="esportes">Esportes</option>
                        <option id="ferramentas_de_trabalho" value="ferramentas_de_trabalho">Ferramentas de trabalho</option>
                        <option id="lugares" value="lugares">Lugares</option>
                        <option id="natureza" value="natureza">Natureza</option>
                        <option id="numeros" value="numeros">Números</option>
                        <option id="paises_e_nacionalidades" value="paises_e_nacionalidades">Países e nacionalidades</option>
                        <option id="partes_do_corpo" value="partes_do_corpo">Partes do Corpo</option>
                        <option id="preposicoes" value="preposicoes">Preposições</option>
                        <option id="profissoes" value="profissoes">Profissões</option>
                        <option id="pronomes" value="pronomes">Pronomes</option>
                        <option id="relacoes_humanas" value="relacoes_humanas">Relações humanas</option>
                        <option id="saudacoes" value="saudacoes">Saudações</option>
                        <option id="sentimentos_e_emocoes" value="sentimentos_e_emocoes">Sentimentos e emoções</option>
                        <option id="signos" value="signos">Signos</option>
                        <option id="transportes" value="transportes">Transportes</option>
                        <option id="verbos" value="verbos">Verbos</option>       
                        <option id="vestuarios" value="vestuarios">Vestuários</option>

                    </select>
                    <button id="selecionar" class="botoes" name="selecionar">SELECIONAR</button>
                </div> 
            </div>
            <div id="linha2">
                <div id="palavraSelecionada">
                    <div id="palavraPortugues"></div>   
                    <img src="imagens/portugues.jpg" alt="bandeira do Brasil">
                </div>
                <div id="botoes">
                    <button class="botoes" id="proximaPalavra" name="proxima" onclick="palavraSeguinte()">PRÓXIMA</button>
                    <button class="botoes" id="sortearPalavra" name="sortear" onclick="sortearPalavra()" >SORTEAR</button>
                </div> 
            </div>
        </div>
        
                
        <div id="principal">  
            
            <div id="esquerda">
                <table>
                    <tr>
                        <td colspan="4" id="categoriaEscolhida">CATEGORIA ESCOLHIDA</td>
                    </tr>
                    <tr>
                        <td id="mostrar">MOSTRAR</td>
                        <td ><button id="mostrarTodos" onclick="mostrarRespostas(this)">RESPOSTAS</button></td>                  
                        <td  class="col-3" id="palavraTestada">PALAVRA</td>
                        <td  class="col-4" id="col-resultado">RESULTADOS</td>
                    </tr>
                   
                    <tr>
                        <td class="col-1"><button class="idioma" onmousedown="mouseDown('palavraIngles')" onmouseup="mouseUp('palavraIngles')">INGLÊS</button></td>
                        <td class="col-2" id="palavraIngles"></td>
                        <td class="col-3">
                            <input type="text" class="inputEntrada" id="entradaIngles" placeholder="Traduza para o inglês">
                        </td>
                        <td class="col-4" id="respostaIngles"><div></div></td>
                        
                    </tr>
                    <tr>
                        <td class="col-1"><button class="idioma" onmousedown="mouseDown('palavraEspanhol')" onmouseup="mouseUp('palavraEspanhol')">ESPANHOL</button></td>
                        <td class="col-2" id="palavraEspanhol"></td>
                        <td class="col-3">
                            <input type="text" class="inputEntrada" id="entradaEspanhol" placeholder="Traduza para o espanhol">
                        </td>
                        <td class="col-4" id="respostaEspanhol"></td>
                        
                    </tr>
                    <tr>
                        <td class="col-1"><button class="idioma" onmousedown="mouseDown('palavraFrances')" onmouseup="mouseUp('palavraFrances')">FRANCÊS</button></td>
                        <td class="col-2" id="palavraFrances"></td>
                        <td class="col-3">
                            <input type="text" class="inputEntrada" id="entradaFrances" placeholder="Traduza para o francês">
                        </td>
                        <td class="col-4" id="respostaFrances"></td>
                        
                    </tr>
                    <tr>
                        <td class="col-1"><button class="idioma" onmousedown="mouseDown('palavraItaliano')" onmouseup="mouseUp('palavraItaliano')">ITALIANO</button></td>
                        <td class="col-2" id="palavraItaliano"></td>
                        <td class="col-3">
                            <input type="text" class="inputEntrada" id="entradaItaliano" placeholder="Traduza para o italiano">
                        </td>
                        <td class="col-4" id="respostaItaliano"></td>
                        
                    </tr>
                    <tr>
                        <td class="col-1"><button class="idioma" onmousedown="mouseDown('palavraAlemao')" onmouseup="mouseUp('palavraAlemao')">ALEMÃO</button></td>
                        <td class="col-2" id="palavraAlemao"></td>
                        <td class="col-3">
                            <input type="text" class="inputEntrada" id="entradaAlemao" placeholder="Traduza para o alemão">
                        </td>
                        <td class="col-4" id="respostaAlemao"></td>
                        
                    </tr>
                    <tr>
                        <td class="col-1"><button class="idioma" onmousedown="mouseDown('palavraChines')" onmouseup="mouseUp('palavraChines')">CHINÊS</button></td>
                        <td class="col-2" id="palavraChines"></td>
                        <td class="col-3">
                            <input type="text" class="inputEntrada" id="entradaChines" placeholder="Traduza para o chinês">
                        </td>
                        <td class="col-4" id="respostaChines"></td>
                        
                    </tr>
                    <tr>
                        <td class="col-1"><button class="idioma" onmousedown="mouseDown('palavraRusso')" onmouseup="mouseUp('palavraRusso')">RUSSO</button></td>
                        <td class="col-2" id="palavraRusso"></td>
                        <td class="col-3">
                            <input type="text" class="inputEntrada" id="entradaRusso" placeholder="Traduza para o russo">
                        </td>
                        <td class="col-4" id="respostaRusso"></td>
                        
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td class="col-3"><button id="conferir" onclick="conferirRespostas()">CONFERIR</button></td>
                        
                    </tr>
                </table>
            </div>
            <div id="direita">
                <table>
                    <tr>
                        <td class="col-5"></td>
                        <td colspan="4" class="estatistica">ESTATÍSTICAS</td>
                    </tr>
                    <tr>
                        <td class="col-5"></td>
                        <td class="col-6">ACERTOS</td>
                        <td class="col-7">ERROS</td>
                        <td class="col-8">EM BRANCO</td>
                        <td class="col-9">TOTAL</td>
                    </tr>
                    
                    <tr>                        
                        <td class="col-5"><img src="imagens/ingles.jpg" class="bandRes" alt="bandeira dos EUA"></td>
                        <td class="col-6" id="acertosIngles">0</td>
                        <td class="col-7" id="errosIngles">0</td>
                        <td class="col-8" id="pulosIngles">0</td>
                        <td class="col-9" rowspan="7" id="total">0</td>
                    </tr>
                    <tr>                        
                        <td class="col-5"><img src="imagens/espanhol.jpg" class="bandRes" alt="bandeira da Espanha"></td>
                        <td class="col-6" id="acertosEspanhol">0</td>
                        <td class="col-7" id="errosEspanhol">0</td>
                        <td class="col-8" id="pulosEspanhol">0</td>
                    </tr>
                    <tr>                       
                        <td class="col-5"><img src="imagens/frances.jpg" class="bandRes" alt="bandeira da França"></td>
                        <td class="col-6" id="acertosFrances">0</td>
                        <td class="col-7" id="errosFrances">0</td>
                        <td class="col-8" id="pulosFrances">0</td>
                    </tr>
                    <tr>                        
                        <td class="col-5"><img src="imagens/italiano.jpg" class="bandRes" alt="bandeira da Italia"></td>
                        <td class="col-6" id="acertosItaliano">0</td>
                        <td class="col-7" id="errosItaliano">0</td>
                        <td class="col-8" id="pulosItaliano">0</td>
                    </tr>
                    <tr>                        
                        <td class="col-5"><img src="imagens/alemao.jpg" class="bandRes" alt="bandeira da Alemanha"></td>
                        <td class="col-6" id="acertosAlemao">0</td>
                        <td class="col-7" id="errosAlemao">0</td>
                        <td class="col-8" id="pulosAlemao">0</td>
                    </tr>
                    <tr>                        
                        <td class="col-5"><img src="imagens/chines.jpg" class="bandRes" alt="bandeira da China"></td>
                        <td class="col-6" id="acertosChines">0</td>
                        <td class="col-7" id="errosChines">0</td>
                        <td class="col-8" id="pulosChines">0</td>
                    </tr>
                    <tr>                        
                        <td class="col-5"><img src="imagens/russo.jpg" class="bandRes" alt="bandeira da Russia"></td>
                        <td class="col-6" id="acertosRusso">0</td>
                        <td class="col-7" id="errosRusso">0</td>
                        <td class="col-8" id="pulosRusso">0</td>
                    </tr>
                    <tr>                        
                        <td id="linhaVazia" colspan="8"></td>
                    </tr>
                </table>
            </div>
            
        </div>
        
        <div class="footer">
            <div id="footer_left">
                <h3>EDER TOLENTINO </h3>
                <p>Développeur Web Jr</p>
            </div>
            <div id="footer_center">
                <ul>
                    <li><a href="https://edertolentino.com/portfolio/aboutme.php" target="_blank">SOBRE</a></li>
                    <li><a href="https://edertolentino.com/portfolio/portfolio.php" target="_blank">PORTFOLIO</a></li>
                    <li><a href="https://edertolentino.com/portfolio/contacts.php" target="_blank">CONTACTO</a></li>
                </ul>
            </div>
            <div id="footer_right">
                <ul>
                    <li>
                        <a href="https://web.whatsapp.com/send?phone=351910116613" class="fa fa-whatsapp" target="_blank"></a>
                    </li>
                    <li>
                        <a href="https://www.linkedin.com/in/edertolentino/" class="fa fa-linkedin" target="_blank"></a>
                    </li>
                    <li>
                        <a href="https://github.com/EderTolentino" class="fa fa-github" target="_blank"></a>
                    </li>
                </ul>
                <a href="#" class="btn_toTop"></a>
            </div>
        </div>
        
        <script src="jquery.js"></script>
        <script src="file.js"></script> 
    </body>
</html>