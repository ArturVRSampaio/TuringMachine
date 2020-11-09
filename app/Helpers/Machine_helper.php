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
  $alfabeto=["a","b","c","d",""];
  
  
  //example
  /////////////////////////// 
  //      || 0  1 ||       ||
  //a 2 1 || a  a || a 2 1 ||
  //a 2 1 || b  b || a 2 1 ||
  //a 2 1 || c  c || a 2 1 ||
  //a 2 1 || d  d || a 2 1 ||
  //a 2 1 || "" ""|| a 2 1 ||
  ///////////////////////////
  
  
  $estados  = ["0","1"];
  $estados[0] = ["a","b","c","d",""];
  $estados[1] = ["a","b","c","d",""];
  
  $estados[0]["a"] = ["a","2","1"];
  $estados[0]["b"] = ["a","2","1"];
  $estados[0]["c"] = ["a","2","1"];
  $estados[0]["d"] = ["a","2","1"];
  $estados[0][""] = ["a","2","1"];
  

  $estados[1]["a"] = ["a","2","1"];
  $estados[1]["b"] = ["a","2","1"];
  $estados[1]["c"] = ["a","2","1"];
  $estados[1]["d"] = ["a","2","1"];
  $estados[1][""] = ["a","2","1"];
  
  $aceita = False;
  $estadoAtual = 0;
  $fitaPos = 0;

  while($fim!= true){
    //ler conteudo atual da lista
    $leitura = $fita[$fitaPos];

    //verificando existe algum valor do alfabeto do estado atual
    if(array_search($leitura, $estados[$estadoAtual])){
      //identificando proxima tarefa
      $acoes = $estados[$estadoAtual][$fitaPos];
    }
    else{
      //execucao encerrada em estado nao final
      $aceita=False;
      $fim=True;
    }

    $fita[$fitaPos]+= $acoes[1];
    $fitaPos+= $acoes[2];
    
    if($acoes[3]<0){
      //execucao encerrada em estado final
      $aceita=True;
      $fim=True;
    }
    else{
      $estadoAtual= $acoes[3];
    }

    ////possiveis fins de execucao:
    //// fim esperado, aceitacao
    //// fim inesperado, nao aceitacao/ erro
    ////execucao encerrada em estado final
    //if(false){
    //  $aceita=True;
    //  $fim=True;
    //}
    ////execucao encerrada em estado nao final
    //if(false){
    //  $aceita=False;
    //  $fim=True;
    //}
  };
  var_dump($fita);
}