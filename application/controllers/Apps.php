<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Apps extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Nasabah';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['nasabah'] = $this->db->get('nasabah')->result_array();

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('telepon', 'Nomor Telepon', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('apps/index', $data);
            $this->load->view('templates/footer');
        } else {
            $nama = htmlspecialchars($this->input->post('name', true));
            $data = [
                'nama' => $nama,
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'alamat' => htmlspecialchars($this->input->post('alamat', true)),
                'telepon' => htmlspecialchars($this->input->post('telepon', true))
            ];

            $this->db->insert('nasabah', $data);

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
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Nasabah added.</div>');
            redirect('apps');
        }
    }

    public function edit($id_nasabah)
    {
        $data['title'] = 'Nasabah';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['nasabah'] = $this->db->get_where('nasabah', ['id_nasabah' => $id_nasabah])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('apps/edit-nasabah', $data);
        $this->load->view('templates/footer');
    }

    public function update()
    {
        $id = $this->input->post('id_nasabah');
        $nama = htmlspecialchars($this->input->post('name'));
        $jenis_kelamin = $this->input->post('jenis_kelamin');
        $alamat = htmlspecialchars($this->input->post('alamat'));
        $telepon = htmlspecialchars($this->input->post('telepon'));
        $email = htmlspecialchars($this->input->post('email'));

        $data = [
            'nama' => $nama,
            'jenis_kelamin' => $jenis_kelamin,
            'alamat' => $alamat,
            'telepon' => $telepon,
            'email' => $email
        ];

        $where = [
            'id_nasabah' => $id
        ];

        $this->load->model('Apps_model', 'nasabah');
        $this->nasabah->update_nasabah($where, $data, 'nasabah');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data nasabah has been updated.</div>');
        redirect('apps');
    }

    public function delete($id_nasabah)
    {
        $where = ['id_nasabah' => $id_nasabah];
        $this->load->model('Apps_model', 'aplikasi');
        $this->aplikasi->delete_nasabah($where, 'nasabah');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data nasabah has been deleted.</div>');
        redirect('apps');
    }

    public function tabungan()
    {
        $data['title'] = 'Tabungan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Apps_model', 'aplikasi');
        $data['tabungan'] = $this->aplikasi->data_tabungan();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('apps/tabungan', $data);
        $this->load->view('templates/footer');
    }

    public function setoran()
    {
        $data['title'] = 'Tabungan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Apps_model', 'aplikasi');
        $data['tabungan'] = $this->aplikasi->data_tabungan();

        $this->form_validation->set_rules('setoran', 'Setoran', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('apps/setoran', $data);
            $this->load->view('templates/footer');
        } else {
            $id_nasabah = $this->input->post('id_nasabah');
            $penarikan = $this->input->post('penarikan');
            $setoran = reset_rupiah($this->input->post('setoran'));
            $saldo = reset_rupiah($this->input->post('setoran')) + reset_rupiah($this->input->post('saldo'));

            $data = [
                'id_nasabah' => $id_nasabah,
                'tanggal' => date('Y-m-d'),
                'setoran' => $setoran,
                'penarikan' => $penarikan,
                'saldo' => $saldo
            ];

            $this->db->insert('tabungan', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Saldo nasabah has been updated.</div>');
            redirect('apps/tabungan');
        }
    }

    public function detail($id_nasabah)
    {
        $data['title'] = 'Tabungan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['nasabah'] = $this->db->get_where('nasabah', ['id_nasabah' => $id_nasabah])->row_array();
        $data['tabungan'] = $this->db->get_where('tabungan', [
            'id_nasabah' => $id_nasabah,
            'saldo !=' => 0
        ])->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('apps/detail', $data);
        $this->load->view('templates/footer');
    }

    public function exportNasabah($id_nasabah)
    {
        $data['title'] = 'Tabungan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['nasabah'] = $this->db->get_where('nasabah', ['id_nasabah' => $id_nasabah])->row_array();
        $data['tabungan'] = $this->db->get_where('tabungan', [
            'id_nasabah' => $id_nasabah,
            'saldo !=' => 0
        ])->result_array();

        // Load all views as normal
        $this->load->view('export/export-nasabah', $data);

        // Get output html
        $html = $this->output->get_output();

        // Load library
        $this->load->library('dompdf_gen');

        // Setup paper size and orientation
        $paperSize = 'A4';
        $orientation = 'portrait';
        $this->dompdf->set_paper($paperSize, $orientation);

        // Convert to PDF
        $this->dompdf->load_html($html);
        $this->dompdf->render();

        // Set name by nasbah name
        $cariName = $this->db->get_where('nasabah', ['id_nasabah' => $id_nasabah])->row_array();
        $titleName = $cariName['nama'];
        $this->dompdf->stream($titleName . ".pdf", array("Attachment" => 0));
    }

    public function exportTrace()
    {
        $data['title'] = 'Portal';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Apps_model', 'aplikasi');
        $data['tabungan'] = $this->aplikasi->saldo_index_tabungan();
        $data['akun_sistem'] = $this->aplikasi->akun_sistem();
        $data['akun_nasabah'] = $this->aplikasi->akun_nasabah();
        $data['trace'] = $this->aplikasi->getDataTrace();

        // Load all views as normal
        $this->load->view('export/export-trace', $data);

        // Get output html
        $html = $this->output->get_output();

        // Load library
        $this->load->library('dompdf_gen');

        // Setup paper size and orientation
        $paperSize = 'A4';
        $orientation = 'portrait';
        $this->dompdf->set_paper($paperSize, $orientation);

        // Convert to PDF
        $this->dompdf->load_html($html);
        $this->dompdf->render();

        // Set titleName
        $this->dompdf->stream("Pembukuan Transaksi.pdf", array("Attachment" => 0));
    }

    public function penarikan()
    {
        $data['title'] = 'Tabungan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Apps_model', 'aplikasi');
        $data['tabungan'] = $this->aplikasi->data_tabungan();

        $this->form_validation->set_rules('penarikan', 'Penarikan', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('apps/penarikan', $data);
            $this->load->view('templates/footer');
        } else {
            $id_nasabah = $this->input->post('id_nasabah');
            $setoran = $this->input->post('setoran');
            $penarikan = reset_rupiah($this->input->post('penarikan'));
            $saldo = reset_rupiah($this->input->post('saldo')) - reset_rupiah($this->input->post('penarikan'));

            $data = [
                'id_nasabah' => $id_nasabah,
                'tanggal' => date('Y-m-d'),
                'setoran' => $setoran,
                'penarikan' => $penarikan,
                'saldo' => $saldo
            ];

            $this->db->insert('tabungan', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Saldo nasabah has been updated.</div>');
            redirect('apps/tabungan');
        }
    }

    public function info()
    {
        $data['title'] = 'Portal';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Apps_model', 'aplikasi');
        $data['tabungan'] = $this->aplikasi->saldo_index_tabungan();
        $data['akun_sistem'] = $this->aplikasi->akun_sistem();
        $data['akun_nasabah'] = $this->aplikasi->akun_nasabah();
        $data['trace'] = $this->aplikasi->getDataTrace();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('apps/info', $data);
        $this->load->view('templates/footer');
    }

    public function trsedit($id_tabungan)
    {
        $data['title'] = 'Tabungan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // cari id_nasabah utk kembali ke detail
        $cariNasabah = $this->db->get_where('tabungan', ['id_tabungan' => $id_tabungan])->row_array();
        // id_nasabah dimasukkan ke list data
        $data['backToPage'] = $cariNasabah['id_nasabah'];

        // var utk tabel is active
        $data['aktif'] = $id_tabungan;

        $this->load->model('Apps_model', 'detail');
        $data['tabungan'] = $this->detail->cari_detail($data['backToPage']);

        $data['transaksi'] = $this->db->get_where('tabungan', ['id_tabungan' => $id_tabungan])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('apps/edit-transaksi', $data);
        $this->load->view('templates/footer');
    }

    public function trsupdate()
    {
        $id_tabungan = $this->input->post('id_tabungan');
        $id_nasabah = $this->input->post('id_nasabah');
        $tanggal = $this->input->post('tanggal');
        $setoran = reset_rupiah($this->input->post('setoran'));
        $penarikan = reset_rupiah($this->input->post('penarikan'));
        $saldo = reset_rupiah($this->input->post('saldo'));

        $data = [
            'id_tabungan' => $id_tabungan,
            'id_nasabah' => $id_nasabah,
            'tanggal' => $tanggal,
            'setoran' => $setoran,
            'penarikan' => $penarikan,
            'saldo' => $saldo
        ];

        $where = [
            'id_tabungan' => $id_tabungan
        ];

        $this->load->model('Apps_model', 'transaksi');
        $this->transaksi->update_transaksi($where, $data, 'tabungan');

        // cari id_nasabah utk kembali ke detail
        $cariNasabah = $this->db->get_where('tabungan', ['id_tabungan' => $id_tabungan])->row_array();
        $id_nasabah = $cariNasabah['id_nasabah'];

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data transaksi has been updated.</div>');
        redirect('apps/detail/' . $id_nasabah);
    }

    public function trsdelete($id_nasabah)
    {
        $where = ['id_nasabah' => $id_nasabah];

        // load model
        $this->load->model('Apps_model', 'aplikasi');
        $this->aplikasi->delete_transaksi($where, 'tabungan');

        //biar data nasabah tidak hilang
        $data = [
            'id_nasabah' => $id_nasabah,
            'tanggal' => date('Y-m-d'),
            'setoran' => 0,
            'penarikan' => 0,
            'saldo' => 0
        ];
        $this->db->insert('tabungan', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data transaksi has been deleted.</div>');
        redirect('apps/detail/' . $id_nasabah);
    }

    public function transDelete($id_tabungan)
    {
        // cari id_nasabah utk kembali ke detail
        $cariNasabah = $this->db->get_where('tabungan', ['id_tabungan' => $id_tabungan])->row_array();
        $id_nasabah = $cariNasabah['id_nasabah'];

        $this->db->where('id_tabungan', $id_tabungan);
        $this->db->delete('tabungan');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Detail transaksi has been deleted.</div>');
        redirect('apps/detail/' . $id_nasabah);
    }
}
