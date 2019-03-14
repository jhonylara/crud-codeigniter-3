<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cadastro extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('autenticador_model', 'autenticador');
        $this->autenticador->logado();

        $this->load->model('cadastro_model', 'cadastro'); //Carrega o model
    }

	public function index($idUsuario = null)
	{
        $this->load->helper(array('form', 'url', 'email')); //Bibliotecas
        $this->load->library('form_validation');

        $estados = $this->cadastro->retornarEstados(); // Busca Estados para o banco

        //Validações dos campos.
        $this->form_validation->set_rules('nomeCompleto', 'Nome Completo', 'required|callback_verificar_nome',
            array('required' => 'O campo nome completo é obrigatorio!')
        );
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email',
            array('required' => 'O campo email é obrigatorio!',
                  'valid_email' => 'Digite um email valido!')
        );
        $this->form_validation->set_rules('senha', 'Senha', 'required|callback_verificar_senha',
            array('required' => 'O campo senha é obrigatorio!')
        );
        $this->form_validation->set_rules('confirmaSenha', 'Confirmação Senha', 'required',
            array('required' => 'O campo confirmação senha é obrigatorio!')
        );
        $this->form_validation->set_rules('estado', 'Estado', 'required|callback_verificar_estado',
            array('required' => 'Selecione um estado!')
        );
        $this->form_validation->set_rules('cidade', 'Cidade', 'required',
            array('required' => 'O campo cidade é obrigatorio!')
        );
        
        //Se for validado...
        if ($this->form_validation->run() == TRUE)
        {
            $config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 100;
            $config['max_width']            = 1024;
            $config['max_height']           = 768;
    
            $this->load->library('upload', $config);

            $this->upload->do_upload('foto');

            $upload_data = $this->upload->data(); 
            $file_name = $upload_data['file_name'];

            $tipoOperacao = $this->input->post('tipoOperacao', true);

            $pessoa = new stdClass;
            $nomeCompleto = explode(" ", $this->input->post('nomeCompleto', true));
            
            $pessoa->primeiroNome = $nomeCompleto[0];
            $pessoa->ultimoNome = $nomeCompleto[count($nomeCompleto) - 1];
            $pessoa->email = $this->input->post('email', true);
            $pessoa->senha = $this->input->post('senha', true);
            $pessoa->estado = $this->input->post('estado', true);
            $pessoa->cidade = $this->input->post('cidade', true);
            if($file_name != null){
                $pessoa->foto = $baseurl=base_url() . 'uploads/' . $file_name;
            }else{
                $pessoa->foto = '';
            }

            //Se for insert no hidden salva se não, altera.
            if($tipoOperacao == 'insert'){
                $this->cadastro->gravarPessoa($pessoa);  
            }
            else if($tipoOperacao == 'update'){
                $pessoa->idPessoa = $this->input->post('idPessoa', true);
                $this->cadastro->alterarPessoa($pessoa);
            }
        }

        //Se existir um usuario retorna ele para popular o form
        if($idUsuario != null){
            $pessoa = $this->cadastro->retornarPessoaEspecifica($idUsuario);
        }
        else{
            $pessoa = null;
        }

        $data = array('estados' => $estados,'pessoa' => $pessoa);
		$this->load->view('cadastro', $data);
    }

    public function excluir($idUsuario){
        $this->cadastro->excluirPessoa($idUsuario);

        $pessoas = $this->cadastro->retornarPessoas();
        
        $data = array('pessoas' => $pessoas);
		$this->load->view('listagem', $data);
    }

    public function deslogar(){
        $this->load->helper('url'); //Bibliotecas
        $this->session->sess_destroy();

        redirect('login/login');
    }

    public function verificar_nome($nome){
        $nomeCompleto = explode(" ", $nome);

        if (count($nomeCompleto) < 2)
        {
            $this->form_validation->set_message('verificar_nome', 'Por favor digite seu nome completo');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    public function verificar_senha($senha){
        $confirmaSenha = $this->input->post('confirmaSenha', true);  

        if ($senha != $confirmaSenha)
        {
            $this->form_validation->set_message('verificar_senha', 'A senha digitada não confere com a confirmação!');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    public function verificar_estado($estado){
        if ($estado == NULL)
        {
            $this->form_validation->set_message('verificar_estado', 'Selecione um estado valido!');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
}
