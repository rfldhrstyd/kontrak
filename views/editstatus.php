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
$id_status = $_GET['id'];
$id_kontrak = $_GET['id_kontrak'];
if (!is_null($id_status)) {
    $data_status = $db->get_by_id_status($id_status);
} else {
    header("location:detailkontrak?id=$id_kontrak");
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
                        <h1>Edit Latest Update</h1>
                    </div>
                    <a href="detailkontrak.php?id=<?php echo $id_kontrak ?>"><i class='bx bx-log-out-circle'></i> Kembali</a>
                </div>
            </div>
            
            <div class="dashboard-input">
                <form action="../controlers/process.php?action=editstatus" method="post" class="tambah-kontrak">
                    <input type="hidden" name="id_status" value="<?php echo $id_status ?>">
                    <div class="input-content">
                        <label for="">Isi Status</label>
                        <textarea name="isi_status" id="" cols="30" rows="2"><?php echo $data_status['isi_status'] ?></textarea>
                    </div>
                    <div class="input-content">
                        <label for="">Status</label>
                        <select class="form-pic" name="type_status" id="type_status" style="margin-bottom: 30px;">
                            <option value="<?php echo $data_status['type_status'] ?>"><?php echo $data_status['type_status'] ?></option>
                            <option value="done">Done</option>
                            <option value="progres">On Progres</option>
                        </select>
                    </div>

                    <input type="hidden" name="id_kontrak" value="<?php echo $id_kontrak ?>">



                    <input type="hidden" name="hidden_id" value="<?php echo $id_status ?>">
                    <input type="hidden" name="hidden_isi" value="<?php echo $data_status['isi_status'] ?>">
                    <input type="hidden" name="hidden_type" value="<?php echo $data_status['type_status'] ?>">
                    

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