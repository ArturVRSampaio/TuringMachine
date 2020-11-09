<?php
function master(){
  

  //alfabeto da fita (conjunto finito de símbolos)
  //fita de memoria, originalmente contendo a entrada do usuario
  //$fita=["a","b",""];
  $fita=array_fill(0, 100000, '');
  
  //posicao inicial do cabecote
  $fitaPos = sizeof($fita)/2;
  
  //fita entrada
  $fitaEntrada = array("a","b","c","a","b");

  //escrevendo entrada na fita da maquina
  foreach($fitaEntrada as $key => $value){
    $fita[$fitaPos + $key] = $value; 
  }


  //alfabeto finito de símbolos
  $alfabeto=["a","b",""];
  
  //símbolo branco
  //""
  
  //q0
  // 000 -> Q0a b 2 1
  // 010 -> Q0b a 2 1
  // 020 -> Q0_ "" 2 0
  
  //q1
  // 100 -> Q1a b 2 1
  // 110 -> Q1b a 2 1
  // 120 -> Q1_ "" 2 0 ->estado final


  //array exemplo 
  $listaAcaoa = array("a", "b", 1, 1);
  $listaAcaob = array("b", "a", 1, 1);
  $listaAcaoVazio = array("", "a", 2, 1);
  
  
  $listachave = array($listaAcaoa, $listaAcaob, $listaAcaoVazio);

  //conjunto finito de estados
  //lista de estados do usuario
  $estados = array($listachave, $listachave);

  //FQ Estado Final
  $estadoFinal = $estados[1][2][0];

  //valores iniciais
  $aceita = False;
  $estadoAtual = 0;
  $fim = false;
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
          
        //verificando se este era o ultimo estado
        if($estadoFinal == $estados[$estadoAtual][$key][0]){
          //fim de aceitacao
          $fim=true;
          $aceita=true;
        }
        else{
        //mudando estado
        $estadoAtual = $estados[$estadoAtual][$key][3];
        }
      }
      //fim de nao aceitacao, o algorizmo esperado nao foi encontrado
      elseif(sizeof($estados[$estadoAtual])-1== $key){
        $fim=true;
        $aceita=false;
      }


    }  
  };
  var_dump($fita);
}