<?php
function master(){
  
  //FQ de estados finais
  $estadosFinais = [];

  //conjunto finito de estados
  //lista de estados do usuario
  $estados = [];

  //alfabeto da fita (conjunto finito de símbolos)
  //fita de memoria, originalmente contendo a entrada do usuario
  //$fita=["a","b",""];
  $fita=array_fill(0, 100000, '');
  //alfabeto finito de símbolos
  $alfabeto=["a","b",""];
  
  //símbolo branco
  //""
  
  //q0
  // 000 -> Q0a a 2 1
  // 010 -> Q0b a 2 1
  // 020 -> Q0_ a 2 0
  
  //q1
  // 100 -> Q1a a 2 1
  // 110 -> Q1b a 2 1
  // 120 -> Q1_ a 2 0



//array exemplo 
  $listaAcaoa = array("a", "a", 2, 1);
  $listaAcaob = array("b", "a", 2, 1);
  $listaAcaoVazio = array("", "a", 2, 0);
  $listachave = array($listaAcaoa, $listaAcaob, $listaAcaoVazio);
  $estados = array($listachave, $listachave);


  
  //valores iniciais
  $aceita = False;
  $estadoAtual = 0;
  $fitaPos = 50000;
  $fim = false;
  $leitura = $fita[$fitaPos];

  while($fim!= true){
    //ler conteudo atual da lista
    $leitura = $fita[$fitaPos];

    //verificando existe algum valor do alfabeto do estado atual
    foreach($estados[$estadoAtual] as $key => $value){
      if($value[0] ===$leitura){

        //escrevendo
        $fita[$fitaPos] = $estados[$estadoAtual][$key][1];
        //movendo
        $fitaPos += $estados[$estadoAtual][$key][2];
                
        //mudando estado
        $estadoAtual = $estados[$estadoAtual][$key][3];
      }
    }  
  };
  return($fita);
}