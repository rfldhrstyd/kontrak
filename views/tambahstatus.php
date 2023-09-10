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
                        <h1>Tambah Status</h1>
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
                    </div>
                    <a href="detailkontrak.php?id=<?php echo $id_kontrak_file ?>"><i class='bx bx-log-out-circle'></i> Kembali</a>
                </div>
            </div>

            <div class="dashboard-input">
                <form action="../controlers/process.php?action=addstatus" method="post" class="tambah-kontrak">
                    <div class="input-content">
                        <label for="">Isi Status</label>
                        <textarea name="isi_status" id="" cols="30" rows="2"></textarea>
                    </div>
                    <div class="input-content">
                        <label for="">Status</label>
                        <select class="form-pic" name="type_status" id="type_status" style="margin-bottom: 30px;"> 
                            <option value="done">Done</option>
                            <option value="progres">On Progres</option>
                        </select>
                    </div>
                    
                    <input type="hidden" name="id_kontrak" value="<?php echo $id_kontrak_file ?>" />
                    <button type="submit" class="btn-tambah">Tambah Status</button>
                    <button type="reset" class="btn-reset">Reset</button>
                </form>
            </div>
        </div>
    </div>
</div>


<?php
include 'components/footer.php'
?>