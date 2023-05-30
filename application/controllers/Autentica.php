<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Autentica extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('security');
		$this->load->model('Usuario_model', '', TRUE);
	}

	public function logout()
	{
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('home', 'refresh');
	}

	public function index()
	{
		$this->load->library('form_validation');

		// Explicação do Form validation -> Tipo do campo | Nome para substituir '%s' | Regra
		$this->form_validation->set_message('required', 'Campo %s obrigatório');
		$this->form_validation->set_rules('login', 'Usuário', 'trim|required');
		$this->form_validation->set_rules('senha', 'Senha', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			// Falha na validação e direciona para Pagina de Login
			redirect('login', 'refresh');
			// $this->load->view('pages/login');
		} else {
			// Validação OK -> Acesso a área Privada

			$login = $this->input->post('login');
			$senha = $this->input->post('senha');

			$this->load->model('Usuario_model');
			$result = $this->Usuario_model->login($login, $senha);

			if ((isset($result)) && (!empty($result))) {
				$resultadoUsuario = $this->Usuario_model->login($login, $senha);

				foreach ($resultadoUsuario as $usuario) {
					$config_array = array(
						'UsuarioId' => $usuario->id,
						'nomeUsuario' => $usuario->nome,
						'loginUsuario' => $usuario->login,
						'emailUsuario' => $usuario->email,
						'datacadastro' => $usuario->datacadastro
					);
				}

				$this->session->set_userdata('logged_in', $config_array);
				// redirect -> Redireciona para controller e o metodo
				redirect('home/dashboard', 'refresh');
			} else {
				redirect('login', 'refresh');
			}
		}
	}
}
