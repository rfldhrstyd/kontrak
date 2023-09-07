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
$tampil_user = $db->tampil_user();
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
                <div class="title-table">
                    <div class="title-tables">
                        <h1>Data Users</h1>
                        <p>Mari berkordinasi menyelesaikan kontrak yang sudah aging.</p>
                    </div>
                    <a href="tambahuser.php"><i class='bx bx-plus'></i> Tambah Users</a>
                </div>
                <div class="user-saat-ini">
                    <h3>User yang digunakan saat ini adalah <strong><?php echo $_SESSION['username']; ?></strong> dengan level <strong><?php echo $_SESSION['level']; ?></strong></h3>
                    <form action="../controlers/process.php?action=edituser" method="post" class="ubah-ps">
                        <input type="hidden" value="<?php echo $_SESSION['username']; ?>" >
                        <input type="hidden" value="<?php echo $_SESSION['level']; ?>" >
                        <input type="password" required>
                        <button type="submit" class="btn-upload">Ubah Password</button>
                    </form>
                </div>
                <table id="example" class="cell-border" style="width:100%; margin: 20px 0;">
                    <thead>
                        <tr>
                            <th style="width: 20px;">NO</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>level</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        if (is_array($tampil_user) || is_object($tampil_user)) {
                            foreach ($tampil_user as $row) {
                        ?>
                                <tr>
                                    <td style="text-align: center;"><?php echo $no++; ?></td>
                                    <td><?php echo $row['username']; ?></td>
                                    <td><?php echo $row['password']; ?></td>
                                    <td><?php echo $row['level']; ?></td>
                                    <td style="text-align: center;"><a href="edituser.php?id=<?php echo $row['id_user']; ?>" class="edit"><i class='bx bx-edit'></i></a>
                                        <a href="../controlers/process.php?action=deleteuser&id=<?php echo $row['id_user']; ?>" class="hapus"><i class='bx bx-trash'></i></a>
                                    </td>
                                </tr>
                        <?php }
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<?php
include 'components/footer.php'
?>