<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('name');
            $username = $this->input->post('username');

            // cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '2048';
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                    redirect('user/edit');
                }
            }

            $this->db->set('name', $name);
            $this->db->where('username', $username);
            $this->db->update('tb_user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has been updated!</div>');
            redirect('user');
        }
    }

    public function changePassword()
    {
        $data['title'] = 'Change Password';
        $data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[3]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[3]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('user/changepassword', $data);
            $this->load->view('templates/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong current password!</div>');
                redirect('user/changepassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New password cannot be the same as current password!</div>');
                    redirect('user/changepassword');
                } else {
                    // password sudah oke
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('username', $this->session->userdata('username'));
                    $this->db->update('tb_user');
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password change!</div>');
                    redirect('user/changepassword');
                }
            }
        }
    }

    public function location()
    {
        $data['title'] = 'Tambah Location';
        $data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();

        $config['map_div_id'] = "map-add";
        $config['map_height'] = "250px";
        $config['center'] = '-3.4405486,114.7843735';
        $config['zoom'] = '12';
        $config['map_height'] = '400px;';
        $this->googlemaps->initialize($config);

        $marker = array();
        $marker['position'] = '-3.4405486,114.7843735';
        $marker['draggable'] = true;
        $marker['ondragend'] = 'setMapToForm(event.latLng.lat(), event.latLng.lng());';
        $this->googlemaps->add_marker($marker);
        $data['map'] = $this->googlemaps->create_map();

        $this->form_validation->set_rules('name', 'name', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('user/location', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Admin_model->tambahLoc();
            $this->session->set_flashdata('flash', 'Ditambah');
            redirect('user/location');
        }
    }

    public function peta()
    {
        $data['title'] = 'Peta Lokasi WiFi';
        $data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();

        $config['center'] = '-3.4405486,114.7843735';
        $config['zoom'] = '12';
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
            $marker['infowindow_content'] .= '<p><img src="' . $base_url . 'assets/img/tempat/' . $value->foto . '" style="width:300px;height:200px;"></p>';
            $marker['infowindow_content'] .= '</div>';
            $marker['infowindow_content'] .= '</div>';
            $marker['icon'] = base_url("public/icon/wifi.png");
            $this->googlemaps->add_marker($marker);
        endforeach;

        $this->googlemaps->initialize($config);

        $data['map'] = $this->googlemaps->create_map();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('user/peta', $data);
        $this->load->view('templates/footer');
    }

    public function searchQuery()
    {
        $this->db->select('tb_location.*');

        $this->db->where('tb_location.latitude !=', NULL)
            ->where('tb_location.longitude !=', NULL);

        return $this->db->get("tb_location")->result();
    }

    public function wifi()
    {
        $data['title'] = 'List Lokasi WiFi';
        $data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();

        $data['wifilist'] = $this->db->get('tb_location')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('user/wifi', $data);
        $this->load->view('templates/footer');
    }

    public function hapus_loc($id)
    {
        $data['gambar'] = $this->db->get_where('tb_location', ['id' => $id])->row_array();
        $image = $data['gambar']['foto'];
        unlink(FCPATH . 'assets/img/tempat/' . $image);
        $this->db->delete('tb_location', ['id' => $id]);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('user/wifi');
    }

    public function edit_loc($id)
    {
        $data['title'] = 'Edit Lokasi WiFi';
        $data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['location'] = $this->Admin_model->getLocById($id);

        $this->form_validation->set_rules('name', 'name', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('user/edit_loc', $data);
            $this->load->view('templates/footer');
        } else {

            $data = [
                "name" => $this->input->post('name'),
                "username" => $this->input->post('username'),
                "password" => $this->input->post('password'),
                "address" => $this->input->post('address')
            ];

            $this->db->where('id', $this->input->post('id'));
            $this->db->update('tb_location', $data);
            $this->session->set_flashdata('flash', 'Diubah');
            redirect('user/wifi');
        }
    }
}
