<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mmahasiswa extends CI_Model
{
    public function mahasiswa()
    {
        // pada variabel sql kita menampilkan data mahasiswa semuanya dilihat dari
        // * menandakan bahwa kita menampilkan field semuanya jika kita hanya butuh menampilkan nama mahasiswa seperti ini "SELECT nama FROM mahasiswa ORDER BY id_mahasiswa DESC"
        $sql = "SELECT * FROM mahasiswa ORDER BY id_mahasiswa DESC";
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

    // ($nama, $nim, $email, $jurusan, $foto) didalam kurung ini termasuk parameter yang dikirim dari controller
    public function mahasiswa_tambah($nama, $nim, $email, $jurusan, $foto)
    {
        // menambahkan data melalui parameter yang telah dikirim
        $sql = "INSERT INTO mahasiswa(`nama`, `nim`, `email`, `jurusan`, `foto`) VALUES ('$nama', '$nim', '$email', '$jurusan', '$foto')";
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


    public function mahasiswa_edit($id_mahasiswa)
    {
        // pada variabel sql kita menampilkan data mahasiswa semuanya dilihat dari
        // * menandakan bahwa kita menampilkan field semuanya jika kita hanya butuh menampilkan nama mahasiswa seperti ini "SELECT nama FROM mahasiswa ORDER BY id_mahasiswa DESC"
        // WHERE id_mahasiswa='$id_mahasiswa' == fungsi tersebut digunakan untuk mencari data yang sesuai id_mahasiswa
        $sql = "SELECT * FROM mahasiswa WHERE id_mahasiswa='$id_mahasiswa'";
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

    // ($nama, $nim, $email, $jurusan, $foto) didalam kurung ini termasuk parameter yang dikirim dari controller
    public function mahasiswa_edit_proses($id_mahasiswa, $nama, $nim, $email, $jurusan)
    {
        // menambahkan data melalui parameter yang telah dikirim
        $sql = "UPDATE mahasiswa SET `nama`='$nama', `nim`='$nim', `email`='$email', `jurusan`='$jurusan' WHERE id_mahasiswa='$id_mahasiswa'";
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

    // ($nama, $nim, $email, $jurusan, $foto) didalam kurung ini termasuk parameter yang dikirim dari controller
    public function mahasiswa_edit_prosesfoto($id_mahasiswa, $nama, $nim, $email, $jurusan, $foto)
    {
        // menambahkan data melalui parameter yang telah dikirim
        $sql = "UPDATE mahasiswa SET `nama`='$nama', `nim`='$nim',  `email`='$email', `jurusan`='$jurusan', `foto`='$foto' WHERE id_mahasiswa='$id_mahasiswa'";
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

    // ($id_mahasiswa) didalam kurung ini termasuk parameter yang dikirim dari controller
    public function mahasiswa_hapus($id_mahasiswa)
    {
        // menambahkan data melalui parameter yang telah dikirim
        $sql = "DELETE FROM `mahasiswa` WHERE id_mahasiswa='$id_mahasiswa'";
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
