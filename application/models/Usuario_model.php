<?php

// Efetua a busca dos dados no banco
class Usuario_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function login($login, $senha)
	{
		$this->db->select('id', 'nome', 'login', 'email');
		$this->db->from('usuarios');
		$this->db->where('login', $login);
		$this->db->where('senha', $senha);
		$this->db->where('status', '1');
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}
}
