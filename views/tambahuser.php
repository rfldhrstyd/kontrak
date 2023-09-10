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
                    <li class="navbar-link "><a href="kontrakaging.php"><i class='bx bx-folder'></i> Kontrak Aging</a></li>
                    <li class="navbar-link activeuser"><a href="halamanuser.php"><i class='bx bx-user-pin'></i> Users</a></li>
                </ul>
            </div>
            <?php include 'components/menu.php' ?>
        </div>
        <div class="dashboard-midle">
            <div class="dashboard-table">
                <div class="title-table" style="width: 50%;">
                    <div class="title-tables">
                        <h1>Tambah Users</h1>
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
                    </div>
                    <a href="halamanuser.php"><i class='bx bx-log-out-circle'></i> Kembali</a>
                </div>
            </div>

            <div class="dashboard-input">
                <form action="../controlers/process.php?action=adduser" method="post" class="tambah-kontrak">
                    <div class="input-content">
                        <label for="">username</label>
                        <input type="text" name="username" placeholder="Your Name">
                    </div>
                    <div class="input-content">
                        <label for="">Buat Password</label>
                        <input type="password"  name="password">
                    </div>
                    <div class="input-content" style="margin-bottom: 40px;">
                        <label for="">level</label>
                        <select class="form-pic" name="level" id="level">
                            <option value="super">Super Admin</option>
                            <option value="admin">Admin</option>
                            <option value="views">Viewers</option>
                        </select>
                    </div>
                    <button type="submit" class="btn-tambah">Tambah Users</button>
                    <button type="reset" class="btn-reset">Reset</button>
                </form>
            </div>
        </div>
    </div>
</div>


<?php
include 'components/footer.php'
?>