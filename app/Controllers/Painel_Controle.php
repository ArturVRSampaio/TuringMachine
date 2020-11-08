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
        $x= $this->input->post();	
        var_dump($x);	
        echo json_encode(array("status" => TRUE));
        
        
        //helper('Machine_helper');
        //$result = tm(I, tape, end, state, i, cell, current);
        //$result = tm(I, [1,1,1], end, state, i, cell, current);
        //var_dump($result);
    }

	//--------------------------------------------------------------------

}