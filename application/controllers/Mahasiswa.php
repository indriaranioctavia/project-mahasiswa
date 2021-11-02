<?php
defined('BASEPATH') or exit('No direct script access allowed');

class mahasiswa extends CI_Controller
{
    public function index()
    {
        // kita panggil dulu nama model yang kita buat
        $this->load->model('Mmahasiswa');

        //memanggil database melalui model dengan tidak membawa nilai apapun ke modelnya
        $data['dtmahasiswa'] = $this->Mmahasiswa->mahasiswa();
        // membuat variabel active untuk membedakan menu
        $data['mmahasiswatampil'] = true;
        $data['title'] = "Mmahasiswa";
        //setelah itu model akan mengirimkan data sesuai permintaan yang akan diteruskan melalui view perhatikan parameter array yang ada di $data['dtmahasiswa] $data['dtmahasiswa]

        //untuk penamaan view_home bebas asalkan sama pada file yang ada di folder views
        $this->load->view('backend/part/header', $data);
        $this->load->view('backend/page/mahasiswa/view_mahasiswa_tampil');
        $this->load->view('backend/part/footer');
    }

    public function tambah()
    {
        // kita panggil dulu nama model yang kita buat
        $this->load->model('Mmahasiswa');

        // kita ambil nilai dulu yang ada didalam <form enctype="multipart/form-data" action="<?= base_url('mahasiswa/tambah');
        $nama = $this->input->post('txtnama');
        $nim = $this->input->post('txtnim');
        $email = $this->input->post('txtemail');
        $jurusan = $this->input->post('txtjurusan');
        

        // PEMANGGILAN NAMA DARI SUATU FOTO YANG AKAN DIAMBIL TIPE FILENYA
        //  $_FILES MEMANGGIL TXTFOTO DENGAN ATTRIBUT NAME
        $e = $_FILES['txtfoto']['name'];
        // EXPLODE DIGUNAKAN UNTUK MEMISAHKAN KALIMAT DARI SEBELUM TITIK . DAN SESUDAH TITIK .
        $x = explode(".", $e);
        // strtolower(end($x)) MENGAMBIL NILAI PALING AKHIR DARI VARIABEL X
        $ekstensi = strtolower(end($x));
        // MEMBUAT FILE FOTO mahasiswa YANG NNTINYA DIMASUKKAN KE DAABASE
        $foto = date('YmdHis') . "." . $ekstensi;

        /* Location FOTO YANG AKAN DISIMPAN */
        $location = "upload/mahasiswa/" . $foto;

        /* Valid Extensions TIPE FOTO YANG BISA DISIMPAN */
        $valid_extensions = array("jpg", "jpeg", "png");


        // MEMBERI LOGIKA IF (JIKA HASIL FOTO YANG DIUPLOAD TIDAK SAMA DENGAN EKSTENSI YANG DITENTUKAN MAKA AKAN ERROR)
        if (!in_array($ekstensi, $valid_extensions)) {
            // NOTIFIKASI UNTUK DITAMPILKAN DI HALAMAN mahasiswa
            $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Foto Salah!</strong> Kamu harus Upload foto dengan format JPG PNG JPEG.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            // REDIRECT BERPINDAH HALAMAN KE mahasiswa
            redirect('mahasiswa');
        } else {
            // LOGIKA IF [JIKA SISTEM SUDAH MEMINDAHKAN FOTO KEDALAM VARIABEL LOCATION DAN mengirimkan data yang ada di dalam kurung ini ($nama, $email, $jurusan, $foto)]
            if (move_uploaded_file($_FILES['txtfoto']['tmp_name'], $location) && $this->Mmahasiswa->mahasiswa_tambah($nama, $nim, $email, $jurusan, $foto)) {
                $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil Disimpan!</strong> Data ' . $nama . ' Sudah Tersimpan.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('mahasiswa');
            } else {
                $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal Simpan Data!</strong> Data ' . $nama . ' Belum Disimpan.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('mahasiswa');
            }
        }
    }

    // pada function kali ini berbeda dari yang diatas, dikarenakan ada parameter didalamnya function yaitu $id_mahasiswa
    // APA ITU PARAMETER ADALAH SEBUAH PERINTAH UNTUK MENYIMPAN NILAI YANG DISIMPAN DI VARIABEL seperti contoh dibawah ini kita menggunakan variabel $id_mahasiswa
    // $id_mahasiswa=0  YANG DIMAKSUD PADA VARIABEL INI ADALAH UNTUK MELIHAT JIKA PADA PERINTAH TIDAK ADA NILAINYA MAKA NILAI 0 INILAH YANG AKANN  DIGUNAKAN
    public function edit($id_mahasiswa = 0)
    {
        // melakukan logika terlebih dahulu untuk mengetahui $id_mahasiswa sudah ada nilainya atau tidak
        if ($id_mahasiswa == 0) {
            // NOTIFIKASI UNTUK DITAMPILKAN DI HALAMAN mahasiswa
            $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Ada yang Salah!</strong> URL tidak terdapat ID.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            // REDIRECT BERPINDAH HALAMAN KE mahasiswa
            redirect('mahasiswa');
        }

        // kita panggil dulu nama model yang kita buat
        $this->load->model('Mmahasiswa');

        //memanggil database melalui model dengan  membawa nilai $id_mahasiswa  ke modelnya
        $data['dtmahasiswaid'] = $this->Mmahasiswa->mahasiswa_edit($id_mahasiswa);

        // melakukan logika terlebih dahulu untuk mengetahui hasil dari model mahasiswa_edit sudah ada nilainya atau tidak
        if ($data['dtmahasiswaid'] == 0) {
            // NOTIFIKASI UNTUK DITAMPILKAN DI HALAMAN mahasiswa
            $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>ID Tidak Terdapat diDatabase!</strong> Silahkan Ulangi lagi.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            // REDIRECT BERPINDAH HALAMAN KE mahasiswa
            redirect('mahasiswa');
        }

        // membuat variabel active untuk membedakan menu
        $data['mmahasiswatampil'] = true;
        $data['title'] = "Edit mahasiswa";

        //untuk penamaan view_mahasiswa bebas asalkan sama pada file yang ada di folder views
        $this->load->view('backend/part/header', $data);
        $this->load->view('backend/page/mahasiswa/view_mahasiswa_edit');
        $this->load->view('backend/part/footer');
        // $data ini digunakan untuk mengirim nilai hasil dari pencarian melalui model $data['dtmahasiswa']
    }

   
    public function edit_proses()
    {
        // kita panggil dulu nama model yang kita buat
        $this->load->model('Mmahasiswa');

        // kita ambil nilai dulu yang ada didalam <form enctype="multipart/form-data" action="<?= base_url('mahasiswa/tambah');
        $id_mahasiswa = $this->input->post('txtid_mahasiswa');
        $namafoto = $this->input->post('txtnamafoto');
        $nama = $this->input->post('txtnama');
        $nim = $this->input->post('txtnim');
        $email = $this->input->post('txtemail');
        $jurusan = $this->input->post('txtjurusan');
        $foto =  $this->input->post('txtfoto');

        // PEMANGGILAN NAMA DARI SUATU FOTO YANG AKAN DIAMBIL TIPE FILENYA
        //  $_FILES MEMANGGIL TXTFOTO DENGAN ATTRIBUT NAME
        $e = $_FILES['txtfoto']['name'];
        // membuat logika jika foto tidak diedit / dirubah / diganti
        if ($e=="") {
            // jika tidak diedit maka yang dieksekusi hanya dibawah inni

            // update data melalui model
            if ($this->Mmahasiswa->mahasiswa_edit_proses($id_mahasiswa, $nama, $nim, $email, $jurusan) ){
                $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil Disimpan!</strong> Data ' . $nama . ' Sudah Tersimpan.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
                redirect('mahasiswa');
            } else {
                $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Gagal Simpan Data!</strong> Data ' . $nama . ' Belum Disimpan.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
                redirect('mahasiswa');
            }
        }else{
            // EXPLODE DIGUNAKAN UNTUK MEMISAHKAN KALIMAT DARI SEBELUM TITIK . DAN SESUDAH TITIK .
            $x = explode(".", $e);
            // strtolower(end($x)) MENGAMBIL NILAI PALING AKHIR DARI VARIABEL X
            $ekstensi = strtolower(end($x));
            // MEMBUAT FILE FOTO mahasiswa YANG NNTINYA DIMASUKKAN KE DAABASE
            $foto = date('YmdHis') . "." . $ekstensi;

            /* Location FOTO YANG AKAN DISIMPAN */
            $location = "upload/mahasiswa/" . $foto;

            /* Valid Extensions TIPE FOTO YANG BISA DISIMPAN */
            $valid_extensions = array("jpg", "jpeg", "png");


            // MEMBERI LOGIKA IF (JIKA HASIL FOTO YANG DIUPLOAD TIDAK SAMA DENGAN EKSTENSI YANG DITENTUKAN MAKA AKAN ERROR)
            if (!in_array($ekstensi, $valid_extensions)) {
                // NOTIFIKASI UNTUK DITAMPILKAN DI HALAMAN mahasiswa
                $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Foto Salah!</strong> Kamu harus Upload foto dengan format JPG PNG JPEG.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                // REDIRECT BERPINDAH HALAMAN KE mahasiswa
                redirect('mahasiswa');
            } else {
                // sekarang proses untuk menghapus gambar yang ada di dalam directory
                unlink(realpath('upload/mahasiswa/' . $namafoto));                

                // LOGIKA IF [JIKA SISTEM SUDAH MEMINDAHKAN FOTO KEDALAM VARIABEL LOCATION DAN mengirimkan data yang ada di dalam kurung ini ($nama, $nim, $email, $foto)]
                if (move_uploaded_file($_FILES['txtfoto']['tmp_name'], $location) && $this->Mmahasiswa->mahasiswa_edit_prosesfoto($id_mahasiswa, $nama, $nim, $email, $jurusan, $foto)) {
                    $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil Disimpan!</strong> Data ' . $nama . ' Sudah Tersimpan.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
                    redirect('mahasiswa');
                } else {
                    $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Gagal Simpan Data!</strong> Data ' . $nama . ' Belum Disimpan.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
                    redirect('mahasiswa');
                }
            }
        }
    }

    function hapus($id_mahasiswa = 0, $foto = 0)
    {
        // melakukan logika terlebih dahulu untuk mengetahui $id_mahasiswa sudah ada nilainya atau tidak
        if ($id_mahasiswa == 0 or $foto == '0') {
            // NOTIFIKASI UNTUK DITAMPILKAN DI HALAMAN mahasiswa
            $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Ada yang Salah!</strong> gagal hapus data, URL tidak terdapat ID.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            // REDIRECT BERPINDAH HALAMAN KE mahasiswa
            redirect('mahasiswa');
        }
        // kita panggil dulu nama model yang kita buat
        $this->load->model('Mmahasiswa');

        if ($foto != 'foto') {
            // menghilangkan foto pada directory
            unlink(realpath('upload/mahasiswa/' . $foto));
        }
        // LOGIKA IF [JIKA SISTEM SUDAH MEMINDAHKAN FOTO KEDALAM VARIABEL LOCATION DAN mengirimkan data yang ada di dalam kurung ini ($nama, $nim, $email, $foto)]
        if ($this->Mmahasiswa->mahasiswa_hapus($id_mahasiswa)) {
            $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil Disimpan!</strong> Data Sudah Tersimpan.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
            redirect('mahasiswa');
        } else {
            $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Gagal Hapus Data!</strong> Data Belum Dihapus ID tidak ditemukan.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
            redirect('mahasiswa');
        }
    }

}

