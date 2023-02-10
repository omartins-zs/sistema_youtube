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

		// Explicação do Form validation -> Tipo do campo | Nome para substituir '%s' | Regra
		$this->form_validation->set_message('required', 'Campo %s obrigatório');
		$this->form_validation->set_rules('login', 'Usuário', 'trim|required');
		$this->form_validation->set_rules('password', 'Senha', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			redirect('login', 'refresh');
		} else {

			$login = $this->input->post('login');
			$senha = $this->input->post('senha');

			$this->load->model('Usuario_model');
			$result = $this->Usuario_model->login($login, $senha);

			if ((isset($result)) && (!empty($result))) {
				$resultadoUsuario = $this->Usuario_model->login($login, $senha);

				foreach ($resultadoUsuario as $usuario) {
					$config_array = array(
						'nomeUsuario' => $usuario->nome,
						'loginUsuario' => $usuario->login,
						'emailUsuario' => $usuario->email,
						'dataCadastro' => $usuario->dataCdastro
					);
				}
				
				$this->session->set_userdata('logged_in', $config_array);
				redirect('home/dashboard', 'refresh');
			} else {
				redirect('login', 'refresh');
			}
		}
	}
}
