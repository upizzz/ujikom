<h1 class="mt-4">Ulasan Buku</h1>
<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col-md-12">
        <form method="post">
          <?php
          $id = $_GET['id'];
          if (isset($_POST['submit'])) {
            $id_buku = $_POST['id_buku'];
            $id_user = $_SESSION['user']['id_user'];
            $ulasan = $_POST['ulasan'];
            $rating = $_POST['rating'];

            // Validasi input
            if (empty($id_buku) || empty($ulasan) || empty($rating)) {
              echo '<div class="alert alert-danger">Semua kolom harus diisi.</div>';
            } else {
              // Menggunakan prepared statement untuk mencegah SQL Injection
              $stmt = $koneksi->prepare("INSERT INTO ulasan (id_buku, id_user, ulasan, rating) VALUES (?, ?, ?, ?)");
              $stmt->bind_param("iisi", $id_buku, $id_user, $ulasan, $rating);

              if ($stmt->execute()) {
                echo '<script>alert("Ubah Data Berhasil."); window.location.href="?page=ulasan";</script>';
              } else {
                echo '<div class="alert alert-danger">Ubah Data Gagal.</div>';
              }
              $stmt->close();
            }
          }
          $query = mysqli_query($koneksi, "SELECT*FROM ulasan WHERE id_ulasan=$id");
          $data = mysqli_fetch_array($query);
          ?>
          <div class="row mb-3">
            <div class="col-md-2">Buku</div>
            <div class="col-md-10">
              <select name="id_buku" class="form-control" required>
                <option value="">Pilih Buku</option>
                <?php
                $buk = mysqli_query($koneksi, "SELECT * FROM buku");
                while ($buku = mysqli_fetch_array($buk)) {
                ?>
                  <option <?php if($data['id_buku'] == $buku['id_buku']) echo 'selected'; ?> value="<?php echo $buku['id_buku']; ?>"><?php echo $buku['judul']; ?></option>
                <?php
                }
                ?>
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-2">Ulasan</div>
            <div class="col-md-10">
              <textarea name="ulasan" rows="5" class="form-control" required><?php echo $data['ulasan']; ?></textarea>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-2">Rating</div>
            <div class="col-md-10">
              <select name="rating" class="form-control" required>
                <option value="">Pilih Rating</option>
                <?php for ($i = 1; $i <= 10; $i++) { ?>
                  <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-10">
              <button type="submit" class="btn btn-primary" name="submit" value="submit">Simpan</button>
              <button type="reset" class="btn btn-secondary">Reset</button>
              <a href="?page=ulasan" class="btn btn-danger">Kembali</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
