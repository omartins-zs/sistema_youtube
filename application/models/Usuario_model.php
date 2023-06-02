<?php

// Efetua a busca dos dados no banco
class Usuario_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function login($login, $senha)
	{
		$this->db->select('*');
		$this->db->from('usuarios');
		$this->db->where('login', $login);
		$this->db->where('senha', $senha);
		$this->db->where('status', '1');
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->result();
	}

	function buscaUsuarioPerfil($perfil)
	{
		$this->db->select('nome');
		$this->db->from('usuarios');
		$this->db->where('perfilid', $perfil);
		$this->db->where('status', '1');

		$query = $this->db->get();
		if ($query->num_rows() >= 1) {
			return $query->result();
		} else {
			return false;
		}
	}

	function cadastrausuario($dados = NULL)
	{
		if ($dados !== NULL) {
			extract($dados);
			$this->db->insert('usuarios', array(
				'nome' => $dados['nome'],
				'login' => $dados['login'],
				'email' => $dados['email'],
				'senha' => $dados['senha'],
				'datacadastro' => $dados['datacadastro'],
				'perfilid' => $dados['perfilid'],
				'status' => $dados['status']
			));
			return true;
		} else {
			return false;
		}
	}

	function buscaUsuarios()
	{
		$this->db->select('*');
		$this->db->from('usuarios');
		$this->db->where('status', '1');

		$query = $this->db->get();
		if ($query->num_rows() >= 1) {
			return $query->result();
		} else {
			return false;
		}
	}

	function consultausuario($dados = NULL)
	{
		if ($dados !== NULL) {
			extract($dados);
			$this->db->select('*');
			$this->db->from('usuarios');
			$this->db->where('1 =1', null);

			if (!empty($dados['nome'])) {
				$this->db->like('nome', $dados['nome']);
			}

			if (!empty($dados['login'])) {
				$this->db->where('login', $dados['login']);
			}

			if (!empty($dados['email'])) {
				$this->db->where('email', $dados['email']);
			}

			$query = $this->db->get();
			if ($query->num_rows() >= 1) {
				return $query->result();
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	function consultausuarioespecifico($id)
	{
		$this->db->select('*');
		$this->db->from('usuarios');
		$this->db->where('id', $id);

		$query = $this->db->get();
		if ($query->num_rows() === 1) {
			return $query->result();
		} else {
			return false;
		}
	}

	function atualizausuario($dados = NULL)
	{
		if ($dados !== NULL) {
			extract($dados);
			$this->db->where('id', $dados['id']);
			$this->db->update('usuarios', array(
				'nome' => $dados['nome'],
				'login' => $dados['login'],
				'email' => $dados['email']
			));
			return true;
		} else {
			return false;
		}
	}
}
