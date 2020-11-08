<?php 

// competencias de uma MQT:
//
//shift left
//shift left
//
//write
//read
//
//process
//


  function master()
  {
  //flag de aceita
  $fim = True;

  //alfabeto da fita (conjunto finito de símbolos)
  //fita de memoria, originalmente contendo a entrada do usuario
  $fita = [];

  //alfabeto finito de símbolos
  $alfabeto = [];
  
  //FQ de estados finais
  $estadosFinais = [];
  
  //símbolo branco

  //conjunto finito de estados
  //lista de estados do usuario
  $estados = [];


  //para garantir que o conjunto de estados seja ligado a qualquer alfabeto de qualquer tamanho 
  //
  //funcionamento:
  //
  //alfabeto: {a,b,c,d}
  //
  //estados:{0,1,2,3,4}
  //
  //estado[0]:{a,b,c,d}
  //
  //estado[0,a]:{ escreve X, move Y, muda para o estado[Z]}

  //fixando valores de teste
  //
  $fita=["a","b","c","d"];
  // 
  $alfabeto=["a","b"];
  
  
  //
  $estados  = ["0","1"];
  $estados["0"] = ["a","b","c","d"];
  $estados["1"] = ["a","b","c","d"];
  
  $estados["0"]["a"] = ["a","2","1"];
  $estados["0"]["b"] = ["a","2","1"];
  $estados["0"]["c"] = ["a","2","1"];
  $estados["0"]["d"] = ["a","2","1"];
  

  $estados["1"]["a"] = ["a","2","1"];
  $estados["1"]["b"] = ["a","2","1"];
  $estados["1"]["c"] = ["a","2","1"];
  $estados["1"]["d"] = ["a","2","1"];
  
  
  $estadoAtual = 0;
  $fitaPos = 0;
  //while($fim!= true){

    //posicao atual na fita
    $leitura = $fita[$fitaPos];
    
    //identificando prioxima tarefa
    $acoes = $estados[$estadoAtual][$leitura];
  
    var_dump($acoes);
  //};
}



function move_right()
{

}
function move_left()
{
  
}
function write()
{
  
}
function read()
{
  
}