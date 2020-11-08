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
        
        //teste Json
        $x= $this->input->post();	
        var_dump($x);	
        echo json_encode(array("status" => TRUE));
        
        //teste maquina
        //helper('Machine_helper');
        //master();
    }

	//--------------------------------------------------------------------

}