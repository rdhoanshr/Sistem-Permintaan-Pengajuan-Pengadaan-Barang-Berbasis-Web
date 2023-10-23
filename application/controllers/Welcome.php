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

		$this->load->model('PengajuanModel');
	}

	public function index()
	{
		if ($this->ion_auth->logged_in()) {
			if ($this->ion_auth->in_group(2)) {
				$data['title'] = 'Dashboard';

				$data['menunggu'] = $this->PengajuanModel->totalMenunggu();
				$data['proses'] = $this->PengajuanModel->totalProses();
				$data['tinjau'] = $this->PengajuanModel->totalTinjau();
				$data['tolak'] = $this->PengajuanModel->totalTolak();
				$data['selesai'] = $this->PengajuanModel->totalSelesai();

				$this->load->view('layout_backoffice/index', $data);
			} elseif ($this->ion_auth->in_group(1)) {
				$data['title'] = 'Dashboard';

				$data['menunggu'] = $this->PengajuanModel->totalMenunggu_unit();
				$data['proses'] = $this->PengajuanModel->totalProses_unit();
				$data['tinjau'] = $this->PengajuanModel->totalTinjau_unit();
				$data['tolak'] = $this->PengajuanModel->totalTolak_unit();
				$data['selesai'] = $this->PengajuanModel->totalSelesai_unit();

				$this->load->view('layout_backoffice/index', $data);
			} elseif ($this->ion_auth->in_group(3)) {
				$data['title'] = 'Dashboard';

				$data['proses'] = $this->PengajuanModel->totalProses();
				$data['tinjau'] = $this->PengajuanModel->totalTinjau();
				$data['tolak'] = $this->PengajuanModel->totalTolak();
				$data['selesai'] = $this->PengajuanModel->totalSelesai();

				$this->load->view('layout_backoffice/index', $data);
			} elseif ($this->ion_auth->in_group(4)) {
				$data['title'] = 'Dashboard';

				$data['proses'] = $this->PengajuanModel->totalProses();
				$data['tinjau'] = $this->PengajuanModel->totalTinjau();
				$data['tolak'] = $this->PengajuanModel->totalTolak();
				$data['selesai'] = $this->PengajuanModel->totalSelesai();

				$this->load->view('layout_backoffice/index', $data);
				// } elseif ($this->ion_auth->in_group(5)) {
				// 	$data['title'] = 'Dashboard';

				// 	$data['menunggu'] = $this->PengajuanModel->totalMenunggu_vendor();
				// 	$data['tolak'] = $this->PengajuanModel->totalTolak_vendor();
				// 	$data['setuju'] = $this->PengajuanModel->totalSetuju_vendor();
				// 	$data['selesai'] = $this->PengajuanModel->totalSelesai_vendor();

				// 	$this->load->view('layout_backoffice/index_vendor', $data);
			}
		} else {
			$data['title'] = 'Login';

			$this->load->view('auth/login', $data);
		}
	}
}
