<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['login'])) {
    header("Location: LoginUser.php");
    exit();
}
include('Koneksi.php');

// Inisialisasi variabel form
$isi = '';
$tgl_awal = '';
$tgl_akhir = '';

// Cek jika ada parameter id untuk mengisi form
if (isset($_GET['id'])) {
    $ambil = mysqli_query($conn, "SELECT * FROM dokter WHERE id='" . $_GET['id'] . "'");
    if ($row = mysqli_fetch_array($ambil)) {
        $isi = $row['nama'];
        $tgl_awal = $row['alamat'];
        $tgl_akhir = $row['no_hp'];
    }
}

// Proses hapus data dokter jika ada permintaan
if (isset($_GET['aksi']) && $_GET['aksi'] === 'hapus' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM dokter WHERE id = $id";
    mysqli_query($conn, $query);
    header("Location: index.php?page=dokter");
    exit();
}

// Proses simpan atau update data (pada form submission)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];

    if ($id) {
        // Update data dokter
        $query = "UPDATE dokter SET nama='$nama', alamat='$alamat', no_hp='$no_hp' WHERE id='$id'";
    } else {
        // Insert data dokter baru
        $query = "INSERT INTO dokter (nama, alamat, no_hp) VALUES ('$nama', '$alamat', '$no_hp')";
    }
    mysqli_query($conn, $query);
    header("Location: index.php?page=dokter");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Dokter</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Data Dokter</h1>
    
    <!-- Form input untuk tambah/ubah data dokter -->
    <form method="POST" action="index.php?page=dokter">
        <input type="hidden" name="id" value="<?php echo $_GET['id'] ?? '' ?>">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Dokter</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $isi ?>" required>
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $tgl_awal ?>" required>
        </div>
        <div class="mb-3">
            <label for="no_hp" class="form-label">No. HP</label>
            <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?php echo $tgl_akhir ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>

    <!-- Tabel data dokter -->
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No. HP</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = mysqli_query($conn, "SELECT * FROM dokter");
            $no = 1;
            while ($data = mysqli_fetch_array($result)) {
                ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $data['nama'] ?></td>
                    <td><?php echo $data['alamat'] ?></td>
                    <td><?php echo $data['no_hp'] ?></td>
                    <td>
                        <a class="btn btn-success rounded-pill px-3" href="index.php?page=dokter&id=<?php echo $data['id'] ?>">Ubah</a>
                        <a class="btn btn-danger rounded-pill px-3" href="index.php?page=dokter&id=<?php echo $data['id'] ?>&aksi=hapus" onclick="return confirm('Yakin ingin menghapus data?')">Hapus</a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
