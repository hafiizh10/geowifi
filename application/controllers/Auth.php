<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function goToDefaultPage()
    {
        if ($this->session->userdata('role_id') == 1) {
            redirect('admin');
        } else if ($this->session->userdata('role_id') == 2) {
            redirect('user');
        }
    }

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->goToDefaultPage();
        $this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[5]|max_length[20]');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Halaman Login';
            $this->load->view('auth/login', $data);
        } else {
            $this->_login();
        }
    }

    public function searchQuery()
    {
        $this->db->select('tb_location.*');

        $this->db->where('tb_location.latitude !=', NULL)
            ->where('tb_location.longitude !=', NULL);

        return $this->db->get("tb_location")->result();
    }

    public function home()
    {
        $data['title'] = 'Peta Lokasi WiFi';

        $config['center'] = '-3.4405486,114.7843735';
        $config['zoom'] = '12';
        $config['map_type'] = 'HYBRID';
        $config['styles'] = array(
            array(
                "name" => "No Businesses",
                "definition" => array(
                    array(
                        "featureType" => "poi",
                        "elementType" =>
                        "business",
                        "stylers" => array(
                            array(
                                "visibility" => "off"
                            )
                        )
                    )
                )
            )
        );
        $this->googlemaps->initialize($config);
        foreach ($this->searchQuery() as $key => $value) :
            $marker = array();
            $marker['position'] = "{$value->latitude}, {$value->longitude}";

            $base_url = base_url();
            $marker['animation'] = 'DROP';
            $marker['infowindow_content'] = '<div class="media" style="width:300px;">';
            $marker['infowindow_content'] .= '<div class="media-left">';
            $marker['infowindow_content'] .= '</div>';
            $marker['infowindow_content'] .= '<div class="media-body">';
            $marker['infowindow_content'] .= '<h5 class="media-heading">' . $value->name . '</h5>';
            $marker['infowindow_content'] .= '<p><b>Username WiFi :</b> ' . $value->username . '</p>';
            $marker['infowindow_content'] .= '<p><b>Password WiFi :</b> ' . $value->password . '</p>';
            $marker['infowindow_content'] .= '<p><b>Alamat WiFi :</b> ' . $value->address . '</p><br>';
            $marker['infowindow_content'] .= '<p><img src="' . $base_url . 'assets/img/tempat/' . $value->foto . '" style="width:300px;height:200px;"></p><br>';
            $marker['infowindow_content'] .= '<center><a href="https://localhost/geowifi/hotspot/login.html" target="_blank"><button class="btn btn-danger">Connect WiFi</button></a></center>';
            $marker['infowindow_content'] .= '</div>';
            $marker['infowindow_content'] .= '</div>';
            $marker['icon'] = base_url("public/icon/wifi.png");
            $this->googlemaps->add_marker($marker);
        endforeach;

        $this->googlemaps->initialize($config);

        $data['map'] = $this->googlemaps->create_map();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/home', $data);
        $this->load->view('templates/footer', $data);
    }

    private function _login()
    {
        $this->goToDefaultPage();
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->db->get_where('tb_user', ['username' => $username])->row_array();

        // jika user ada
        if ($user) {
            // cek password user
            if (password_verify($password, $user['password'])) {
                $data = [
                    'username' => $user['username'],
                    'role_id' => $user['role_id'],
                    'jabatan' => $user['jabatan']
                ];
                $this->session->set_userdata($data);
                if ($user['role_id'] == 1) {
                    redirect('admin');
                } else {
                    redirect('user');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password anda salah!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Anda belum terdaftar!</div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akun anda sudah keluar!</div>');
        redirect('auth');
    }

    public function blocked()
    {
        $this->load->view('auth/blocked');
    }
}
