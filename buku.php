<h1 class="mt-4">Buku</h1>
<div class="card">
  <div class="card-body">
    <div class="row mb-3">
      <div class="col-md-12">
        <a href="?page=buku_tambah" class="btn btn-primary">+ Tambah Data</a>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <table class="table table-striped table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>NO</th>
              <th>Nama Kategori</th>
              <th>Judul</th>
              <th>Penulis</th>
              <th>Penerbit</th>
              <th>Tahun Terbit</th>
              <th>Deskripsi</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 1;
            $query = mysqli_query($koneksi, "SELECT * FROM buku LEFT JOIN kategori ON buku.id_kategori = kategori.id_kategori");
            while ($data = mysqli_fetch_array($query)) {
            ?>
            <tr>
              <td><?php echo $i++; ?></td>
              <td><?php echo htmlspecialchars($data['kategori']); ?></td>
              <td><?php echo htmlspecialchars($data['judul']); ?></td>
              <td><?php echo htmlspecialchars($data['penulis']); ?></td>
              <td><?php echo htmlspecialchars($data['penerbit']); ?></td>
              <td><?php echo htmlspecialchars($data['tahun_terbit']); ?></td>
              <td><?php echo htmlspecialchars($data['deskripsi']); ?></td>
              <td>
                <a href="?page=buku_ubah&id=<?php echo $data['id_buku']; ?>" class="btn btn-info btn-sm">Ubah</a>
                <a onclick="return confirm('Apakah Anda yakin menghapus data ini?');" href="?page=buku_hapus&id=<?php echo $data['id_buku']; ?>" class="btn btn-danger btn-sm">Hapus</a>
              </td>
            </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
