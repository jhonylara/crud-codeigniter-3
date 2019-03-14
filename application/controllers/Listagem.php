<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Listagem extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('autenticador_model', 'autenticador');
        $this->autenticador->logado();
        $this->load->library("pagination");
        $this->load->helper("url");

        $this->load->model('cadastro_model', 'cadastro');
    }

    public function index(){   
        $textoPesquisa = $this->input->post('textoPesquisa', true);;;
        if($textoPesquisa == null){  
            $qtdPessoas = $this->cadastro->contarPessoas();  
        }
        else
        {      
            $qtdPessoas = $this->cadastro->contarPessoasPorBusca($textoPesquisa);
        }

        $config['full_tag_open'] = '<ul class="pagination no-margin">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tagl_close'] = '</a></li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tagl_close'] = '</li>';
        $config['first_tag_open'] = '<li class="page-item disabled">';
        $config['first_tagl_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tagl_close'] = '</a></li>';
        $config['attributes'] = array('class' => 'page-link');

        $config["base_url"] = base_url() . "listagem/index";
        $config["total_rows"] = $qtdPessoas;
        $config["per_page"] = 2;
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        if($textoPesquisa == null){  
            $pessoas = $this->cadastro->achar_pessoas($config["per_page"], $page);  
        }
        else
        {      
            $pessoas = $this->cadastro->achar_pessoas_por_nome($config["per_page"], $page, $textoPesquisa);
        }

        $data["results"] = $pessoas;
        $data["links"] = $this->pagination->create_links();
        
        $this->load->view("listagem", $data);       
    }
}


//$config['full_tag_open'] = '<ul class="pagination no-margin">';
//        $config['full_tag_close'] = '</ul>';
//        $config['num_tag_open'] = '<li class="page-item">';
//        $config['num_tag_close'] = '</li>';
//        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
//        $config['cur_tag_close'] = '</a></li>';
//        $config['next_tag_open'] = '<li class="page-item">';
//        $config['next_tagl_close'] = '</a></li>';
//        $config['prev_tag_open'] = '<li class="page-item">';
//        $config['prev_tagl_close'] = '</li>';
//        $config['first_tag_open'] = '<li class="page-item disabled">';
//        $config['first_tagl_close'] = '</li>';
//        $config['last_tag_open'] = '<li class="page-item">';
//        $config['last_tagl_close'] = '</a></li>';
//        $config['attributes'] = array('class' => 'page-link');
//        
//        $config["base_url"] = base_url() . "listagem/index";
//        $config["total_rows"] = $this->cadastro->contarPessoas();
//        $config["per_page"] = 2;
//        $config["uri_segment"] = 3;
// 
//        $this->pagination->initialize($config);
// 
//        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
// 
//        $data["results"] = $this->cadastro->achar_pessoas($config["per_page"], $page);
// 
//        $data["links"] = $this->pagination->create_links();
//        
//        
//        $this->load->view("listagem", $data);
//        
//        
//	}