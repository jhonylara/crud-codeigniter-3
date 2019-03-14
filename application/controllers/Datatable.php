<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datatable extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('autenticador_model', 'autenticador');
        $this->autenticador->logado();
        
        $this->load->model('cadastro_model', 'cadastro');
    }

	public function index()
	{   
        $textoPesquisa = $this->input->post('textoPesquisa', true);
        if($textoPesquisa == null){
            $pessoas = $this->cadastro->retornarPessoas();  
        }
        else
        {
            $pessoas = $this->cadastro->retornarPessoaEspecificaPorNome($textoPesquisa);
        }
        
        $data = array('pessoas' => $pessoas);
		$this->load->view('datatable', $data);
	}
}