<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TabunganKu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }


    public function index()
    {
        $email = $this->session->userdata('email');
        $data['title'] = 'Home';
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();

        $cariIdNasabah = $this->db->get_where('nasabah', ['email' => $email])->row_array();
        $keyword = $cariIdNasabah['id_nasabah'];

        $this->load->model('Tabungan_model', 'tabungan');
        $data['nasabah'] = $this->tabungan->data_nasabah($keyword);
        $data['tabungan'] = $this->tabungan->data_tabungan($keyword);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('tabunganku/index', $data);
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

    public function cs()
    {
        $email = $this->session->userdata('email');
        $data['title'] = 'Customer Service';
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();

        $this->load->model('Tabungan_model', 'tabungan');
        $data['status'] = $this->tabungan->data_status($email);

        $data['nasabah'] = $this->db->get_where('nasabah', ['email' => $email])->row_array();

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('telepon', 'Telepon', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('tabunganku/cs', $data);
            $this->load->view('templates/footer');
        } else {
            $jenis = htmlspecialchars($this->input->post('jenis', true));
            $data = [
                'nama' => htmlspecialchars($this->input->post('name', true)),
                'jenis_kelamin' => htmlspecialchars($this->input->post('jenis_kelamin', true)),
                'alamat' => htmlspecialchars($this->input->post('alamat', true)),
                'telepon' => htmlspecialchars($this->input->post('telepon', true)),
                'email' => $this->input->post('email'),
                'jenis' => $jenis,
                'status' => 0
            ];

            $this->db->insert('pengaduan', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">' . $jenis . ' Anda has been recorded.</div>');
            redirect('tabunganku/cs');
        }
    }
}
