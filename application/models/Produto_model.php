<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Cliente_model - Efetua a busca dos dados no banco
 *
 * @author Gabriel Martins
 */
class Produto_model extends CI_Model
{
	function cadastraproduto($dados = NULL)
	{
		if ($dados !== NULL) {
			$this->db->insert('produtos', $dados);
			return true;
		} else {
			return false;
		}
	}

	function carregaprodutos()
	{
		$this->db->select('*');
		$this->db->from('produtos');

		$query = $this->db->get();
		if ($query) {
			return $query->result();
		} else {
			return false;
		}
	}
}
