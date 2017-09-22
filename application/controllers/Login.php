<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		//load model and add alias
		parent::__construct();

			$this->load->model('m_pengguna');

	}


	public function index() {

		$this->load->view('login/v_login');

	}

	public function check_login() {

		 $this->m_pengguna->check_pengguna();

	}

	public function logout() {

		$this->session->sess_destroy();
			redirect('login');
	}

}
