
    <div class="container">
        <h1>5 Dosen Terbaru</h1>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">NIP</th>
                    <th scope="col">Email</th>
                    <th scope="col">Mata Kuliah</th>
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

        <h1>5 Mahasiswa Terbaru</h1>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">NIM</th>
                    <th scope="col">Email</th>
                    <th scope="col">Jurusan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 0;
                if ($dtmahasiswa != 0) {
                    foreach ($dtmahasiswa as $dm) {
                        $no++;
                ?>
                        <tr>
                            <th scope="row"><?= $no; ?></th>
                            <td><?= $dm->nama; ?></td>
                            <td><?= $dm->nim; ?></td>
                            <td><?= $dm->email; ?></td>
                            <td><?= $dm->jurusan; ?></td>
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