<?php
defined('BASEPATH') or exit('No direct script access allowed');

class dosen extends CI_Controller
{
    public function index()
    {
        // kita panggil dulu nama model yang kita buat
        $this->load->model('Mdosen');

        //memanggil database melalui model dengan tidak membawa nilai apapun ke modelnya
        $data['dtdosen'] = $this->Mdosen->dosen();
        // membuat variabel active untuk membedakan menu
        $data['mdosentampil'] = true;
        $data['title'] = "Mdosen";
        //setelah itu model akan mengirimkan data sesuai permintaan yang akan diteruskan melalui view perhatikan parameter array yang ada di $data['dtdosen] $data['dtdosen]

        //untuk penamaan view_home bebas asalkan sama pada file yang ada di folder views
        $this->load->view('backend/part/header', $data);
        $this->load->view('backend/page/dosen/view_dosen_tampil');
        $this->load->view('backend/part/footer');
    }

    public function tambah()
    {
        // kita panggil dulu nama model yang kita buat
        $this->load->model('Mdosen');

        // kita ambil nilai dulu yang ada didalam <form enctype="multipart/form-data" action="<?= base_url('dosen/tambah');
        $nama = $this->input->post('txtnama');
        $nip = $this->input->post('txtnip');
        $email = $this->input->post('txtemail');
        $matakuliah = $this->input->post('txtmatakuliah');
        

        // PEMANGGILAN NAMA DARI SUATU FOTO YANG AKAN DIAMBIL TIPE FILENYA
        //  $_FILES MEMANGGIL TXTFOTO DENGAN ATTRIBUT NAME
        $e = $_FILES['txtfoto']['name'];
        // EXPLODE DIGUNAKAN UNTUK MEMISAHKAN KALIMAT DARI SEBELUM TITIK . DAN SESUDAH TITIK .
        $x = explode(".", $e);
        // strtolower(end($x)) MENGAMBIL NILAI PALING AKHIR DARI VARIABEL X
        $ekstensi = strtolower(end($x));
        // MEMBUAT FILE FOTO dosen YANG NNTINYA DIMASUKKAN KE DAABASE
        $foto = date('YmdHis') . "." . $ekstensi;

        /* Location FOTO YANG AKAN DISIMPAN */
        $location = "upload/dosen/" . $foto;

        /* Valid Extensions TIPE FOTO YANG BISA DISIMPAN */
        $valid_extensions = array("jpg", "jpeg", "png");


        // MEMBERI LOGIKA IF (JIKA HASIL FOTO YANG DIUPLOAD TIDAK SAMA DENGAN EKSTENSI YANG DITENTUKAN MAKA AKAN ERROR)
        if (!in_array($ekstensi, $valid_extensions)) {
            // NOTIFIKASI UNTUK DITAMPILKAN DI HALAMAN dosen
            $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Foto Salah!</strong> Kamu harus Upload foto dengan format JPG PNG JPEG.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            // REDIRECT BERPINDAH HALAMAN KE dosen
            redirect('dosen');
        } else {
            // LOGIKA IF [JIKA SISTEM SUDAH MEMINDAHKAN FOTO KEDALAM VARIABEL LOCATION DAN mengirimkan data yang ada di dalam kurung ini ($nama, $email, $matakuliah, $foto)]
            if (move_uploaded_file($_FILES['txtfoto']['tmp_name'], $location) && $this->Mdosen->dosen_tambah($nama, $nip, $email, $matakuliah, $foto)) {
                $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil Disimpan!</strong> Data ' . $nama . ' Sudah Tersimpan.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('dosen');
            } else {
                $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal Simpan Data!</strong> Data ' . $nama . ' Belum Disimpan.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('dosen');
            }
        }
    }

    // pada function kali ini berbeda dari yang diatas, dikarenakan ada parameter didalamnya function yaitu $id_dosen
    // APA ITU PARAMETER ADALAH SEBUAH PERINTAH UNTUK MENYIMPAN NILAI YANG DISIMPAN DI VARIABEL seperti contoh dibawah ini kita menggunakan variabel $id_dosen
    // $id_dosen=0  YANG DIMAKSUD PADA VARIABEL INI ADALAH UNTUK MELIHAT JIKA PADA PERINTAH TIDAK ADA NILAINYA MAKA NILAI 0 INILAH YANG AKANN  DIGUNAKAN
    public function edit($id_dosen = 0)
    {
        // melakukan logika terlebih dahulu untuk mengetahui $id_dosen sudah ada nilainya atau tidak
        if ($id_dosen == 0) {
            // NOTIFIKASI UNTUK DITAMPILKAN DI HALAMAN dosen
            $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Ada yang Salah!</strong> URL tidak terdapat ID.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            // REDIRECT BERPINDAH HALAMAN KE dosen
            redirect('dosen');
        }

        // kita panggil dulu nama model yang kita buat
        $this->load->model('Mdosen');

        //memanggil database melalui model dengan  membawa nilai $id_dosen  ke modelnya
        $data['dtdosenid'] = $this->Mdosen->dosen_edit($id_dosen);

        // melakukan logika terlebih dahulu untuk mengetahui hasil dari model dosen_edit sudah ada nilainya atau tidak
        if ($data['dtdosenid'] == 0) {
            // NOTIFIKASI UNTUK DITAMPILKAN DI HALAMAN dosen
            $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>ID Tidak Terdapat diDatabase!</strong> Silahkan Ulangi lagi.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            // REDIRECT BERPINDAH HALAMAN KE dosen
            redirect('dosen');
        }

        // membuat variabel active untuk membedakan menu
        $data['mdosentampil'] = true;
        $data['title'] = "Edit dosen";

        //untuk penamaan view_dosen bebas asalkan sama pada file yang ada di folder views
        $this->load->view('backend/part/header', $data);
        $this->load->view('backend/page/dosen/view_dosen_edit');
        $this->load->view('backend/part/footer');
        // $data ini digunakan untuk mengirim nilai hasil dari pencarian melalui model $data['dtdosen']
    }

   
    public function edit_proses()
    {
        // kita panggil dulu nama model yang kita buat
        $this->load->model('Mdosen');

        // kita ambil nilai dulu yang ada didalam <form enctype="multipart/form-data" action="<?= base_url('dosen/tambah');
        $id_dosen = $this->input->post('txtid_dosen');
        $namafoto = $this->input->post('txtnamafoto');
        $nama = $this->input->post('txtnama');
        $nip = $this->input->post('txtnip');
        $email = $this->input->post('txtemail');
        $matakuliah = $this->input->post('txtmatakuliah');
        $foto =  $this->input->post('txtfoto');

        // PEMANGGILAN NAMA DARI SUATU FOTO YANG AKAN DIAMBIL TIPE FILENYA
        //  $_FILES MEMANGGIL TXTFOTO DENGAN ATTRIBUT NAME
        $e = $_FILES['txtfoto']['name'];
        // membuat logika jika foto tidak diedit / dirubah / diganti
        if ($e=="") {
            // jika tidak diedit maka yang dieksekusi hanya dibawah inni

            // update data melalui model
            if ($this->Mdosen->dosen_edit_proses($id_dosen, $nama, $nip, $email, $matakuliah) ){
                $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil Disimpan!</strong> Data ' . $nama . ' Sudah Tersimpan.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
                redirect('dosen');
            } else {
                $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Gagal Simpan Data!</strong> Data ' . $nama . ' Belum Disimpan.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
                redirect('dosen');
            }
        }else{
            // EXPLODE DIGUNAKAN UNTUK MEMISAHKAN KALIMAT DARI SEBELUM TITIK . DAN SESUDAH TITIK .
            $x = explode(".", $e);
            // strtolower(end($x)) MENGAMBIL NILAI PALING AKHIR DARI VARIABEL X
            $ekstensi = strtolower(end($x));
            // MEMBUAT FILE FOTO dosen YANG NNTINYA DIMASUKKAN KE DAABASE
            $foto = date('YmdHis') . "." . $ekstensi;

            /* Location FOTO YANG AKAN DISIMPAN */
            $location = "upload/dosen/" . $foto;

            /* Valid Extensions TIPE FOTO YANG BISA DISIMPAN */
            $valid_extensions = array("jpg", "jpeg", "png");


            // MEMBERI LOGIKA IF (JIKA HASIL FOTO YANG DIUPLOAD TIDAK SAMA DENGAN EKSTENSI YANG DITENTUKAN MAKA AKAN ERROR)
            if (!in_array($ekstensi, $valid_extensions)) {
                // NOTIFIKASI UNTUK DITAMPILKAN DI HALAMAN dosen
                $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Foto Salah!</strong> Kamu harus Upload foto dengan format JPG PNG JPEG.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                // REDIRECT BERPINDAH HALAMAN KE dosen
                redirect('dosen');
            } else {
                // sekarang proses untuk menghapus gambar yang ada di dalam directory
                unlink(realpath('upload/dosen/' . $namafoto));                

                // LOGIKA IF [JIKA SISTEM SUDAH MEMINDAHKAN FOTO KEDALAM VARIABEL LOCATION DAN mengirimkan data yang ada di dalam kurung ini ($nama, $nip, $email, $foto)]
                if (move_uploaded_file($_FILES['txtfoto']['tmp_name'], $location) && $this->Mdosen->dosen_edit_prosesfoto($id_dosen, $nama, $nip, $email, $matakuliah, $foto)) {
                    $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil Disimpan!</strong> Data ' . $nama . ' Sudah Tersimpan.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
                    redirect('dosen');
                } else {
                    $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Gagal Simpan Data!</strong> Data ' . $nama . ' Belum Disimpan.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
                    redirect('dosen');
                }
            }
        }
    }

    function hapus($id_dosen = 0, $foto = 0)
    {
        // melakukan logika terlebih dahulu untuk mengetahui $id_dosen sudah ada nilainya atau tidak
        if ($id_dosen == 0 or $foto == '0') {
            // NOTIFIKASI UNTUK DITAMPILKAN DI HALAMAN dosen
            $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Ada yang Salah!</strong> gagal hapus data, URL tidak terdapat ID.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            // REDIRECT BERPINDAH HALAMAN KE dosen
            redirect('dosen');
        }
        // kita panggil dulu nama model yang kita buat
        $this->load->model('Mdosen');

        if ($foto != 'foto') {
            // menghilangkan foto pada directory
            unlink(realpath('upload/dosen/' . $foto));
        }
        // LOGIKA IF [JIKA SISTEM SUDAH MEMINDAHKAN FOTO KEDALAM VARIABEL LOCATION DAN mengirimkan data yang ada di dalam kurung ini ($nama, $nip, $email, $foto)]
        if ($this->Mdosen->dosen_hapus($id_dosen)) {
            $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil Disimpan!</strong> Data Sudah Tersimpan.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
            redirect('dosen');
        } else {
            $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Gagal Hapus Data!</strong> Data Belum Dihapus ID tidak ditemukan.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
            redirect('dosen');
        }
    }

}

