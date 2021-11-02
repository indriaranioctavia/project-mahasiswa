<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mhome extends CI_Model
{
    public function dosen_limit()
    {
        $sql = "SELECT * FROM dosen ORDER BY id_dosen DESC LIMIT 5";
        $query = $this->db->query($sql);

        if ($query->num_rows() == 0) {
            return 0;
        } else {
            return $query->result();
        }
    }
    public function mahasiswa_limit()
    {
        $sql = "SELECT * FROM mahasiswa ORDER BY id_mahasiswa DESC LIMIT 5";
        $query = $this->db->query($sql);

        if ($query->num_rows() == 0) {
            return 0;
        } else {
            return $query->result();
        }
    }
}
