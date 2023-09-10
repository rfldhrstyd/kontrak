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
$jumlah_data_user = $db->jumlah_data_user();
$tampil_kontrak = $db->tampil_data();
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
                        <li class="navbar-link active"></i><a href="halaman_super.php"><i class='bx bx-home-alt'></i> Dashboard</a></li>
                        <li class="navbar-link"><a href="kontrakaging.php"><i class='bx bx-folder'></i> Kontrak Aging</a></li>
                    </ul>
                <?php } else { ?>
                    <ul class="navbar-list">
                        <li class="navbar-link active"></i><a href="halaman_super.php"><i class='bx bx-home-alt'></i> Dashboard</a></li>
                        <li class="navbar-link"><a href="kontrakaging.php"><i class='bx bx-folder'></i> Kontrak Aging</a></li>
                        <li class="navbar-link"><a href="halamanuser.php"><i class='bx bx-user-pin'></i> Users</a></li>
                    </ul>
                <?php } ?>
            </div>
            <?php include 'components/menu.php' ?>
        </div>
        <div class="dashboard-midle">
            <div class="dashboard-title-top">
                <div class="dashboard-title">
                    <h1>Hello, <?php echo $_SESSION['username']; ?></h1>
                    <p>Mari berkordinasi menyelesaikan kontrak yang sudah aging.</p>
                </div>
                <div class="dashboard-date">
                    <p id="tanggal"></p> <i class='bx bx-calendar'></i>
                </div>
            </div>
            <div class="dashboard-jumlah">
                <?php if ($_SESSION['level'] != "super") { ?>
                    <div class="jumlah-aging" onclick="redirectKontrak()">
                        <i class='bx bx-folder'></i>
                        <div class="aging-title">
                            <p>Kontrak Aging</p>
                            <h3><?php echo $jumlah_barang ?> <span>Data</span></h3>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="jumlah-aging" onclick="redirectKontrak()">
                        <i class='bx bx-folder'></i>
                        <div class="aging-title">
                            <p>Kontrak Aging</p>
                            <h3><?php echo $jumlah_barang ?> <span>Data</span></h3>
                        </div>
                    </div>
                    <div class="jumlah-user" onclick="redirectUser()">
                        <i class='bx bx-user-pin'></i>
                        <div class="aging-title">
                            <p>Data Users</p>
                            <h3><?php echo $jumlah_data_user ?> <span>Data</span></h3>
                        </div>
                    </div>
                <?php } ?>

            </div>
            <div class="" style="width: 650px; height: 600px;">
                    <canvas id="grafik">

                    </canvas>
            </div>
            <!-- <footer>
                <div class="logo-pertamina">
                    <img src="../assets/images/logotext.png" alt="">
                </div>
            </footer> -->
        </div>
    </div>
</div>


<?php
include 'components/footer.php'
?>
<?php
include '../assets/script/bar.php'
?>


