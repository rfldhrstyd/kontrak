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
                <div class="title-table" style="width: 50%;">
                    <div class="title-tables">
                        <h1>Tambah Kontrak Aging</h1>
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
                    </div>
                    <a href="kontrakaging.php"><i class='bx bx-log-out-circle'></i> Kembali</a>
                </div>
            </div>

            <div class="dashboard-input">
                <form action="../controlers/process.php?action=add" method="post" class="tambah-kontrak">
                    <div class="input-content">
                        <label for="">Judul Kontrak</label>
                        <textarea name="judul_kontrak" id="" cols="30" rows="2"></textarea>
                    </div>
                    <div class="input-content">
                        <label for="">Nilai Kontrak</label>
                        <input type="text" placeholder="Rp or $" name="nilai_kontrak">
                    </div>
                    <div class="input-content">
                        <label for="">Aging Days</label>
                        <input type="text" placeholder="200 Hari" name="aging_days">
                    </div>

                    <div class="input-content new-input">
                        <div class="input-content-days">
                            <label for="">Dari Tanggal </label>
                            <input type="date" placeholder="20 Agustus 2023" name="tgl_dari">
                        </div>
                        <div class="input-content-days">
                            <label for="">Sampai Tanggal</label>
                            <input type="date" placeholder="20 Desember 2023" name="tgl_sampai">
                        </div>
                    </div>

                    <div class="input-content">
                        <label for="">No Kontrak</label>
                        <input type="text" placeholder="000000000" name="no_kontrak">
                    </div>
                    <div class="input-content">
                        <label for="">No WBS</label>
                        <input type="text" placeholder="0-19-000220202" name="no_wbs">
                    </div>
                    <button type="submit" class="btn-tambah">Tambah Kontrak</button>
                    <button type="reset" class="btn-reset">Reset</button>
                </form>
            </div>
        </div>
    </div>
</div>


<?php
include 'components/footer.php'
?>