<?php namespace App\Controllers;
use CodeIgniter\HTTP\IncomingRequest;

class Painel_Controle extends BaseController
{
    function __construct() {
    }


    public function index()
	{
        return view('Painel_Controle_View.php');
	}

    function Controle() {
        $request = service('request');
        //teste Json
        $Leitura_Estados= $request->getPost("Estados");
        $Leitura_FitaEntrada= $request->getPost("FitaEntrada");
        $Leitura_TamanhoFita= $request->getPost("TamanhoFita");

        var_dump($Leitura_Estados);
        var_dump($Leitura_FitaEntrada);
        var_dump($Leitura_TamanhoFita);	

        echo json_encode(array("status" => TRUE));
        return;        

        ///////////////////////
        //teste maquina
        ///////////////////////

        helper('Machine_helper');
        
        //fita entrada
        // $fitaEntrada = array("a","b","c","a","b");


        // array estados exemplo
        //q0
        // 000 -> Q0a b 2 1
        // 010 -> Q0b a 2 1
        // 020 -> Q0_ "" 2 -1 ->estado final
        //q1
        // 100 -> Q1a b 2 1
        // 110 -> Q1b a 2 1
        // 120 -> Q1_ "" 2 -1 ->estado final

        $listaAcaoa = array("a", "b", 1, 1);
        $listaAcaob = array("b", "a", 1, 1);
        $listaAcaoVazio = array("", "a", 2, -1);

        $listachave = array($listaAcaoa, $listaAcaob, $listaAcaoVazio);

        //conjunto finito de estados
        //lista de estados do usuario
        $estados = array($listachave, $listachave);

        // $fitaSize = 12;

        master($Leitura_Estados, $Leitura_FitaEntrada, $Leitura_TamanhoFita);
        // master($estados, $fitaEntrada, $fitaSize);
    }

	//--------------------------------------------------------------------

}