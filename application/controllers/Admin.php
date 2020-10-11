<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();

        $data['role'] = $this->db->get('user_role')->result_array();

        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('user_role', ['role' => $this->input->post('role')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New role added!</div>');
            redirect('admin/role');
        }
    }

    public function hapus($id)
    {
        $this->Admin_model->hapusDataRole($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('admin/role');
    }

    public function edit_role($id)
    {
        $data['title'] = 'Edit Role';
        $data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['user_role'] = $this->Admin_model->getRoleById($id);

        $data['role'] = $this->db->get('user_role')->result_array();

        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('admin/edit_role', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Admin_model->editDataRole();
            $this->session->set_flashdata('flash', 'Diubah');
            redirect('admin/role');
        }
    }

    public function roleaccess($role_id)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }

    public function user()
    {
        $data['title'] = 'User';
        $data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();

        $data['role'] = $this->db->get('user_role')->result_array();
        $data['userlist'] = $this->db->get('tb_user')->result_array();

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[tb_user.username]|min_length[5]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
        $this->form_validation->set_rules('role_id', 'Role id', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('admin/user', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Admin_model->addUser();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New user added!</div>');
            redirect('admin/user');
        }
    }

    public function hapus_user($id)
    {
        $this->Admin_model->hapusUser($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('admin/user');
    }
}
