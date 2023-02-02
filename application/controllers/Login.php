<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
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
		$this->load->helper(array('form'));
		$this->load->view('pages/login');
	}
}
