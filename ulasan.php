<h1 class="mt-4">Ulasan Buku</h1>
<div class="card">
  <div class="card-body">
    <div class="row mb-3">
      <div class="col-md-12">
        <a href="?page=ulasan_tambah" class="btn btn-primary">+ Tambah Data</a>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>NO</th>
              <th>User</th>
              <th>Buku</th>
              <th>Ulasan</th>
              <th>Rating</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 1;
            // Perbaiki query SQL dengan JOIN yang benar
            $query = mysqli_query($koneksi, "
              SELECT 
                ulasan.*, 
                user.nama AS user_nama, 
                buku.judul AS buku_judul 
              FROM ulasan 
              LEFT JOIN user ON user.id_user = ulasan.id_user 
              LEFT JOIN buku ON buku.id_buku = ulasan.id_buku
            ");
            while($data = mysqli_fetch_array($query)){
            ?>
            <tr>
              <td><?php echo $i++; ?></td>
              <td><?php echo htmlspecialchars($data['user_nama']); ?></td>
              <td><?php echo htmlspecialchars($data['buku_judul']); ?></td>
              <td><?php echo htmlspecialchars($data['ulasan']); ?></td>
              <td><?php echo htmlspecialchars($data['rating']); ?></td>
              <td>
                <a href="?page=ulasan_ubah&id=<?php echo $data['id_ulasan']; ?>" class="btn btn-info btn-sm">Ubah</a>
                <a onclick="return confirm('Apakah Anda yakin menghapus data ini?');" href="?page=ulasan_hapus&id=<?php echo $data['id_ulasan']; ?>" class="btn btn-danger btn-sm">Hapus</a>
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
