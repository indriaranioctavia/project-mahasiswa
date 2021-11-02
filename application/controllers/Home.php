<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function index()
    {
        // kita panggil dulu nama model yang kita buat
        $this->load->model('Mhome');

        //memanggil database melalui model dengan tidak membawa nilai apapun ke modelnya
        $data['dtdosen'] = $this->Mhome->dosen_limit();
        $data['dtmahasiswa'] = $this->Mhome->mahasiswa_limit();
        // membuat variabel active untuk membedakan menu
        $data['title'] = "Home";
        $data['mhometampil'] = true;
        //setelah itu model akan mengirimkan data sesuai permintaan yang akan diteruskan melalui view perhatikan parameter array yang ada di $data['dtguru] $data['dtmahasiswa]

        //untuk penamaan view_home bebas asalkan sama pada file yang ada di folder views
        $this->load->view('backend/part/header', $data);
        $this->load->view('view_home');
        $this->load->view('backend/part/footer');
    }
}
