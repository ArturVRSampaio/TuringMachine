<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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

  while($fim){
      $estados[x];

    };
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