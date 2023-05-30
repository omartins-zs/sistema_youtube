<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Cliente_model - Efetua a busca dos dados no banco
 *
 * @author Gabriel Martins
 */
class Cliente_model extends CI_Model
{
	function cadastracliente($dados = NULL)
	{
		if ($dados !== NULL) {
			extract($dados);
			$this->db->insert('clientes', array(
				'nomefantasia' => $dados['nomefantasia'],
				'razaosocial' => $dados['razaosocial'],
				'cnpj' => $dados['cnpj'],
				'cpf' => $dados['cpf'],
				'telefone' => $dados['telefone'],
				'celular' => $dados['celular'],
				'email' => $dados['email'],
				'endereco' => $dados['endereco'],
				'complemento' => $dados['complemento'],
				'bairro' => $dados['bairro'],
				'cidade' => $dados['cidade'],
				'estado' => $dados['estado'],
				'cep' => $dados['cep']
			));
			return true;
		} else {
			return false;
		}
	}
}