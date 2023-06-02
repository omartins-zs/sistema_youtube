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
}
