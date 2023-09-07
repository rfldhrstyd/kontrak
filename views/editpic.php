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
$id_pic = $_GET['id'];
if (!is_null($id_pic)) {
    $data_pic = $db->get_by_id_pic($id_pic);
} else {
    header('location:kontrakaging.php');
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
                    <li class="navbar-link"><a href="halamanuser.php"><i class='bx bx-user-pin'></i> Users</a></li>
                </ul>
            </div>
            <?php include 'components/menu.php' ?>
        </div>
        <div class="dashboard-midle">
            <div class="dashboard-table">
                <div class="title-table" style="width: 50%;">
                    <div class="title-tables">
                        <h1>Edit Kontrak Aging</h1>
                    </div>
                    <a href="detailkontrak.php?id=<?php echo $id_pic ?>"><i class='bx bx-log-out-circle'></i> Kembali</a>
                </div>
            </div>

            <div class="dashboard-input">
                <form action="../controlers/process.php?action=editpic" method="post" class="tambah-kontrak">
                    <input type="hidden" name="id_pic" value="<?php echo $data_pic['id_pic']; ?>" />
                    <div class="input-content">
                        <label for="">Jenis PIC</label>
                        <select class="form-pic" name="jenis_pic" id="jenis_pic">
                            <option value="<?php echo $data_pic['jenis_pic']?>"><?php echo $data_pic['jenis_pic']?></option>
                            <option value="Pertamina">Pertamina</option>
                            <option value="Marketing">Marketing</option>
                            <option value="Operasional">Operasional</option>
                            <option value="AR Elnusa">AR Elnusa</option>
                        </select>
                    </div>
                    <div class="input-content">
                        <label for="">Nama PIC</label>
                        <input type="text" placeholder="PIC 1, PIC 2" name="nama_pic" value="<?php echo $data_pic['nama_pic'] ?>">
                    </div>
                    <input type="hidden" name="id_kontrak" value="<?php echo $data_pic['id_kontrak']; ?>" />

                    <button type="submit" class="btn-tambah">Simpan Perubahan</button>
                    <button type="reset" class="btn-reset">Reset</button>
                </form>
            </div>
        </div>
    </div>
</div>


<?php
include 'components/footer.php'
?>