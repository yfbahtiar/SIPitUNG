<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tabungan_model extends CI_Model
{
    public function data_status($email)
    {
        $query = $this->db->get_where('nasabah', ['email' => $email]);
        // jika ada isinya, maka hitung brp jumlahnya
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    public function data_nasabah($keyword)
    {
        $query = " SELECT *
                    FROM nasabah
                    WHERE `nasabah`.`nama` LIKE '$keyword' OR
                          `nasabah`.`id_nasabah` LIKE '$keyword'
        ";
        $hasilCari = $this->db->query($query);
        if ($hasilCari->num_rows() > 0) {
            return $hasilCari->row_array();
        } else {
            return 0;
        }
    }

    public function data_tabungan($keyword)
    {
        $queryIdentity = " SELECT *
                            FROM nasabah
                            WHERE `nasabah`.`nama` LIKE '$keyword' OR
                            `nasabah`.`id_nasabah` LIKE '$keyword'
                        ";
        $hasilIdentity = $this->db->query($queryIdentity)->row_array();
        $id_nasabah = $hasilIdentity['id_nasabah'];

        return $this->db->get_where('tabungan', [
            'id_nasabah' => $id_nasabah,
            'saldo !=' => 0
        ])->result_array();
    }
}
