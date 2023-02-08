<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Autentica extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		// $this->load->helper('url');
		// $this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->model('Usuario_model', TRUE);
		// date_default_timezone_set('America/Sao_Paulo');
	}

	public function index()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_message('required', 'Campo %s obrigatório');
		// Explicação do Form validation -> Tipo do campo | Nome para substituir '%s' | Regra
		$this->form_validation->set_rules('email', 'E-mail ou Usuário', 'trim|required');
		$this->form_validation->set_rules('password', 'Senha', 'trim|required|callback_check_database');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('Fpages/login');
		} else {
			redirect('home/dashboard', 'refresh');
		}
	}
}
