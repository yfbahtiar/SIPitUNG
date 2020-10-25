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
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('name', 'Full name', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $email = htmlspecialchars($this->input->post('email'), true);

            $status = htmlspecialchars(base64_decode($this->input->post('status')), true);

            if ($status == 'delete') {
                $old_image = $this->input->post('image');
                $email = $this->input->post('email');
                $image = 'default.jpg';

                unlink(FCPATH . 'assets/img/profile/' . $old_image);

                $this->db->set('image', $image);
                $this->db->where('email', $email);
                $this->db->update('user');

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile picture has been deleted.</div>');
                redirect('user');
            } else {
                $name = htmlspecialchars($this->input->post('name'), true);

                //cek jika ada gambar yang diupload
                $upload_image = $_FILES['image']['name'];

                if ($upload_image) {
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size']     = '2048';
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
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Oops! Sorry, can not change image profile. Your file type is not supported or your file is too large file size.</div>');
                        redirect('user');
                    }
                }

                $this->db->set('name', $name);
                $this->db->where('email', $email);
                $this->db->update('user');

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has been updated.</div>');
                redirect('user');
            }
        }
    }

    public function changePassword()
    {
        $data['title'] = 'Change Password';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[3]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[3]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/changepassword', $data);
            $this->load->view('templates/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong current password.</div>');
                redirect('user/changepassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New password cannot be the same as current password.</div>');
                    redirect('user/changepassword');
                } else {
                    // password ok
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password changed.</div>');
                    redirect('user/changepassword');
                }
            }
        }
    }

    public function getTotalAlert()
    {
        $role = $this->session->userdata('role_id');
        // cari total user online
        if ($role != 3) {
            if ($role == 1) {
                $this->load->model('Apps_model', 'userAlert');
                $userAlert = $this->userAlert->user_alert_admin();
            } else {
                $emailUserAktif = $this->session->userdata('email');

                $this->load->model('Apps_model', 'userAlert');
                $userAlert = $this->userAlert->user_alert_user($emailUserAktif);
            }
        }

        $result['userAlert'] = $userAlert;
        $result['response'] = "True";
        echo json_encode($result);
    }
}
