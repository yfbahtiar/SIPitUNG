<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Apps_model extends CI_Model
{
    public function update_nasabah($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function delete_nasabah($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);

        $this->db->where($where);
        $this->db->delete('tabungan');
    }

    public function data_tabungan()
    {
        $query = " SELECT  tabungan.id_tabungan,
                           tabungan.id_nasabah,
                           tabungan.tanggal,
                           tabungan.setoran,
                           tabungan.penarikan,
                           tabungan.saldo,
                    SUM(tabungan.penarikan) AS jumlah_penarikan,
                    SUM(tabungan.setoran) AS jumlah_setoran,
                            nasabah.id_nasabah,
                            nasabah.nama,
                            nasabah.jenis_kelamin,
                            nasabah.alamat,
                            nasabah.telepon
                    FROM nasabah, tabungan
                    WHERE tabungan.id_nasabah = nasabah.id_nasabah
                    GROUP BY nasabah.nama DESC
        ";

        return $this->db->query($query)->result_array();
    }

    public function saldo_index_tabungan()
    {
        $query = " SELECT * FROM tabungan ";
        return $this->db->query($query)->result_array();
    }

    public function akun_sistem()
    {
        $query = $this->db->get('user');
        // jika ada isinya, maka hitung brp jumlahnya
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    public function akun_aktif()
    {
        $query = $this->db->get_where('user', ['is_active' => 1]);
        // jika ada isinya, maka hitung brp jumlahnya
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    public function akun_non_aktif()
    {
        $query = $this->db->get_where('user', ['is_active' => 0]);
        // jika ada isinya, maka hitung brp jumlahnya
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    public function akun_nasabah()
    {
        $query = $this->db->get('nasabah');
        // jika ada isinya, maka hitung brp jumlahnya
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    public function getDataTrace()
    {
        $query = "SELECT `tabungan`.*, `nasabah`.`nama`
                    FROM `tabungan` JOIN `nasabah`
                      ON `tabungan`.`id_nasabah` = `nasabah`.`id_nasabah`
                   WHERE `tabungan`.`saldo` != 0 OR `tabungan`.`setoran` != 0 OR `tabungan`.`penarikan` != 0
                ORDER BY `tabungan`.`id_tabungan` ASC
                ";
        return $this->db->query($query)->result_array();
    }

    public function update_transaksi($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function delete_transaksi($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function cari_detail($backToPage)
    {
        return $this->db->get_where('tabungan', [
            'id_nasabah' => $backToPage,
            'saldo !=' => 0
        ])->result_array();
    }

    public function pengaduan_selesai()
    {
        $query = $this->db->get_where('pengaduan', ['status' => 1]);
        // jika ada isinya, maka hitung brp jumlahnya
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    public function pengaduan_baru()
    {
        $query = $this->db->get_where('pengaduan', ['status' => 0]);
        // jika ada isinya, maka hitung brp jumlahnya
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    public function pengaduan_total()
    {
        $query = $this->db->get('pengaduan');
        // jika ada isinya, maka hitung brp jumlahnya
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    public function user_alert_admin()
    {
        $query = $this->db->get_where('pengaduan', ['status' => 0]);
        // jika ada isinya, maka hitung brp jumlahnya
        if ($query->num_rows() > 3) {
            return '3+';
        } elseif ($query->num_rows() <= 3 && $query->num_rows() != 0) {
            return $query->num_rows();
        }
    }

    public function user_alert_user($emailUserAktif)
    {

        $query = $this->db->get_where('pengaduan', ['email' => $emailUserAktif]);
        // jika ada isinya, maka hitung brp jumlahnya
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
    }
}
