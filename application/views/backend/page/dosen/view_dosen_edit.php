
    <div class="container">
        <h1>Edit Data dosen</h1>

        <?php
        // memanggil nilai yang telah dikirim di file ini
        foreach ($dtdosenid as $dd);
        ?>
        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
        <form enctype="multipart/form-data" action="<?= base_url('dosen/edit_proses'); ?>" method="POST">
            <div class="form-group">
                <label for="txtnama">Nama</label>
                <!-- penting di masukkan script dibawah ini digunakan untuk penanda bahwa yang akan dirubah ini adalah id_dosen sesuai yang dirubah -->
                <!-- type="hidden" difungsikan agar input text tersebut tidak kelihatan -->
                <input value="<?php echo $dd->id_dosen; ?>" type="hidden" class="form-control" id="txtid_dosen" name="txtid_dosen" required>
                <input value="<?php echo $dd->nama; ?>" type="text" class="form-control" id="txtnama" name="txtnama" placeholder="Nama" required>
            </div>
            <div class="form-group">
                <label for="txtnip">NIP</label>
                <textarea class="form-control" id="txtnip" name="txtnip" required><?php echo $dd->nip; ?></textarea>
            </div>
            <div class="form-group">
                <label for="txtemail" class="col-form-label">Email</label>
                <input value="<?php echo $dd->email; ?>" type="text" class="form-control" id="txtemail" name="txtemail" required>
            </div>
            <div class="form-group">
                <label for="txtmatakuliah" class="col-form-label">Mata Kuliah</label>
                <input value="<?php echo $dd->matakuliah; ?>" type="text" class="form-control" id="txtmatakuliah" name="txtmatakuliah" required>
            </div>
            <div width="30%">
                <?php
                if ($dd->foto == "kosong") {
                    echo 'Tidak Ada Gambar';
                } else {
                    // kita menambahkan fungsi base_url agar gambar bisa dipanggil
                    $lokasi = base_url('upload/dosen/' . $dd->foto);
                    // MENCARI LOKASI DIMANA FOTO dosen DI SIMPAN DAN NAMA FOTO dosen SUDAH TERCANTUM DI DATABASE
                    echo '<img width="10%" src="' . $lokasi . '" alt="Avatar">';
                }
                ?>
            </div>
            <div class="form-group">
                <label for="txtfoto" class="col-form-label">Foto:</label><code class="highlighter-rouge"> *Size kurang dari 2mb</code>
                <input value="<?php echo $dd->foto; ?>" type="hidden" class="form-control" id="txtnamafoto" name="txtnamafoto" required>
                <input type="file" class="form-control" id="txtfoto" name="txtfoto">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
