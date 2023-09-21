<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(['ion_auth', 'form_validation']);

        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $this->load->model('UnitModel');
        $this->load->model('VendorModel');
    }


    public function index()
    {
        $data['title'] = 'Profile';
        $data['user'] = $this->ion_auth->user()->row();
        $data['unit'] = $this->UnitModel->lihat();
        $data['vendor'] = $this->VendorModel->lihat();
        $data['csrf'] = $this->_get_csrf_nonce();

        $tables = $this->config->item('tables', 'ion_auth');
        $user = $this->ion_auth->user()->row();
        if ($this->input->post('username') != $user->username) {
            $is_unique =  '|is_unique[' . $tables['users'] . '.username]';
        } else {
            $is_unique =  '';
        }
        if ($this->input->post('email') != $user->email) {
            $is_unique_email =  '|is_unique[' . $tables['users'] . '.email]';
        } else {
            $is_unique_email =  '';
        }
        $this->load->library('form_validation');
        $this->load->helper(array('security'));
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean' . $is_unique);
        $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'trim|required|valid_email' . $is_unique_email);
        // update the password if it was posted
        if ($this->input->post('password')) {
            $this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|matches[password_confirm]');
            $this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
        }
        $dir = $user->id;
        $config_sp['upload_path']          = './uploads/ttd/' . $dir;
        $config_sp['allowed_types']        = 'jpg|jpeg|png';
        $config_sp['max_size']             = 5000;

        $this->load->library('upload', $config_sp);

        if (!is_dir('uploads/ttd/' . $dir)) {
            mkdir('./uploads/ttd/' . $dir, 0777, TRUE);
        }
        if (!$this->upload->do_upload('ttd')) {
            $upload_ttd = $this->input->post('ttd_lama');
            // $this->form_validation->set_rules('ttd', 'ttd', 'required');
        } else {
            $upload_ttd = $this->upload->data('file_name');
        }

        if (!is_dir('uploads/ttd/' . $dir)) {
            mkdir('./uploads/ttd/' . $dir, 0777, TRUE);
        }
        if (!$this->upload->do_upload('foto')) {
            $upload_foto = $this->input->post('foto_lama');
            // $this->form_validation->set_rules('ttd', 'ttd', 'required');
        } else {
            $upload_foto= $this->upload->data('file_name');
        }
        // die (var_dump($upload_foto));
        if ($this->form_validation->run() == false) {
            $this->load->view('profile', $data);
        } else {
            $data = [
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'ttd' => $upload_ttd,
                'foto' => $upload_foto
            ];

            // update the password if it was posted
            if ($this->input->post('unit')) {
                $data['id_unit'] = $this->input->post('unit');
            }
            if ($this->input->post('vendor')) {
                $data['id_vendor'] = $this->input->post('vendor');
            }
            if ($this->input->post('password')) {
                $data['password'] = $this->input->post('password');
            }

            // check to see if we are updating the user
            if ($this->ion_auth->update($user->id, $data)) {
                // redirect them back to the admin page if admin, or to the base url if non admin
                $this->session->set_flashdata('pesanbaik', 'Profile Berhasil Di Update');
                redirect('profile', 'refresh');
            } else {
                // redirect them back to the admin page if admin, or to the base url if non admin
                $this->session->set_flashdata('pesanbaik', 'Profile Berhasil Di Update');
                redirect('profile', 'refresh');
            }
        }
    }


    public function _get_csrf_nonce()
    {
        $this->load->helper('string');
        $key = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_flashdata('csrfkey', $key);
        $this->session->set_flashdata('csrfvalue', $value);

        return [$key => $value];
    }
}
