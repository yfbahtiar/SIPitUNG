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
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Apps_model', 'aplikasi');
        $data['akun_sistem'] = $this->aplikasi->akun_sistem();
        $data['akun_aktif'] = $this->aplikasi->akun_aktif();
        $data['akun_non_aktif'] = $this->aplikasi->akun_non_aktif();

        $data['akun'] = $this->db->get('user')->result_array();

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This Email has already registered.'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password dont match.',
            'min_length' => 'Password too short.'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
        $this->form_validation->set_rules('role_id', 'Role', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/index', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => htmlspecialchars($this->input->post('role_id', true)),
                'is_active' => 1,
                'date_created' => time()
            ];
            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New user has been added.</div>');
            redirect('admin/');
        }
    }

    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get('user_role')->result_array();


        $this->form_validation->set_rules('role', 'Role', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'role' => htmlspecialchars($this->input->post('role'))
            ];

            $this->db->insert('user_role', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New role has been added.</div>');
            redirect('admin/role');
        }
    }

    public function roleAccess($role_id)
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }

    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Access changed.</div>');
    }

    public function editRole($id_role)
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['id' => $id_role])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/edit-role', $data);
        $this->load->view('templates/footer');
    }

    public function updateRole()
    {
        $id = $this->input->post('id');
        $role = htmlspecialchars($this->input->post('name'));

        $this->db->set('role', $role);
        $this->db->where('id', $id);
        $this->db->update('user_role');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Role has been updates.</div>');
        redirect('admin/role');
    }

    public function deleteRole($id_role)
    {
        $this->db->where('id', $id_role);
        $this->db->delete('user_role');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Role has been deleted.</div>');
        redirect('admin/role');
    }

    public function deleteUser($id_user)
    {
        $this->db->where('id', $id_user);
        $this->db->delete('user');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akun has been deleted.</div>');
        redirect('admin/');
    }

    public function editUser($id_user)
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['akun'] = $this->db->get_where('user', ['id' => $id_user])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/edit-akun', $data);
        $this->load->view('templates/footer');
    }

    public function updateUser()
    {
        $id = $this->input->post('id');
        $data = [
            'name' => htmlspecialchars($this->input->post('name', true)),
            'email' => htmlspecialchars($this->input->post('email', true)),
            'role_id' => $this->input->post('role_id'),
            'is_active' => $this->input->post('is_active'),
        ];

        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update('user');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akun has been updates.</div>');
        redirect('admin/');
    }

    public function pengaduan()
    {
        $data['title'] = 'Pengaduan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Apps_model', 'aplikasi');
        $data['pengaduan_total'] = $this->aplikasi->pengaduan_total();
        $data['pengaduan_selesai'] = $this->aplikasi->pengaduan_selesai();
        $data['pengaduan_baru'] = $this->aplikasi->pengaduan_baru();
        $data['pengaduan'] = $this->db->get('pengaduan')->result_array();

        $clearHistory = $this->input->post('clear');
        if ($clearHistory == 1) {
            $this->db->truncate('pengaduan');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">History Pengaduan has been cleared.</div>');
            redirect('admin/pengaduan');
        } else {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/pengaduan.php', $data);
            $this->load->view('templates/footer');
        }
    }

    public function openRekening($id)
    {
        $data['title'] = 'Pengaduan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['nasabah'] = $this->db->get_where('pengaduan', ['id' => $id])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/open-rek', $data);
        $this->load->view('templates/footer');
    }

    public function activateRekening()
    {
        $status = htmlspecialchars(base64_decode($this->input->post('status')), true);

        if ($status == 'reject') {
            $idPengaduan = $this->input->post('id');
            $nama = htmlspecialchars($this->input->post('name'), true);
            $email = htmlspecialchars($this->input->post('email', true));

            $this->db->where('id', $idPengaduan);
            $this->db->update('pengaduan', [
                'status' => 1,
                'jenis' => 'Rekening Ditolak'
            ]);

            $data = [
                'email' => $email,
                'nama' => $nama,
                'rek' => 'Not Set'
            ];
            $this->_sendEmail($data, 'rejectOpenRek');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><strong>' . $email . '</strong> has been rejected to ceated new rekening.</div>');
            redirect('admin/pengaduan');
        } else {
            $idPengaduan = $this->input->post('id');
            $nama = htmlspecialchars($this->input->post('name'), true);
            $email = htmlspecialchars($this->input->post('email', true));
            $nasabah = [
                'nama' => $nama,
                'jenis_kelamin' => $this->input->post('jenis_kelamin', true),
                'alamat' => htmlspecialchars($this->input->post('alamat', true)),
                'telepon' => htmlspecialchars($this->input->post('telepon', true)),
                'email' => $email
            ];
            $this->db->insert('nasabah', $nasabah);

            $cariID = $this->db->get_where('nasabah', ['nama' => $nama])->row_array();
            $id_nasabah = $cariID['id_nasabah'];

            $tabungan = [
                'id_nasabah' => $id_nasabah,
                'tanggal' => date('Y-m-d'),
                'setoran' => 0,
                'penarikan' => 0,
                'saldo' => 0
            ];
            $this->db->insert('tabungan', $tabungan);

            $this->db->where('id', $idPengaduan);
            $this->db->update('pengaduan', ['status' => 1]);

            $data = [
                'email' => $email,
                'nama' => $nama,
                'rek' => $id_nasabah
            ];
            $this->_sendEmail($data, 'openRek');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><strong>' . $nama . '</strong> has been ceated new rekening.</div>');
            redirect('admin/pengaduan');
        }
    }

    public function dropRekening($id)
    {
        $cariIdPengaduan = $this->db->get_where('pengaduan', ['id' => $id])->row_array();
        $idPengaduan = $cariIdPengaduan['id'];
        $cariNamaNasabah = $cariIdPengaduan['nama'];

        $cariIdNasabah = $this->db->get_where('nasabah', ['nama' => $cariNamaNasabah])->row_array();
        $id_nasabah = $cariIdNasabah['id_nasabah'];
        $emailNasabah = $cariIdNasabah['email'];

        $where = ['id_nasabah' => $id_nasabah];

        // load model
        $this->load->model('Apps_model', 'aplikasi');
        $this->aplikasi->delete_transaksi($where, 'tabungan');

        $this->db->delete('nasabah', ['id_nasabah' => $id_nasabah]);

        $this->db->where('id', $idPengaduan);
        $this->db->update('pengaduan', ['status' => 1]);

        $data = [
            'email' => $emailNasabah,
            'nama' => $cariNamaNasabah,
            'rek' => $id_nasabah
        ];
        $this->_sendEmail($data, 'closeRek');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Rekening a.n <strong>' . $cariNamaNasabah . '</strong> has been droped.</div>');
        redirect('admin/pengaduan');
    }

    public function deleteAccount($id)
    {
        $cariIdPengaduan = $this->db->get_where('pengaduan', ['id' => $id])->row_array();
        $idPengaduan = $cariIdPengaduan['id'];
        $emailUser = $cariIdPengaduan['email'];

        $this->db->delete('user', ['email' => $emailUser]);

        $this->db->where('id', $idPengaduan);
        $this->db->update('pengaduan', ['status' => 1]);

        // kirim email
        $data = [
            'email' => $emailUser,
            'nama' => 'Not Set',
            'rek' => 'Not Set'
        ];
        $this->_sendEmail($data, 'deleteAkun');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Account with email <strong>' . $emailUser . '</strong> has been deleted.</div>');
        redirect('admin/pengaduan');
    }

    private function _sendEmail($data, $type)
    {
        $email = $data['email'];
        $namaNasabah = $data['nama'];
        $rekNasabah = $data['rek'];

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

        if ($type == 'openRek') {
            $this->email->subject('Pembukaan Rekening Baru');
            $this->email->message('Proses pengajuan pembukaan rekening telah disetujui. Selamat atas pembukaan rekening baru Anda.<br /><br />Nama: <strong>' . $namaNasabah . '</strong><br />No. Rekening: <strong>' . $rekNasabah . '</strong><br /><br />© 2020 SIPitUNG Member of gpsbekonang');
        } else if ($type == 'rejectOpenRek') {
            $this->email->subject('Pembukaan Rekening Baru Anda Ditolak');
            $this->email->message('Yth. ' . $namaNasabah . '<br /><br />Sayangnya, pengajuan pembukaan rekening Anda ditolak untuk berpartisipasi dalam kegiatan ini. <strong>Harap diperhatikan:</strong> Kegiatan ini sifatnya bukan publik.<br /><br />Terimakasih atas partisipasi Anda. Akun dengan email<strong> ' . $email . '</strong> tidak dihapus dari <i>database</i>. Anda bisa mengajukan permintaan penghapusan akun melalui menu CS Kami.<br /><br />© 2020 SIPitUNG Member of gpsbekonang');
        } else if ($type == 'closeRek') {
            $this->email->subject('Penutupan Rekening');
            $this->email->message('Proses pengajuan penutupan rekening telah disetujui. Terimakasih atas kepercayaan Anda.<br /><br />Nama: <strong>' . $namaNasabah . '</strong><br />No. Rekening: <strong>' . $rekNasabah . '</strong><br /><br />© 2020 SIPitUNG Member of gpsbekonang');
        } else if ($type == 'deleteAkun') {
            $this->email->subject('Penghapusan Akun');
            $this->email->message('Terimakasih atas kepercayaan Anda. Akun dengan email<strong> ' . $email . '</strong> telah dihapus dari <i>database</i><br /><br />© 2020 SIPitUNG Member of gpsbekonang');
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }
}
