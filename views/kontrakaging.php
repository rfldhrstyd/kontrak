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
if (isset($_GET['pesan'])) {
    if ($_GET['pesan'] == "berhasil") {
        echo "<script>
        swal('Login Berhasil', 'selamat datang di dashboard aging kontrak!', 'success');
        </script>";
    }
}
?>

<?php
include('../controlers/koneksioop.php');
$db = new database();
$jumlah_barang = $db->jumlah_data();
$tampil_kontrak = $db->tampil_data();
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
                    <h1>Data Kontrak Aging</h1>
                    <!-- <a href="">See Full Data</a> -->
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
                        foreach ($tampil_kontrak as $row) {
                        ?>
                            <tr>
                                <td style="text-align: center;"><?php echo $no++; ?></td>
                                <td><?php echo $row['judul_kontrak']; ?></td>
                                <td><?php echo $row['nilai_kontrak']; ?></td>
                                <td><?php echo $row['aging_days']; ?></td>
                                <td><?php echo $row['no_kontrak']; ?></td>
                                <td><?php echo $row['no_wbs']; ?></td>
                                <td><a href="details.php?id=<?php echo $row['id_kontrak']; ?>" class="details"></i> Details</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<?php
include 'components/footer.php'
?>