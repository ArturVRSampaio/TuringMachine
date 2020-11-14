<?php namespace App\Controllers;
use CodeIgniter\HTTP\IncomingRequest;

class Painel_Controle extends BaseController
{
    public function index()
	{
        return view('Painel_Controle_View.php');
	}

    function Controle() {
        $request = service('request');
        $this->_validate();
        //teste Json
        $Estados= $request->getPost("Estados");
        $FitaEntrada= $request->getPost("FitaEntrada");
        $TamanhoFita= $request->getPost("TamanhoFita");

        $EstadosFormatados=     $this->FormataEstados($Estados);
        $FitaEntradaFormatada=  $this->FormataFitaEntrada($FitaEntrada);
        //var_dump($EstadosFormatados);
        //return
        helper('Machine_helper');
        
        header('Content-Type: application/json');
        echo json_encode(["status" => TRUE,master($EstadosFormatados, $FitaEntradaFormatada, $TamanhoFita)]);
    }

 

    function FormataEstados($Estados){

        $EstadosFormatados=array(array());       
        $EstadosEntrada = $Estados;

        //separando cada uma das linhas de comandos
        $EstadosEntradaExplodidos = explode(PHP_EOL, $EstadosEntrada);
        $EstadosEntradaExplodidos =str_replace("\r","",$EstadosEntradaExplodidos);
        
        //definindo valores iniciais do loop
        $PrimeiroIndice=0;
        $SegundoIndice=0;
        $IndiceTotalComandos =array();

        //loop de execucao de codigo
        foreach($EstadosEntradaExplodidos as $Estado){
            $Comandos = explode(' ', $Estado);
            
            if($Comandos[1] ==="null"){
                $Comandos[1] ="";
            }
            
            if($Comandos[2] ==="null"){
                $Comandos[2] ="";
            }

            array_push ($IndiceTotalComandos, $Comandos[0]);
            foreach(array_count_values($IndiceTotalComandos) as $NIndiceKey => $NIndiceValue){
                if($NIndiceKey == $Comandos[0]){
                    $SegundoIndice=$NIndiceValue-1;
                break;
                }
            }
            $PrimeiroIndice = intval( $Comandos[0]);

            if(! array_key_exists($PrimeiroIndice, $EstadosFormatados)){
                $EstadosFormatados[]=$PrimeiroIndice;
                $EstadosFormatados[$PrimeiroIndice]= array();
            }

            $EstadosFormatados[$PrimeiroIndice];
            
            array_push ($EstadosFormatados[$PrimeiroIndice], $SegundoIndice);
            $EstadosFormatados[$PrimeiroIndice][$SegundoIndice]=array();
            $EstadosFormatados[$PrimeiroIndice][$SegundoIndice]= $Comandos;
        }
        return ($EstadosFormatados);
    }
    
    function FormataFitaEntrada($FitaEntrada){
        $EstadosFitaEntradaFormatada = array();
        $CelulasFitaEntrada = $FitaEntrada;
        $celulas = explode(",", $CelulasFitaEntrada);
        foreach($celulas as $celula){
            if($celula ==="null"){
                $EstadosFitaEntradaFormatada[]= "";
            }
            else{
                $EstadosFitaEntradaFormatada[] = ($celula);
            }
        }

        return ($EstadosFitaEntradaFormatada);
    }



 
    //validacao de entrada
    private function _validate()
    {
        $validation =  \Config\Services::validation();

        
        $validation->setRules([
            'Estados' =>     'required',
            'FitaEntrada' => 'required',
            'TamanhoFita' => 'required|numeric|max_length[5]'
        ]);

        
        if (!$validation->withRequest($this->request)->run())
        {
            $data['inputerror'] = array();
            $data['error_string'] = array();
            $data['status'] = FALSE;
            foreach( $validation->getErrors() as $key => $val )
            {
                $data['inputerror'][] = $key;
                $data['error_string'][] = $val;
            }
            header('Content-Type: application/json');
            echo json_encode($data);
            exit();
        }
    }

}