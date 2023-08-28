<?php
include 'components/Header.php'
?>

<?php
session_start();

// cek apakah yang mengakses halaman ini sudah login
if ($_SESSION['level'] == "") {
    header("location:index.php?pesan=gagal");
}

?>
<?php
include('../controlers/koneksioop.php');
$db = new database();
$id_kontrak_file = $_GET['id'];
$jumlah_file = $db->jumlah_file($id_kontrak_file);
$tampil_file_upload = $db->tampil_file($id_kontrak_file);
$id_kontrak = $_GET['id'];
if (!is_null($id_kontrak)) {
    $data_kontrak = $db->get_by_id($id_kontrak);
} else {
    header('location:kontrakaging.php');
}

if (isset($_GET['pesan'])) {
    if ($_GET['pesan'] == "berhasil") {
        echo "<script>
        swal('Data berhasil ditambah', '', 'success');
        </script>";
    } else if ($_GET['pesan'] == "hapus") {
        echo "<script>
        swal('Data berhasil dihapus', '', 'success');
        </script>";
    } else if ($_GET['pesan'] == "edit") {
        echo "<script>
        swal('Data berhasil diedit', '', 'success');
        </script>";
    } else if ($_GET['pesan'] == "berhasilupload") {
        echo "<script>
        swal('Data berhasil diupload', '', 'success');
        </script>";
    }
    else if ($_GET['pesan'] == "gagalupload") {
        echo "<script>
        swal('Silahkan pilih data yang akan diupload', '', 'error');
        </script>";
    }
}
?>
<div class="dashboard">
    <div class="dahsboard-content">
        <div class="dashboard-menu">
            <div class="dashboard-logo">
                <img src="../assets/images/elnusa.jpg" alt="">
            </div>
            <div class="dashboard-navbar">
                <ul class="navbar-list">
                    <li class="navbar-link"></i><a href="halaman_super.php"><i class='bx bx-home-alt'></i> Dashboard</a></li>
                    <li class="navbar-link activekontrak"><a href="kontrakaging.php"><i class='bx bx-folder'></i> Kontrak Aging</a></li>
                    <li class="navbar-link"><a href=""><i class='bx bx-user-pin'></i> Users</a></li>
                </ul>
            </div>
            <?php include 'components/menu.php' ?>
        </div>
        <div class="dashboard-midle">
            <div class="dashboard-table">
                <div class="title-table">
                    <div class="title-tables">
                        <h1>Detail Kontrak</h1>
                    </div>
                    <a href="kontrakaging.php"><i class='bx bx-log-out-circle'></i> Kembali</a>
                </div>
                <div class="table-judul">
                    <table class="table-judul-content">
                        <thead>
                            <tr>
                                <th>Judul Kontrak</th>
                                <th>Nilai Kontrak</th>
                                <th>Aging Days</th>
                                <th>No Kontrak</th>
                                <th>No Wbs</th>
                                <th>Jumlah File</th>
                                <th>Jumlah PIC</th>
                                <th>Jumlah Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="width: 350px;"><?php echo $data_kontrak['judul_kontrak'] ?></td>
                                <td><?php echo $data_kontrak['nilai_kontrak'] ?></td>
                                <td><?php echo $data_kontrak['aging_days'] ?></td>
                                <td><?php echo $data_kontrak['no_kontrak'] ?></td>
                                <td><?php echo $data_kontrak['no_wbs'] ?></td>
                                <td><?php echo $jumlah_file ?> File</td>
                                <td>20 PIC</td>
                                <td>10 Status</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="table-file">
                    <div class="file-title">
                        <h5>File Kontrak</h5>
                        <form enctype="multipart/form-data" method="POST" action="../controlers/upload/prosesupload.php">
                            <label for="">File yang di upload :</label>
                            <input type="file" name="fupload" class="ufile">
                            <input type="hidden" name="id_kontrak" value="<?php echo $data_kontrak['id_kontrak']; ?>" />
                            <button type="submit" class="btn-upload">Upload</button>
                        </form>
                    </div>
                    <table id="example" class="cell-border" style="width:100%; margin: 20px 0;">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Nama File</th>
                                <th>Tanggal Upload</th>
                                <th style="text-align: center;"> Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            if (is_array($tampil_file_upload) || is_object($tampil_file_upload)) {
                                foreach ($tampil_file_upload as $row_file) {
                            ?>
                                    <tr>
                                        <td style="text-align: center;"><?php echo $no++; ?></td>
                                        <td style="width:350px"><?php echo $row_file['nama_file']; ?></td>
                                        <td style="width:350px"><?php echo $row_file['tgl_upload']; ?></td>
                                        <td style="text-align: center;"><a class="btn-download" href="../controlers/upload/prosesdownload.php?file=<?php echo $row_file['nama_file']; ?>"><i class='bx bx-download'></i></a><a class="btn-hapus" href="../controlers/process.php?action=deletefile&id=<?php echo $row_file['id_file']; ?>&id_kontrak=<?php echo $row_file['id_kontrak']; ?>"><i class='bx bx-trash' ></i></a></td>
                                    </tr>
                            <?php }
                            } ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>


<?php
include 'components/footer.php'
?>