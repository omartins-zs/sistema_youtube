<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Pedido_model - Efetua a busca dos dados no banco
 *
 * @author Gabriel Martins
 */
class Pedido_model extends CI_Model
{
	function cadastrapedido($dados = NULL)
	{
		if ($dados !== NULL) {
			$this->db->insert('pedidos', $dados);
			return $this->db->insert_id();
		} else {
			return false;
		}
	}
}
