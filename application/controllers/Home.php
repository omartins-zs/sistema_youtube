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
		// if ($this->session->userdata('logged_in')) { // VALIDA USUÁRIO LOGADO
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
    * CLIENTES
    */

	function cadastracliente()
	{
		if ($this->session->userdata('logged_in')) { // VALIDA USUÁRIO LOGADO
			$this->load->model('Perfil_model');
			$resultadoPerfil = $this->Perfil_model->buscaPerfil();
			$dados['resultadoPerfil'] = $resultadoPerfil;

			if ($this->input->post()) {

				if (
					(!empty(trim($this->input->post('nomefantasia')))) && (!empty(trim($this->input->post('razaosocial')))) &&
					//((!empty(trim($this->input->post('cnpj')))) && (!empty(trim($this->input->post('cpf'))))) &&
					(!empty(trim($this->input->post('telefone')))) && (!empty(trim($this->input->post('celular')))) && (!empty(trim($this->input->post('email')))) && (!empty(trim($this->input->post('endereco')))) &&
					(!empty(trim($this->input->post('complemento')))) && (!empty(trim($this->input->post('bairro')))) && (!empty(trim($this->input->post('cidade')))) && (!empty(trim($this->input->post('estado')))) &&
					(!empty(trim($this->input->post('cep'))))
				) {
					$dadoscliente['nomefantasia'] = $this->input->post('nomefantasia');
					$dadoscliente['razaosocial'] = $this->input->post('razaosocial');
					$dadoscliente['cnpj'] = $this->input->post('cnpj');
					$dadoscliente['cpf'] = $this->input->post('cpf');
					$dadoscliente['telefone'] = $this->input->post('telefone');
					$dadoscliente['celular'] = $this->input->post('celular');
					$dadoscliente['email'] = $this->input->post('email');
					$dadoscliente['endereco'] = $this->input->post('endereco');
					$dadoscliente['complemento'] = $this->input->post('complemento');
					$dadoscliente['bairro'] = $this->input->post('bairro');
					$dadoscliente['cidade'] = $this->input->post('cidade');
					$dadoscliente['estado'] = $this->input->post('estado');
					$dadoscliente['cep'] = $this->input->post('cep');

					$this->load->model('Cliente_model');
					$resultadocadastrocliente = $this->Cliente_model->cadastracliente($dadoscliente);

					if ($resultadocadastrocliente) {
						$dados['telaativa'] = 'clientes';
						$dados['msg'] = 'Cliente cadastrado com sucesso!!!';
						$dados['tela'] = 'clientes/cadastro_cliente';
					} else {
						$dados['telaativa'] = 'clientes';
						$dados['msg'] = 'Ocorreu um erro ao cadastrar o usuario! Atualize a página e tente novamente';
						$dados['tela'] = 'clientes/cadastro_cliente';
					}
					$this->load->view('pages/home', $dados);
				} else {
					$dados['telaativa'] = 'clientes';
					$dados['msg'] = 'Dados Imcompletos! Preencha os dados e tente novamente';
					$dados['tela'] = 'clientes/cadastro_cliente';
					$this->load->view('pages/home', $dados);
				}
			} else {
				$dados['telaativa'] = 'clientes';
				$dados['tela'] = 'clientes/cadastro_cliente';
				$this->load->view('pages/home', $dados);
			}
		}
	}

	function consultacliente()
	{
		if ($this->session->userdata('logged_in')) { // VALIDA USUARIO LOGADO
			$this->load->model('Perfil_model');
			$resultadoPerfil = $this->Perfil_model->buscaPerfil();
			$dados['resultadoPerfil'] = $resultadoPerfil;

			if ($this->input->post()) {
				$dados['nomefantasia'] = $this->input->post('nomefantasia');
				$dados['razaosocial'] = $this->input->post('razaosocial');
				$dados['cnpj'] = $this->input->post('cnpj');
				$dados['cpf'] = $this->input->post('cpf');
				$dados['email'] = $this->input->post('email');
				if ((!empty($dados['nomefantasia'])) || (!empty($dados['razaosocial'])) || (!empty($dados['cnpj'])) || (!empty($dados['cpf'])) || (!empty($dados['email']))) {
					$this->load->model('Cliente_model');
					$resultado = $this->Cliente_model->buscaclientefiltro($dados);
					if ($resultado) {
						$dados['clientelista'] = $resultado;
						$dados['telaativa'] = 'clientes';
						$dados['tela'] = 'clientes/lista_cliente';
						$this->load->view('pages/home', $dados);
					} else {
						$dados['telaativa'] = 'clientes';
						$dados['tela'] = 'clientes/form_consulta_cliente';
						$this->load->view('pages/home', $dados);
					}
				} else {
					$dados['telaativa'] = 'clientes';
					$dados['tela'] = 'clientes/form_consulta_cliente';
					$this->load->view('pages/home', $dados);
				}
			} else {
				$dados['telaativa'] = 'clientes';
				$dados['tela'] = 'clientes/form_consulta_cliente';
				$this->load->view('pages/home', $dados);
			}
		}
	}

	function listacliente()
	{
		if ($this->session->userdata('logged_in')) { // VALIDA USUÁRIO LOGADO
			$this->load->model('Perfil_model');
			$resultadoPerfil = $this->Perfil_model->buscaPerfil();
			$dados['resultadoPerfil'] = $resultadoPerfil;

			if ($this->input->post()) {
			} else {
				$this->load->model('Cliente_model');
				$resultadoClienteLista = $this->Cliente_model->buscaclienteslista();
				// var_dump($resultadoClienteLista);
				// die;
				$dados['clientelista'] = $resultadoClienteLista;
				$dados['telaativa'] = 'clientes';
				$dados['tela'] = 'clientes/lista_cliente';
				$this->load->view('pages/home', $dados);
			}
		}
	}

	function alteracliente()
	{
		if ($this->session->userdata('logged_in')) { // VALIDA USUÁRIO LOGADO
			$this->load->model('Perfil_model');
			$resultadoPerfil = $this->Perfil_model->buscaPerfil();
			$dados['resultadoPerfil'] = $resultadoPerfil;
			$this->load->model('Cliente_model');

			if ($this->input->post()) {
				if ($this->input->post('nomefantasia')) {
					if (
						(!empty(trim($this->input->post('nomefantasia')))) && (!empty(trim($this->input->post('razaosocial')))) &&
						//((!empty(trim($this->input->post('cnpj')))) && (!empty(trim($this->input->post('cpf'))))) &&
						(!empty(trim($this->input->post('telefone')))) && (!empty(trim($this->input->post('celular')))) && (!empty(trim($this->input->post('email')))) && (!empty(trim($this->input->post('endereco')))) &&
						(!empty(trim($this->input->post('complemento')))) && (!empty(trim($this->input->post('bairro')))) && (!empty(trim($this->input->post('cidade')))) && (!empty(trim($this->input->post('estado')))) &&
						(!empty(trim($this->input->post('cep'))))
					) {
						$dadoscliente['id'] = $this->input->post('clienteid');
						$dadoscliente['nomefantasia'] = $this->input->post('nomefantasia');
						$dadoscliente['razaosocial'] = $this->input->post('razaosocial');
						$dadoscliente['cnpj'] = $this->input->post('cnpj');
						$dadoscliente['cpf'] = $this->input->post('cpf');
						$dadoscliente['telefone'] = $this->input->post('telefone');
						$dadoscliente['celular'] = $this->input->post('celular');
						$dadoscliente['email'] = $this->input->post('email');
						$dadoscliente['endereco'] = $this->input->post('endereco');
						$dadoscliente['complemento'] = $this->input->post('complemento');
						$dadoscliente['bairro'] = $this->input->post('bairro');
						$dadoscliente['cidade'] = $this->input->post('cidade');
						$dadoscliente['estado'] = $this->input->post('estado');
						$dadoscliente['cep'] = $this->input->post('cep');

						$resultadoClienteLista = $this->Cliente_model->atualizacliente($dadoscliente);
						if ($resultadoClienteLista) {
							redirect('listacliente', 'refresh');
						} else {
							$dados['clientelista'] = $resultadoClienteLista;
							$dados['msg'] = '<font color="red"><b>Ocorreu um erro ao atualizar o cliente...</b></font>';
							$dados['telaativa'] = 'clientes';
							$dados['tela'] = 'clientes/form_altera_cliente';
							$this->load->view('pages/home', $dados);
						}
					} else {
						$dados['msg'] = '<font color="red"><b>Preencha todos os campos para continuar...</b></font>';
						$dados['telaativa'] = 'clientes';
						$dados['tela'] = 'clientes/form_altera_cliente';
						$this->load->view('pages/home', $dados);
					}
				} else {
					$resultadoClienteLista = $this->Cliente_model->buscaclienteslista();
					$dados['clientelista'] = $resultadoClienteLista;
					$dados['telaativa'] = 'clientes';
					$dados['tela'] = 'clientes/form_altera_cliente';
					$this->load->view('pages/home', $dados);
				}
			} else {
				$clienteid = $this->input->post('idcliente');
				$resultadoClienteLista = $this->Cliente_model->buscaclienteespecifico($clienteid);
				$dados['clientelista'] = $resultadoClienteLista;
				$dados['telaativa'] = 'clientes';
				$dados['tela'] = 'clientes/lista_cliente';
				$this->load->view('pages/home', $dados);
			}
		}
	}

	/*
     * Produtos
     */

	function cadastraproduto()
	{
		if ($this->session->userdata('logged_in')) { // VALIDA USUÁRIO LOGADO
			$this->load->model('Perfil_model');
			$resultadoPerfil = $this->Perfil_model->buscaPerfil();
			$dados['resultadoPerfil'] = $resultadoPerfil;

			if ($this->input->post()) {
				if (
					(!empty(trim($this->input->post('descricaoproduto')))) &&
					(!empty(trim($this->input->post('unidade')))) &&
					(!empty(trim($this->input->post('valormercadoria')))) &&
					(!empty(trim($this->input->post('valorvenda')))) &&
					(!empty(trim($this->input->post('qtdeestoque')))) &&
					(!empty(trim($this->input->post('descontopermitido')))) &&
					(!empty(trim($this->input->post('alertaestoque')))) &&
					(!empty(trim($this->input->post('qtdevendaminima')))) &&
					(!empty(trim($this->input->post('qtdevalorminimo')))) &&
					(!empty(trim($this->input->post('codigoean'))))
				) {
					$dadoscliente['descricaoproduto'] = $this->input->post('descricaoproduto');
					$dadoscliente['unidade'] = $this->input->post('unidade');
					$dadoscliente['valormercadoria'] = $this->input->post('valormercadoria');
					$dadoscliente['valorvenda'] = $this->input->post('valorvenda');
					$dadoscliente['qtdeestoque'] = $this->input->post('qtdeestoque');
					$dadoscliente['descontopermitido'] = $this->input->post('descontopermitido');
					$dadoscliente['alertaestoque'] = $this->input->post('alertaestoque');
					$dadoscliente['qtdevendaminima'] = $this->input->post('qtdevendaminima');
					$dadoscliente['qtdevalorminimo'] = $this->input->post('qtdevalorminimo');
					$dadoscliente['codigoean'] = $this->input->post('codigoean');

					$this->load->model('Produto_model');
					$resultadocadastroproduto = $this->Produto_model->cadastraproduto($dadoscliente);

					if ($resultadocadastroproduto) {
						// redirect('listaproduto', 'refresh');
					} else {
						$dados['telaativa'] = 'produtos';
						$dados['msg'] = 'Ocorreu um erro ao cadastrar o Produto! Atualize a p�gina e tente novamente';
						$dados['tela'] = 'produtos/cadastro_produto';
					}
					$this->load->view('pages/home', $dados);
				} else {
					$dados['telaativa'] = 'produtos';
					$dados['msg'] = 'Dados Imcompletos! Preencha os dados e tente novamente';
					$dados['tela'] = 'produtos/cadastro_produto';
					$this->load->view('pages/home', $dados);
				}
			} else {
				$dados['telaativa'] = 'produtos';
				$dados['tela'] = 'produtos/cadastro_produto';
				$this->load->view('pages/home', $dados);
			}
		}
	}

	function listaproduto()
	{
		if ($this->session->userdata('logged_in')) { // VALIDA USUÁRIO LOGADO
			$this->load->model('Perfil_model');
			$resultadoPerfil = $this->Perfil_model->buscaPerfil();
			$dados['resultadoPerfil'] = $resultadoPerfil;
			$this->load->model('Produto_model');
			if ($this->input->post()) {
			} else {

				$resultadoprodutos = $this->Produto_model->carregaprodutos();
				$dados['resultadoProduto'] = $resultadoprodutos;
				$dados['telaativa'] = 'produtos';
				$dados['tela'] = 'produtos/lista_produto';
				$this->load->view('pages/home', $dados);
			}
		}
	}

	function consultaproduto()
	{
		if ($this->session->userdata('logged_in')) { // VALIDA USUÁRIO LOGADO
			$this->load->model('Perfil_model');
			$resultadoPerfil = $this->Perfil_model->buscaPerfil();
			$dados['resultadoPerfil'] = $resultadoPerfil;

			if ($this->input->post()) {
				$dados['descricaoproduto'] = $this->input->post('descricaoproduto');
				$dados['codigoean'] = $this->input->post('codigoean');

				if ((!empty($dados['descricaoproduto'])) || (!empty($dados['codigoean']))) {
					$this->load->model('Produto_model');
					$resultadoprodutos = $this->Produto_model->carregaprodutosfiltro($dados);
					$dados['resultadoProduto'] = $resultadoprodutos;
					$dados['telaativa'] = 'produtos';
					$dados['tela'] = 'produtos/lista_produto';
					$this->load->view('pages/home', $dados);
				} else {
					$dados['telaativa'] = 'produtos';
					$dados['tela'] = 'produtos/consulta_produto';
					$this->load->view('pages/home', $dados);
				}
			} else {
				$dados['telaativa'] = 'produtos';
				$dados['tela'] = 'produtos/consulta_produto';
				$this->load->view('pages/home', $dados);
			}
		}
	}

	function alteraproduto()
	{
		if ($this->session->userdata('logged_in')) { // VALIDA USUÁRIO LOGADO
			$this->load->model('Perfil_model');
			$resultadoPerfil = $this->Perfil_model->buscaPerfil();
			$dados['resultadoPerfil'] = $resultadoPerfil;

			if ($this->input->post()) {
				if (
					(!empty(trim($this->input->post('produtoid')))) &&
					(!empty(trim($this->input->post('descricaoproduto')))) &&
					(!empty(trim($this->input->post('unidade')))) &&
					(!empty(trim($this->input->post('valormercadoria')))) &&
					(!empty(trim($this->input->post('valorvenda')))) &&
					(!empty(trim($this->input->post('qtdeestoque')))) &&
					//(!empty(trim($this->input->post('descontopermitido')))) &&
					(!empty(trim($this->input->post('alertaestoque')))) &&
					(!empty(trim($this->input->post('qtdevendaminima')))) &&
					(!empty(trim($this->input->post('qtdevalorminimo')))) &&
					(!empty(trim($this->input->post('codigoean'))))
				) {
					$dadoscliente['id'] = $this->input->post('produtoid');
					$dadoscliente['descricaoproduto'] = $this->input->post('descricaoproduto');
					$dadoscliente['unidade'] = $this->input->post('unidade');
					$dadoscliente['valormercadoria'] = $this->input->post('valormercadoria');
					$dadoscliente['valorvenda'] = $this->input->post('valorvenda');
					$dadoscliente['qtdeestoque'] = $this->input->post('qtdeestoque');
					if (!empty($this->input->post('descontopermitido'))) {
						$dadoscliente['descontopermitido'] = $this->input->post('descontopermitido');
					} else {
						$dadoscliente['descontopermitido'] = 0;
					}
					$dadoscliente['alertaestoque'] = $this->input->post('alertaestoque');
					$dadoscliente['qtdevendaminima'] = $this->input->post('qtdevendaminima');
					$dadoscliente['qtdevalorminimo'] = $this->input->post('qtdevalorminimo');
					$dadoscliente['codigoean'] = $this->input->post('codigoean');

					$this->load->model('Produto_model');
					$resultadocadastroproduto = $this->Produto_model->atualizaproduto($dadoscliente);

					if ($resultadocadastroproduto) {
						redirect('listaproduto', 'refresh');
					} else {
						$dados['telaativa'] = 'produtos';
						$dados['msg'] = 'Ocorreu um erro ao cadastrar o Produto! Atualize a p�gina e tente novamente';
						$dados['tela'] = 'produtos/form_alterar_produto';
					}
					$this->load->view('pages/home', $dados);
				} else {
					$dados['telaativa'] = 'produtos';
					$dados['msg'] = 'Dados Imcompletos! Preencha os dados e tente novamente';
					$dados['tela'] = 'produtos/form_alterar_produto';
					$this->load->view('pages/home', $dados);
				}
			} else if ($this->input->get('id')) {
				$produtoid = $this->input->get('id');
				$this->load->model('Produto_model');
				$dados['resultadoProduto'] = $this->Produto_model->carregaprodutosporid($produtoid);
				$dados['telaativa'] = 'produtos';
				$dados['tela'] = 'produtos/form_alterar_produto';
				$this->load->view('pages/home', $dados);
			} else {
				$dados['telaativa'] = 'produtos';
				$dados['tela'] = 'produtos/form_alterar_produto';
				$this->load->view('pages/home', $dados);
			}
		}
	}

	/*
    * Pedidos
    */

	function novopedido()
	{
		if ($this->session->userdata('logged_in')) { // VALIDA USUÁRIO LOGADO
			$session_data = $this->session->userdata('logged_in');
			$usuarioid = $session_data['UsuarioId'];
			$this->load->model('Perfil_model');
			$resultadoPerfil = $this->Perfil_model->buscaPerfil();
			$dados['resultadoPerfil'] = $resultadoPerfil;

			$this->load->model('Cliente_model');
			$resultadoClientes = $this->Cliente_model->carregaclientespedido();
			$dados['resultadoClientes'] = $resultadoClientes;

			$this->load->model('Produto_model');
			$resultadoProdutos = $this->Produto_model->carregaprodutos();
			$dados['resultadoProdutos'] = $resultadoProdutos;

			if ($this->input->post()) {
				var_dump($this->input->post());
				die;
				if (
					(!empty(trim($this->input->post('clienteid')))) &&
					(!empty(trim($this->input->post('codigopedido'))))
				) {
					$dadospedido['usuarioid'] = $usuarioid;
					$dadospedido['clienteid'] = $this->input->post('clienteid');
					$dadospedido['codigopedido'] = $this->input->post('codigopedido');
					$dadospedido['valorbruto'] = 0;
					$dadospedido['valorliquido'] = 0;
					$this->load->model('Pedido_model');
					$resultadocadastropedido = $this->Pedido_model->cadastrapedido($dadospedido);

					if ($resultadocadastropedido) {
						$dadositens['pedidoid'] = $resultadocadastropedido;
						$dadositens['clienteid'] = $this->input->post('clienteid');
						$dadositens['usuarioid'] = $usuarioid;
						$dadositens['produtoid'] = 0;
						$dadositens['quantidade'] = 0;
						$dadositens['valormercadoria'] = 0;
						$dadositens['valorvenda'] = 0;
						$dadositens['desconto'] = 0;

						$resultadocadastroitem = $this->Pedido_model->cadastraitens($dadositens);

						if ($resultadocadastroitem) {
							$dados['telaativa'] = 'pedido';
							$dados['msg'] = 'Pedido cadastrado com sucesso!!!';
							$dados['tela'] = 'pedidos/lista_pedidos';
						} else {
							$dados['telaativa'] = 'pedido';
							$dados['msg'] = 'Ocorreu um erro ao cadastrar os itens do Pedido! Atualize a pagina e tente novamente';
							$dados['tela'] = 'pedidos/cadastro_pedido';
						}
					} else {
						$dados['telaativa'] = 'pedido';
						$dados['msg'] = 'Ocorreu um erro ao cadastrar o Pedido! Atualize a pagina e tente novamente';
						$dados['tela'] = 'pedidos/cadastro_pedido';
					}
					$this->load->view('home', $dados);
				} else {
					$dados['telaativa'] = 'pedido';
					$dados['msg'] = 'Dados Imcompletos! Preencha os dados e tente novamente';
					$dados['tela'] = 'pedidos/cadastro_pedido';
					$this->load->view('pages/home', $dados);
				}
			} else {

				$dados['telaativa'] = 'pedido';
				$dados['tela'] = 'pedidos/cadastro_pedido';
				$this->load->view('pages/home', $dados);
			}
		}
	}

	function alterarpedido()
	{
		if ($this->session->userdata('logged_in')) { // VALIDA USUARIO LOGADO
			$this->load->model('Perfil_model');
			$resultadoPerfil = $this->Perfil_model->buscaPerfil();
			$dados['resultadoPerfil'] = $resultadoPerfil;

			if ($this->input->post()) {
			} else {
				$dados['telaativa'] = 'pedido';
				$dados['tela'] = 'produtos/consulta_produto';
				$this->load->view('pages/home', $dados);
			}
		}
	}

	function emissaopedido()
	{
		if ($this->session->userdata('logged_in')) { // VALIDA USUÁRIO LOGADO
			$this->load->model('Perfil_model');
			$resultadoPerfil = $this->Perfil_model->buscaPerfil();
			$dados['resultadoPerfil'] = $resultadoPerfil;

			if ($this->input->post()) {
			} else {
				$dados['telaativa'] = 'pedido';
				$dados['tela'] = 'produtos/lista_produto';
				$this->load->view('pages/home', $dados);
			}
		}
	}


	function consultarpedido()
	{
		if ($this->session->userdata('logged_in')) { // VALIDA USUÁRIO LOGADO
			$this->load->model('Perfil_model');
			$resultadoPerfil = $this->Perfil_model->buscaPerfil();
			$dados['resultadoPerfil'] = $resultadoPerfil;

			if ($this->input->post()) {
			} else {
				$dados['telaativa'] = 'pedido';
				$dados['tela'] = 'produtos/lista_produto';
				$this->load->view('pages/home', $dados);
			}
		}
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

	function geracodigobarras()
	{
		if ($this->input->post('codigoean')) {
			$codigoean = $this->input->post('codigoean');
			echo base_url('Barcode/barcode_generator') . '/code25/40/' . $codigoean . '/TRUE';
		} else {
			echo '';
		}
	}
}
