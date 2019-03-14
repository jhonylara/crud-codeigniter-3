<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('session');
    }

    function index() {

        // VALIDATION RULES
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nomeCompleto', 'Nome Completo', 'required');
        $this->form_validation->set_rules('senha', 'Senha', 'required');
        $this->form_validation->set_error_delimiters('<p class="error">', '</p>');


        // MODELO MEMBERSHIP
        $this->load->model('autenticador_model', 'autenticador');
        $query = $this->autenticador->validar();

        

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login');
        } else {

            if ($query) { // VERIFICA LOGIN E SENHA
                $nomeCompleto = explode(" ", $this->input->post('nomeCompleto', true));

                $primeiroNome = $nomeCompleto[0];
                $ultimoNome = $nomeCompleto[count($nomeCompleto) - 1];

                $data = array(
                    'nome' => $primeiroNome,
                    'sobrenome' => $ultimoNome,
                    'logado' => true
                );
                $this->session->set_userdata($data);
                redirect('cadastro');
            } else {
                $this->load->helper('url');
                ?>
                    <div class="alert alert-danger">
                        <strong>Erro!</strong> Usuário e senha não conferem.
                    </div>
                <?php

                $this->load->view('login');
            }
        }
    }
}