<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mdosen extends CI_Model
{
    public function dosen()
    {
        // pada variabel sql kita menampilkan data dosen semuanya dilihat dari
        // * menandakan bahwa kita menampilkan field semuanya jika kita hanya butuh menampilkan nama dosen seperti ini "SELECT nama FROM dosen ORDER BY id_dosen DESC"
        $sql = "SELECT * FROM dosen ORDER BY id_dosen DESC";
        // code untuk memanggil pada query di database sesuai variabel $sql
        $query = $this->db->query($sql);

        // logika jika num_rows = menghitung pencarian didatabase sesuai variabel $query terdapat berapa baris?
        // jika hasilnya barisnya terdeteksi 0
        if ($query->num_rows() == 0) {
            // ini yang akan dijalankan hasilnya 0
            return 0;
        } else {
            // ini jika hasil barisnya lebih dari 0
            // result() perintah result() digunakan untuk memberikan hasil data dari variabel $query
            return $query->result();
        }
    }

    // ($nama, $nip, $email, $matakuliah, $foto) didalam kurung ini termasuk parameter yang dikirim dari controller
    public function dosen_tambah($nama, $nip, $email, $matakuliah, $foto)
    {
        // menambahkan data melalui parameter yang telah dikirim
        $sql = "INSERT INTO dosen(`nama`, `nip`, `email`, `matakuliah`, `foto`) VALUES ('$nama', '$nip', '$email', '$matakuliah', '$foto')";
        // code untuk memanggil pada query di database sesuai variabel $sql
        $query = $this->db->query($sql);

        // jika hasilnya berhasil disimpan
        if ($query) {
            // ini yang akan dijalankan hasilnya 1
            return 1;
        } else {
            return 0;
        }
    }


    public function dosen_edit($id_dosen)
    {
        // pada variabel sql kita menampilkan data dosen semuanya dilihat dari
        // * menandakan bahwa kita menampilkan field semuanya jika kita hanya butuh menampilkan nama dosen seperti ini "SELECT nama FROM dosen ORDER BY id_dosen DESC"
        // WHERE id_dosen='$id_dosen' == fungsi tersebut digunakan untuk mencari data yang sesuai id_dosen
        $sql = "SELECT * FROM dosen WHERE id_dosen='$id_dosen'";
        // code untuk memanggil pada query di database sesuai variabel $sql
        $query = $this->db->query($sql);

        // logika jika num_rows = menghitung pencarian didatabase sesuai variabel $query terdapat berapa baris?
        // jika hasilnya barisnya terdeteksi 0
        if ($query->num_rows() == 0) {
            // ini yang akan dijalankan hasilnya 0
            return 0;
        } else {
            // ini jika hasil barisnya lebih dari 0
            // result() perintah result() digunakan untuk memberikan hasil data dari variabel $query
            return $query->result();
        }
    }

    // ($nama, $nip, $email, $matakuliah, $foto) didalam kurung ini termasuk parameter yang dikirim dari controller
    public function dosen_edit_proses($id_dosen, $nama, $nip, $email, $matakuliah)
    {
        // menambahkan data melalui parameter yang telah dikirim
        $sql = "UPDATE dosen SET `nama`='$nama', `nip`='$nip', `email`='$email', `matakuliah`='$matakuliah' WHERE id_dosen='$id_dosen'";
        // code untuk memanggil pada query di database sesuai variabel $sql
        $query = $this->db->query($sql);

        // jika hasilnya berhasil disimpan
        if ($query) {
            // ini yang akan dijalankan hasilnya 1
            return 1;
        } else {
            return 0;
        }
    }

    // ($nama, $nip, $email, $matakuliah, $foto) didalam kurung ini termasuk parameter yang dikirim dari controller
    public function dosen_edit_prosesfoto($id_dosen, $nama, $nip, $email, $matakuliah, $foto)
    {
        // menambahkan data melalui parameter yang telah dikirim
        $sql = "UPDATE dosen SET `nama`='$nama', `nip`='$nip',  `email`='$email', `matakuliah`='$matakuliah', `foto`='$foto' WHERE id_dosen='$id_dosen'";
        // code untuk memanggil pada query di database sesuai variabel $sql
        $query = $this->db->query($sql);

        // jika hasilnya berhasil disimpan
        if ($query) {
            // ini yang akan dijalankan hasilnya 1
            return 1;
        } else {
            return 0;
        }
    }

    // ($id_dosen) didalam kurung ini termasuk parameter yang dikirim dari controller
    public function dosen_hapus($id_dosen)
    {
        // menambahkan data melalui parameter yang telah dikirim
        $sql = "DELETE FROM `dosen` WHERE id_dosen='$id_dosen'";
        // code untuk memanggil pada query di database sesuai variabel $sql
        $query = $this->db->query($sql);

        // jika hasilnya berhasil disimpan
        if ($query) {
            // ini yang akan dijalankan hasilnya 1
            return 1;
        } else {
            return 0;
        }
    }
}
