<?php

// Efetua a busca dos dados no banco
class Perfil_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function buscaPerfil()
	{
		$this->db->select('perfilid,descricao');
		$this->db->from('perfil');

		$this->db->where('status', '1');
		$query = $this->db->get();
		return $query->result();
	}
}
