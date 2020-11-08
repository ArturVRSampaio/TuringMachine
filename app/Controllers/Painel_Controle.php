<?php namespace App\Controllers;

class Painel_Controle extends BaseController
{
    function __construct() {
    }


    public function index()
	{
        return view('Painel_Controle_View.php');
	}

    function Controle() {
        $x= "you got that";
        //var_dump($x);
        echo json_encode(array("status" => TRUE));
    }

	//--------------------------------------------------------------------

}