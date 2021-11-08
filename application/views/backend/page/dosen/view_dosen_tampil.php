
    <!-- BAGIAN KONTEN -->
    <div class="container">
        <h1>Data Keseluruhan Dosen</h1>
        <button type="button" class="btn btn-success m-1" data-toggle="modal" data-target="#modal_dosen" data-whatever="@mdo">Tambah dosen</button>

        <?php
        // digunakan untuk menampilkan notifikasi setelah dieksekusi
        $data = $this->session->flashdata('notif');
        if (isset($data)) {
            echo $this->session->flashdata('notif');
        } ?>
        <div class="modal fade" id="modal_dosen" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah dosen</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- untuk menambahkan foto atau menyimpan foto kita wajib menggunakan enctype="multipart/form-data" -->
                    <form enctype="multipart/form-data" action="<?= base_url('dosen/tambah'); ?>" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="txtnama" class="col-form-label">Nama:</label>
                                <input type="text" class="form-control" id="txtnama" name="txtnama" required>
                            </div>
                            <div class="form-group">
                                <label for="txtnip" class="col-form-label">NIP:</label>
                                <textarea class="form-control" id="txtnip" name="txtnip" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="txtemail" class="col-form-label">Email</label>
                                <input type="text" class="form-control" id="txtemail" name="txtemail" required>
                            </div>
                            <div class="form-group">
                                <label for="txtmatakuliah" class="col-form-label">Mata Kuliah</label>
                                <input type="text" class="form-control" id="txtmatakuliah" name="txtmatakuliah" required>
                            </div>
                            <div class="form-group">
                                <label for="txtfoto" class="col-form-label">Foto:</label><code class="highlighter-rouge"> *Size kurang dari 2mb</code>
                                <input type="file" class="form-control" id="txtfoto" name="txtfoto" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">NIP</th>
                    <th scope="col">Email</th>
                    <th scope="col">Mata Kuliah</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // membuat fariabel $no untuk membuat nomer otomatis
                $no = 0;

                // membuat logika if pada variabel $dtdosen jika datanya 0 maka akan terbilang data kosong
                if ($dtdosen != 0) {

                    // membuat nilai $dtdosen menjadi array dengan alias $dd
                    foreach ($dtdosen as $dd) {
                        // ini akan menambahkan kondisi dari variabel $no
                        $no++;
                ?>
                        <tr>
                            <th scope="row"><?= $no; ?></th>
                            <td><?= $dd->nama; ?></td>
                            <td><?= $dd->nip; ?></td>
                            <td><?= $dd->email; ?></td>
                            <td><?= $dd->matakuliah; ?></td>
                            <td width="30%">
                                <?php
                                if ($dd->foto == "kosong") {
                                    echo 'Tidak Ada Gmbar';
                                } else {
                                    // MENCARI LOKASI DIMANA FOTO dosen DI SIMPAN DAN NAMA FOTO dosen SUDAH TERCANTUM DI DATABASE
                                    echo '<img width="20%" src="upload/dosen/' . $dd->foto . '" alt="Avatar">';
                                }
                                ?>

                            </td>
                            <td>
                                <a href="<?php echo base_url('dosen/edit/' . $dd->id_dosen); ?>" class="btn btn-primary">Edit</a>
                                <a href="#" onclick="btn_hapus('<?php echo $dd->id_dosen; ?>','<?php echo $dd->nama; ?>','<?php echo $dd->foto; ?>')" class="btn btn-danger">Hapus</a>
                            </td>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <th colspan="4">Data Kosong</th>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script>
        function btn_hapus(id_dosen, nama, foto) {
            // menampilkan pop up swetalert2
            swal({
                    title: "Data " + nama + " akan dihapus?",
                    text: "Jika data di hapus, foto akan terhapus pada directory",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                // ketika data dijawab iya
                .then((willDelete) => {
                    if (willDelete) {
                        window.location = "<?php echo base_url('dosen/hapus/'); ?>" + id_dosen + "/" + foto;
                    }
                });
        }
    </script>
    <!-- BAGIAN KONTEN -->