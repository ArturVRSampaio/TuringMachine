<?php
function master($estados, $fitaEntrada, $fitaSize){

  $fita=array_fill(0, $fitaSize, '');
    
  //posicao inicial do cabecote
  $fitaPos = sizeof($fita)/2;
  
  
  //escrevendo entrada na fita da maquina
  foreach($fitaEntrada as $key => $value){
    $fita[$fitaPos + $key] = $value; 
  }

  
  //símbolo branco
  //""

  //valores iniciais
  $aceita = False;
  $estadoAtual = 0;
  $fim = false;
  while($fim!= true){
    
    //verificando se eh o estado final
    if($estadoAtual < 0){
      //fim de aceitacao
      $fim=true;
      $aceita=true;
    }
    
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
      //fim de nao aceitacao, o algorizmo esperado nao foi encontrado
      elseif(sizeof($estados[$estadoAtual])-1== $key){
        $fim=true;
        $aceita=false;
      }


    }  
  };
  var_dump($fita);
}