
    <div class="container">
        <h1>Edit Data mahasiswa</h1>

        <?php
        // memanggil nilai yang telah dikirim di file ini
        foreach ($dtmahasiswaid as $dm);
        ?>
        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
        <form enctype="multipart/form-data" action="<?= base_url('mahasiswa/edit_proses'); ?>" method="POST">
            <div class="form-group">
                <label for="txtnama">Nama</label>
                <!-- penting di masukkan script dibawah ini digunakan untuk penanda bahwa yang akan dirubah ini adalah id_mahasiswa sesuai yang dirubah -->
                <!-- type="hidden" difungsikan agar input text tersebut tidak kelihatan -->
                <input value="<?php echo $dm->id_mahasiswa; ?>" type="hidden" class="form-control" id="txtid_mahasiswa" name="txtid_mahasiswa" required>
                <input value="<?php echo $dm->nama; ?>" type="text" class="form-control" id="txtnama" name="txtnama" placeholder="Nama" required>
            </div>
            <div class="form-group">
                <label for="txtnim">NIM</label>
                <textarea class="form-control" id="txtnim" name="txtnim" required><?php echo $dm->nim; ?></textarea>
            </div>
            <div class="form-group">
                <label for="txtemail" class="col-form-label">Email</label>
                <input value="<?php echo $dm->email; ?>" type="text" class="form-control" id="txtemail" name="txtemail" required>
            </div>
            <div class="form-group">
                <label for="txtjurusan" class="col-form-label">Jurusan</label>
                <input value="<?php echo $dm->jurusan; ?>" type="text" class="form-control" id="txtjurusan" name="txtjurusan" required>
            </div>
            <div width="30%">
                <?php
                if ($dm->foto == "kosong") {
                    echo 'Tidak Ada Gambar';
                } else {
                    // kita menambahkan fungsi base_url agar gambar bisa dipanggil
                    $lokasi = base_url('upload/mahasiswa/' . $dm->foto);
                    // MENCARI LOKASI DIMANA FOTO mahasiswa DI SIMPAN DAN NAMA FOTO mahasiswa SUDAH TERCANTUM DI DATABASE
                    echo '<img width="10%" src="' . $lokasi . '" alt="Avatar">';
                }
                ?>
            </div>
            <div class="form-group">
                <label for="txtfoto" class="col-form-label">Foto:</label><code class="highlighter-rouge"> *Size kurang dari 2mb</code>
                <input value="<?php echo $dm->foto; ?>" type="hidden" class="form-control" id="txtnamafoto" name="txtnamafoto" required>
                <input type="file" class="form-control" id="txtfoto" name="txtfoto">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
