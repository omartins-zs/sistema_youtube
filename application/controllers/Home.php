<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->helper('form');
		date_default_timezone_set('America/Sao_Paulo');
	}

	public function index()
	{
		redirect('login');
	}

	public function logout()
	{
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('home', 'refresh');
	}

	public function dashboard()
	{
		// if ($this->session->userdata('logged_in')) { // VALIDA USUÁRIO LOGADO
		$this->load->view('pages/home');
		// } else {
		// redirect('login', 'refresh');
		// }
	}
	public function requisicaoajax()
	{
		// Valida se o Usuario está Logado
		if ($this->session->userdata('logged_in')) {
			$this->load->model('Perfil_model');
			$resultadoPerfil = $this->Perfil_model->buscaPerfil();

			$dados['resultadoPerfil'] = $resultadoPerfil;
			$dados['tela'] = 'requisicaoajax';
			$this->load->view('pages/home', $dados);
		} else {
			redirect('login', 'refresh');
		}
	}

	/*
    * USUARIOS
    */
	public function cadastrausuario()
	{
		// if ($this->session->userdata('logged_in')) { // VALIDA USUARIO LOGADO
		$this->load->model('Perfil_model');
		$resultadoPerfil = $this->Perfil_model->buscaPerfil();
		$dados['resultadoPerfil'] = $resultadoPerfil;

		if ($this->input->post()) {
			if ((!empty(trim($this->input->post('nome')))) || (!empty(trim($this->input->post('login')))) || (!empty(trim($this->input->post('email')))) || (!empty(trim($this->input->post('senha')))) || (!empty(trim($this->input->post('perfilid'))))) {

				$dadosusuario['nome'] = $this->input->post('nome');
				$dadosusuario['login'] = $this->input->post('login');
				$dadosusuario['email'] = $this->input->post('email');
				$dadosusuario['senha'] = $this->input->post('senha');
				$dadosusuario['datacadastro'] = date('Y-m-d');
				$dadosusuario['perfilid'] = $this->input->post('perfilid');
				$dadosusuario['status'] = 1;

				$this->load->model('Usuario_model');
				$resultadocadastrousuario = $this->Usuario_model->cadastrausuario($dadosusuario);

				if ($resultadocadastrousuario) {
					$dados['telaativa'] = 'usuarios';
					$dados['tela'] = 'dashboard';
				} else {
					$dados['telaativa'] = 'usuarios';
					$dados['msg'] = 'Ocorreu um erro ao cadastrar o usuario! Atualize a pagina e tente novamente';
					$dados['tela'] = 'usuarios/cadastro_usuario';
				}
				$this->load->view('pages/home', $dados);
			} else {
				$dados['telaativa'] = 'usuarios';
				$dados['msg'] = 'Dados Imcompletos! Preencha os dados e tente novamente';
				$dados['tela'] = 'usuarios/cadastro_usuario';
				$this->load->view('pages/home', $dados);
			}
		} else {
			$dados['telaativa'] = 'usuarios';
			$dados['tela'] = 'usuarios/cadastro_usuario';
			$this->load->view('pages/home', $dados);
		}
		// }
	}

	function listausuario()
	{
		// if ($this->session->userdata('logged_in')) { // VALIDA USUURIO LOGADO
		$this->load->model('Usuario_model');
		$resultadoUsuarios = $this->Usuario_model->buscaUsuarios();
		//var_dump($resultadoUsuarios);
		$dados['resultadoUsuario'] = $resultadoUsuarios;

		$dados['telaativa'] = 'usuarios';
		$dados['tela'] = 'usuarios/lista_usuario';
		$this->load->view('pages/home', $dados);
		// }
	}
}
