<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teste extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('autenticador_model', 'autenticador');
        $this->autenticador->logado();
        
        $this->load->model('cadastro_model', 'cadastro');

        $this->load->library("pagination");
        $this->load->helper("url");
        $this->load->helper('array');

    }

	public function index()
	{   
        
        $config = array();
        
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        
        $config["base_url"] = base_url() . "teste/index";
        $config["total_rows"] = $this->cadastro->contarPessoas();
        $config["per_page"] = 1;
        $config["uri_segment"] = 3;
 
        $this->pagination->initialize($config);
 
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
 
        $data["results"] = $this->cadastro->achar_pessoas($config["per_page"], $page);
 
        $data["links"] = $this->pagination->create_links();
 
        $this->load->view("teste", $data);

//        $this->load->library('table');
//        $this->load->library('calendar');
//
//        $query = $this->cadastro->teste();  
//
//        $data = array('query' => $query);
//		$this->load->view('teste', $data);
    }
    
    
}
