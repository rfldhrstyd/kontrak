<?php
include 'components/Header.php'
?>

<?php
session_start();

// cek apakah yang mengakses halaman ini sudah login
if ($_SESSION['level'] == "") {
    header("location:index.php?pesan=gagal");
}

include('../controlers/koneksioop.php');
$db = new database();
$jumlah_barang = $db->jumlah_data();
$tampil_kontrak = $db->tampil_data();
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
                <?php if ($_SESSION['level'] != "super") { ?>
                    <ul class="navbar-list">
                        <li class="navbar-link "></i><a href="halaman_super.php"><i class='bx bx-home-alt'></i> Dashboard</a></li>
                        <li class="navbar-link activekontrak"><a href="kontrakaging.php"><i class='bx bx-folder'></i> Kontrak Aging</a></li>
                    </ul>
                <?php } else { ?>
                    <ul class="navbar-list">
                        <li class="navbar-link "></i><a href="halaman_super.php"><i class='bx bx-home-alt'></i> Dashboard</a></li>
                        <li class="navbar-link activekontrak"><a href="kontrakaging.php"><i class='bx bx-folder'></i> Kontrak Aging</a></li>
                        <li class="navbar-link"><a href="halamanuser.php"><i class='bx bx-user-pin'></i> Users</a></li>
                    </ul>
                <?php } ?>
            </div>
            <?php include 'components/menu.php' ?>
        </div>
        <div class="dashboard-midle">

            <div class="dashboard-table">
                <div class="title-table">
                    <div class="title-tables">
                        <h1>Kontrak Aging</h1>
                        <p>Mari berkordinasi menyelesaikan kontrak yang sudah aging.</p>
                    </div>
                    <?php if ($_SESSION['level'] != "super" && $_SESSION['level'] != "admin") { ?>
                        <a href="tambahkontrak.php" style="display: none !important;"><i class='bx bx-plus'></i> Tambah Kontrakk</a>
                    <?php } else { ?>
                        <a href="tambahkontrak.php"><i class='bx bx-plus'></i> Tambah Kontrak</a>
                    <?php } ?>
                </div>
                <table id="example" class="cell-border" style="width:100%; margin: 20px 0;">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Judul Kontrak</th>
                            <th>Nilai Kontrak</th>
                            <th>Aging Days</th>
                            <th>No Kontrak</th>
                            <th>No Wbs</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        if (is_array($tampil_kontrak) || is_object($tampil_kontrak)) {
                            foreach ($tampil_kontrak as $row) {
                        ?>
                                <tr>
                                    <td style="text-align: center;"><?php echo $no++; ?></td>
                                    <td style="width:350px"><?php echo $row['judul_kontrak']; ?></td>
                                    <td><?php echo $row['nilai_kontrak']; ?></td>
                                    <td><?php echo $row['aging_days']; ?></td>
                                    <td><?php echo $row['no_kontrak']; ?></td>
                                    <td><?php echo $row['no_wbs']; ?></td>
                                    <td style="text-align: center;">
                                        <?php if ($_SESSION['level'] != "super" && $_SESSION['level'] != "admin") { ?>
                                            <a href="detailkontrak.php?id=<?php echo $row['id_kontrak']; ?>" class="details"><i class='bx bx-file'></i></a>
                                        <?php } else { ?>
                                            <a href="detailkontrak.php?id=<?php echo $row['id_kontrak']; ?>" class="details"><i class='bx bx-file'></i></a>
                                            <a href="editkontrak.php?id=<?php echo $row['id_kontrak']; ?>" class="edit"><i class='bx bx-edit'></i></a>
                                            <a href="../controlers/process.php?action=delete&id=<?php echo $row['id_kontrak']; ?>" class="hapus"><i class='bx bx-trash'></i></a>
                                        <?php } ?>
                                    </td>
                                </tr>
                        <?php }
                        } ?>
                    </tbody>
                </table>
                <div class="padding-new" style="height: 40px;">

                </div>
            </div>

            
        </div>
    </div>
</div>


<?php
include 'components/footer.php'
?>