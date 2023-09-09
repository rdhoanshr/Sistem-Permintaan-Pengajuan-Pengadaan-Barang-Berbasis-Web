<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(['ion_auth', 'form_validation']);
		$this->load->helper(['url', 'language']);

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('auth');
	}

	public function index()
	{
		if ($this->ion_auth->logged_in()) {
			if ($this->ion_auth->in_group('staff')) {
				// die(var_dump($this->ion_auth->user()->row()->email));
				$data['title'] = 'Dashboard';
				$this->load->view('layout_backoffice/index', $data);
			} elseif ($this->ion_auth->in_group('unit')) {
				$data['title'] = 'Dashboard';
				$this->load->view('layout_backoffice/index', $data);
			} elseif ($this->ion_auth->in_group('kabag')) {
				$data['title'] = 'Dashboard';
				$this->load->view('layout_backoffice/index', $data);
			} elseif ($this->ion_auth->in_group('direktur')) {
				$data['title'] = 'Dashboard';
				$this->load->view('layout_backoffice/index', $data);
			} elseif ($this->ion_auth->in_group('vendor')) {
				$data['title'] = 'Dashboard';
				$this->load->view('layout_backoffice/index', $data);
			}
		} else {
			$data['title'] = 'Login';
			// $data['level'] = '';
			$this->load->view('auth/login', $data);
		}
	}
}
