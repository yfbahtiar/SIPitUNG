<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'SIPitUNG User Login';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            // validasi success, dibuat privat agar hanya bisa diakses oleh class ini saja || tidak bisa diakses url
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        // kalo ada usernya
        if ($user) {
            // jika usernya aktif
            if ($user['is_active'] == 1) {
                // cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('admin');
                    } else if ($user['role_id'] == 2) {
                        redirect('tabunganku');
                    } else {
                        redirect('apps/info');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password.</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">This email has not been activated.</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registered.</div>');
            redirect('auth');
        }
    }

    public function registration()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This Email has already registered.'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password dont match.',
            'min_length' => 'Password too short.'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'SIPitUNG User Registration';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post('email', true);
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($email),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 0,
                'date_created' => time()
            ];

            // siapkan token
            $token = rand(1000, 9999);
            $user_token = [
                'token' => $token,
                'date_created' => time()
            ];

            $this->db->insert('user', $data);
            $this->db->insert('user_token', $user_token);

            $this->_sendEmail($token, 'verify');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation! Your account has been created. Please activate Your account.</div>');
            redirect('auth/verify');
        }
    }


    private function _sendEmail($token, $type)
    {
        $email = $this->input->post('email');

        $config = [
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_user' => 'input-usernameEmail-your-email-here',
            'smtp_pass' => 'input-your-password-email',
            'smtp_port' => 465,
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n"
        ];


        // $this->load->library('email', $config);

        $this->email->initialize($config);

        $this->email->from('input-usernameEmail-your-email-here', 'SIPitUNG');
        $this->email->to($email);

        if ($type == 'verify') {
            $this->email->subject('Account Verification');
            $this->email->message('Please insert this code to activate Your account<h1>' . $token . '</h1>© 2020 SIPitUNG Member of gpsbekonang');

            $this->session->set_userdata('verify_email', $email);
        } else if ($type == 'forgot') {
            $this->email->subject('Reset Password');
            $this->email->message('Please insert this code to reset Your password<h1>' . $token . '</h1>© 2020 SIPitUNG Member of gpsbekonang');

            $this->session->set_userdata('forgot_password', $email);
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function verify()
    {
        $data['email'] = $this->session->userdata('verify_email');

        $this->form_validation->set_rules('token', 'Token', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'SIPitUNG User Verify';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/verify');
            $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post('email');
            $token = $this->input->post('token');

            $user = $this->db->get_where('user', ['email' => $email])->row_array();

            if ($user) {
                $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

                if ($user_token) {
                    if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                        $this->db->set('is_active', 1);
                        $this->db->where('email', $email);
                        $this->db->update('user');

                        $this->db->delete('user_token', ['token' => $token]);

                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">' . $email . ' has been activated, please login.</div>');
                        redirect('auth');
                    } else {
                        $this->db->delete('user', ['email' => $email]);
                        $this->db->delete('user_token', ['token' => $token]);

                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! Token expired.</div>');
                        redirect('auth/verify');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! Invalid token.</div>');
                    redirect('auth/verify');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! Wrong email.</div>');
                redirect('auth/verify');
            }
        }
    }


    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logged out.</div>');
        redirect('auth');
    }

    public function blocked()
    {
        $this->load->view('auth/blocked');
    }

    public function forgotPassword()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Forgot Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/forgot-password');
            $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();

            if ($user) {
                $token = rand(1000, 9999);
                $user_token = [
                    'token' => $token,
                    'date_created' => time()
                ];

                $this->db->insert('user_token', $user_token);
                $this->_sendEmail($token, 'forgot');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Please check Your email to reset password.</div>');
                redirect('auth/resetpassword');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Your email is not registered or not actived yet.</div>');
                redirect('auth/resetpassword');
            }
        }
    }

    public function resetPassword()
    {
        $this->form_validation->set_rules('token', 'Token', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'SIPitUNG Reset Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/reset-password');
            $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post('email');
            $token = $this->input->post('token');

            $this->session->set_userdata('forgot_password', $email);

            $user = $this->db->get_where('user', ['email' => $email])->row_array();

            if ($user) {
                $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

                if ($user_token) {
                    $this->session->set_userdata('reset_email', $email);
                    $this->session->set_userdata('reset_token', $token);
                    $this->changePassword();
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password failed! Invalid token.</div>');
                    redirect('auth/resetpassword');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password failed! Wrong email.</div>');
                redirect('auth/resetpassword');
            }
        }
    }

    public function changePassword()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('auth');
        }

        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[3]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Repeat Password', 'trim|required|min_length[3]|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Change Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/change-password');
            $this->load->view('templates/auth_footer');
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');
            $token = $this->session->userdata('reset_token');

            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->unset_userdata('reset_email');

            $this->db->delete('user_token', ['token' => $token]);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password has been changed, please login.</div>');
            redirect('auth');
        }
    }
}
