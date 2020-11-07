<?php namespace App\Controllers;

class Saida_Controle extends BaseController
{
    function __construct() {
    }


    public function index()
	{
        return view('Painel_Controle_View.php');
	}

	//--------------------------------------------------------------------

}