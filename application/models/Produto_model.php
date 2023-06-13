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

	function carregaprodutosfiltro($dados)
	{
		if ($dados !== NULL) {
			$this->db->select('*');
			$this->db->from('produtos');
			if (!empty($dados['descricaoproduto'])) {
				$this->db->where('descricaoproduto', $dados['descricaoproduto']);
			} else {
				if (!empty($dados['codigoean'])) {
					$this->db->where('codigoean', $dados['codigoean']);
				} else {
					$this->db->where('produtoid', 0);
				}
			}
			$this->db->limit(1);
			$query = $this->db->get();
			if ($query) {
				return $query->result();
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
}
