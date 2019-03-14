<?php
class autenticador_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();

        // novo banco de dados
        $this->load->library('session');
        $this->cadastro = $this->load->database('db', TRUE);
    }

    # VALIDA USUÁRIO
    function validar() {
        $nomeCompleto = explode(" ", $this->input->post('nomeCompleto', true));

        $primeiroNome = $nomeCompleto[0];
        $ultimoNome = $nomeCompleto[count($nomeCompleto) - 1];

        $this->cadastro->where(array('Nome' => $this->cadastro->escape_str($primeiroNome))); 
        $this->cadastro->where(array('Sobrenome' => $this->cadastro->escape_str($ultimoNome))); 
        $this->cadastro->where(array('Senha' => $this->cadastro->escape_str($this->input->post('senha'))));

        $query = $this->cadastro->get('Pessoas'); 

        if ($query->num_rows() == 1) { 
            return true; 
        }else{
            return false; 
        }
    }

    # VERIFICA SE O USUÁRIO ESTÁ LOGADO
    function logado() {
        $logado = $this->session->userdata('logado');

        if (!isset($logado) || $logado != true) {
            ?>
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
                <div class="alert alert-danger">
                    <strong>Erro!</strong> Você nao tem permissao para entrar nessa pagina.
                    <a class="btn btn-danger" href="/login" role="button">Voltar</a>
                </div>
            <?php
            die();
        }
    }
}