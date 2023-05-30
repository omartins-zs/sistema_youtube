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

	function consultausuario()
	{
		// if ($this->session->userdata('logged_in')) { // VALIDA USUARIO LOGADO
		$this->load->model('Usuario_model');
		if ($this->input->post()) {
			if ((!empty(trim($this->input->post('nome')))) || (!empty(trim($this->input->post('login')))) || (!empty(trim($this->input->post('email'))))) {
				$dadosusuario['nome'] = $this->input->post('nome');
				$dadosusuario['login'] = $this->input->post('login');
				$dadosusuario['email'] = $this->input->post('email');

				$this->load->model('Usuario_model');
				$resultadousuario = $this->Usuario_model->consultausuario($dadosusuario);
				if ($resultadousuario) {
					$dados['telaativa'] = 'usuarios';
					$dados['resultadoUsuario'] = $resultadousuario;
					$dados['tela'] = 'usuarios/lista_usuario';
					$this->load->view('pages/home', $dados);
				} else {
					$dados['telaativa'] = 'usuarios';
					$dados['msg'] = 'Nenhum Usuário localizado para os dados informados! Tente novamente';
					$dados['tela'] = 'usuarios/lista_usuario';
					$this->load->view('pages/home', $dados);
				}
			} else {
				$dados['telaativa'] = 'usuarios';
				$dados['msg'] = 'Dados Imcompletos! Preencha os dados e tente novamente';
				$dados['tela'] = 'usuarios/form_consulta_usuario';
				$this->load->view('pages/home', $dados);
			}
		} else if ($this->input->get()) {
			if ($this->input->get('id')) {
				$id = (int) $this->input->get('id');

				$this->load->model('Usuario_model');
				$resultadousuarioespecifico = $this->Usuario_model->consultausuarioespecifico($id);
				if ($resultadousuarioespecifico) {
					$dados['telaativa'] = 'usuarios';
					$dados['resultadoUsuarioEspecifico'] = $resultadousuarioespecifico;
					$dados['tela'] = 'usuarios/form_altera_usuario';
					$this->load->view('pages/home', $dados);
				} else {
					$dados['telaativa'] = 'usuarios';
					$dados['msg'] = 'Nenhum Usuário localizado para os dados informados! Tente novamente';
					$dados['tela'] = 'usuarios/lista_usuario';
					$this->load->view('pages/home', $dados);
				}
			}
		} else {
			$dados['telaativa'] = 'usuarios';
			$dados['tela'] = 'usuarios/form_consulta_usuario';
			$this->load->view('pages/home', $dados);
		}
		// }
	}


	function atualizausuario()
	{
		// if ($this->session->userdata('logged_in')) { // VALIDA USU�RIO LOGADO
		$this->load->model('Perfil_model');
		$resultadoPerfil = $this->Perfil_model->buscaPerfil();
		$dados['resultadoPerfil'] = $resultadoPerfil;

		if ($this->input->post()) {
			if ((!empty(trim($this->input->post('id')))) || (!empty(trim($this->input->post('nome')))) || (!empty(trim($this->input->post('login')))) || (!empty(trim($this->input->post('email'))))) {
				$dadosusuario['id'] = $this->input->post('id');
				$dadosusuario['nome'] = $this->input->post('nome');
				$dadosusuario['login'] = $this->input->post('login');
				$dadosusuario['email'] = $this->input->post('email');

				$this->load->model('Usuario_model');
				$resultadoatualizausuario = $this->Usuario_model->atualizausuario($dadosusuario);
				if ($resultadoatualizausuario) {
					$dados['telaativa'] = 'usuarios';
					$dados['msg'] = 'Usuário alterado com sucesso!';
					$dados['tela'] = 'usuarios/form_consulta_usuario';
					$this->load->view('pages/home', $dados);
				} else {
					$dados['telaativa'] = 'usuarios';
					$dados['msg'] = 'Ocorreu um erro ao alterar o usuario! Atualize a página e tente novamente';
					$dados['tela'] = 'usuarios/form_consulta_usuario';
					$this->load->view('pages/home', $dados);
				}
			} else {
				$dados['telaativa'] = 'usuarios';
				$dados['msg'] = 'Dados Imcompletos! Preencha os dados e tente novamente';
				$dados['tela'] = 'usuarios/form_consulta_usuario';
				$this->load->view('pages/home', $dados);
			}
		} else {
			$dados['telaativa'] = 'usuarios';
			$dados['tela'] = 'usuarios/cadastro_usuario';
			$this->load->view('pages/home', $dados);
		}
		// }
	}

	/*
	* AUXILIARES (AJAX)
	*/

	public function buscaUsuarioPerfil()
	{
		// Valida se o Usuario esta Logado
		if ($this->session->userdata('logged_in')) {
			$option = "";

			if ($this->input->post()) {
				$perfil = $this->input->post('perfil');
				$this->load->model('Usuario_model');
				$resultadoUsuarioPerfil = $this->Usuario_model->buscaUsuarioPerfil($perfil);
				if ($resultadoUsuarioPerfil) {
					foreach ($resultadoUsuarioPerfil as $Usuario) {
						$option .= $Usuario->nome;
					}
				} else {
					$option .= 'Nenhum Valor Encontrado';
				}
			} else {
				$option .= 'Nenhum Valor Encontrado';
			}
			echo $option;
		}
	}
}
