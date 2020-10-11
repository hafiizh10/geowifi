<?php

class Admin_model extends CI_Model
{
    public function getAllRole()
    {
        return $this->db->get('user_role')->result_array();
    }

    public function getRoleById($id)
    {
        return $this->db->get_where('user_role', ['id' => $id])->row_array();
    }

    public function getLocById($id)
    {
        return $this->db->get_where('tb_location', ['id' => $id])->row_array();
    }

    public function hapusDataRole($id)
    {
        $this->db->delete('user_role', ['id' => $id]);
    }

    public function editDataRole()
    {
        $data = [
            "role" => $this->input->post('role', true)
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('user_role', $data);
    }

    public function addUser()
    {
        $data = [
            "name" => $this->input->post('name', true),
            "username" => $this->input->post('username', true),
            "password" => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'image' => 'default.jpg',
            "jabatan" => $this->input->post('jabatan', true),
            "role_id" => $this->input->post('role_id', true)
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->insert('tb_user', $data);
    }

    public function hapusUser($id)
    {
        $this->db->delete('tb_user', ['id' => $id]);
    }

    public function tambahLoc()
    {
        $config['upload_path']          = './assets/img/tempat/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['overwrite']            = true;
        $config['max_size']             = 1024;

        $this->load->library('upload', $config);
        if ($this->upload->do_upload('foto') == "") {
            $foto = 'default.jpg';
        } else {
            $foto = $this->upload->data('file_name');
        }

        $data = [
            'name' => $this->input->post('name', true),
            'latitude' => $this->input->post('latitude', true),
            'longitude' => $this->input->post('longitude', true),
            'username' => $this->input->post('username', true),
            'password' => $this->input->post('password', true),
            'foto' => $foto,
            'address' => $this->input->post('address', true)
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->insert('tb_location', $data);
    }
}
