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
$jumlah_pic = $db->jumlah_pic($id_kontrak_file);
$jumlah_status = $db->jumlah_status($id_kontrak_file);
$tampil_file_upload = $db->tampil_file($id_kontrak_file);
$tampil_file_pic = $db->tampil_pic($id_kontrak_file);
$tampil_data_status = $db->tampil_status($id_kontrak_file);
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
    } else if ($_GET['pesan'] == "gagalupload") {
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
                    <li class="navbar-link"><a href="halamanuser.php"><i class='bx bx-user-pin'></i> Users</a></li>
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
                                <td style="width: 280px;"><?php echo $data_kontrak['judul_kontrak'] ?></td>
                                <td><?php echo $data_kontrak['nilai_kontrak'] ?></td>
                                <td><?php echo $data_kontrak['aging_days'] ?></td>
                                <td><?php echo $data_kontrak['no_kontrak'] ?></td>
                                <td><?php echo $data_kontrak['no_wbs'] ?></td>
                                <td><?php echo $jumlah_file ?> File</td>
                                <td><?php echo $jumlah_pic ?> PIC</td>
                                <td><?php echo $jumlah_status ?> Status</td>
                            </tr>
                        </tbody>
                    </table>

                    <p class="jangka-waktu"><code>Jangka Waktu Perjanjian : </code><span>Jangka waktu pelaksanaan pekerjaan adalah selama <?php $tgl1 = new DateTime($data_kontrak['tgl_dari']);
                                                                                                                    $tgl2 = new DateTime($data_kontrak['tgl_sampai']);
                                                                                                                    $jarak = $tgl2->diff($tgl1);
                                                                                                                    echo $jarak->m; ?> bulan terhitung mulai tanggal <?php echo date('d F Y', strtotime($data_kontrak['tgl_dari']));  ?> sampai dengan <?php echo date('d F Y', strtotime($data_kontrak['tgl_sampai']));  ?></span></p>
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
                                <th style="width: 20px;">NO</th>
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
                                        <td style="text-align: center;">
                                            <a class="btn-download" href="../controlers/upload/prosesdownload.php?file=<?php echo $row_file['nama_file']; ?>"><i class='bx bx-download'></i></a>
                                            <a class="btn-hapus" href="../controlers/process.php?action=deletefile&id=<?php echo $row_file['id_file']; ?>&id_kontrak=<?php echo $row_file['id_kontrak']; ?>"><i class='bx bx-trash'></i></a>
                                        </td>
                                    </tr>
                            <?php }
                            } ?>
                        </tbody>
                    </table>
                </div>

                <div class="table-pic">
                    <div class="table-pic-tittle">
                        <h3>Data PIC</h3>
                        <div class="btn-upload" onclick="btnOpen()">Tambah PIC</div>
                    </div>
                    <table id="example2" class="cell-border" style="width:100%; margin: 20px 0;">
                        <thead>
                            <tr>
                                <th style="width: 20px;">NO</th>
                                <th>Sub Divisi</th>
                                <th>Nama PIC</th>
                                <th style="text-align: center;"> Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $nom = 1;
                            if (is_array($tampil_file_pic) || is_object($tampil_file_pic)) {
                                foreach ($tampil_file_pic as $row_file) {
                            ?>
                                    <tr>
                                        <td style="text-align: center;"><?php echo $nom++; ?></td>
                                        <td style="width:350px; font-size: 18px !important;"><?php echo $row_file['jenis_pic']; ?></td>
                                        <td style="width:350px; font-size: 18px !important;"><?php echo $row_file['nama_pic']; ?></td>
                                        <td style="text-align: center;"><a class="btn-download" href="editpic.php?id=<?php echo $row_file['id_pic']; ?>"><i class='bx bx-edit'></i></a>
                                            <a class="btn-hapus" href="../controlers/process.php?action=deletepic&id=<?php echo $row_file['id_pic']; ?>&id_kontrak=<?php echo $row_file['id_kontrak']; ?>"><i class='bx bx-trash'></i></a>
                                        </td>
                                    </tr>
                            <?php }
                            } ?>
                        </tbody>
                    </table>
                </div>
                <div class="tambah-pic">
                    <div class="pic-content">
                        <div class="btn-cls">
                            <i class='bx bxs-x-circle text-info' onclick="btnClose()"></i>
                        </div>
                        <h1>Data PIC</h1>
                        <form action="../controlers/process.php?action=addpic" method="post">
                            <div class="addpic-content">
                                <label for="">Pilih Jenis PIC :</label>
                                <select class="form-pic" name="jenis_pic" id="jenis_pic">
                                    <option value="Pertamina">Pertamina</option>
                                    <option value="Marketing Elnusa">Marketing Elnusa</option>
                                    <option value="Operasional Elnusa">Operasional Elnusa</option>
                                    <option value="AR Elnusa">AR Elnusa</option>
                                </select>
                            </div>
                            <div class="addpic-content">
                                <label for="">Nama PIC :</label>
                                <input type="text" name="nama_pic" placeholder="Name PIC1, Name PIC2 ....">
                            </div>
                            <input type="hidden" name="id_kontrak" value="<?php echo $data_kontrak['id_kontrak']; ?>" />
                            <button class='btn-upload' type="submit">Tambah PIC</button>
                            <button class='btn-reset-pic' type="submit">Reset PIC</button>
                        </form>
                    </div>
                </div>

                <!-- lates status -->
                <div class="table-pic">
                    <div class="table-pic-tittle">
                        <h3>Data Latest Update</h3>
                        <a class="btn-upload" href='tambahstatus.php?id=<?php echo $id_kontrak_file ?>'>Tambah Status</a>
                    </div>
                    <table id="example3" class="cell-border" style="width:100%; margin: 20px 0;">
                        <thead>
                            <tr>
                                <th style="width: 20px;">NO</th>
                                <th>Latest Update</th>
                                <th>Status</th>
                                <th style="text-align: center;"> Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $nomor = 1;
                            if (is_array($tampil_data_status) || is_object($tampil_data_status)) {
                                foreach ($tampil_data_status as $row_file) {
                            ?>
                                    <tr>
                                        <td style="text-align:center;"><?php echo $nomor++; ?></td>
                                        <td>
                                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne<?php echo $row_file['id_status'] ?>" aria-expanded="false" aria-controls="flush-collapseOne">
                                                            <code><?php echo $row_file['tgl_upload'] ?> : </code> <?php echo $row_file['isi_status'] ?></button>
                                                    </h2>
                                                    <div id="flush-collapseOne<?php echo $row_file['id_status'] ?>" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                                        <div class="accordion-body">
                                                            <h5>Latest Update</h5>
                                                            <div class="update-content">
                                                                <?php
                                                                include '../controlers/koneksi.php';
                                                                $id_status = $row_file['id_status'];

                                                                $data = mysqli_query($koneksi, "select * from log_status where id_status='$id_status' order by id_log DESC ");
                                                                while ($d = mysqli_fetch_array($data)) {
                                                                ?>
                                                                    <p><code><?php echo $d['tgl_log'] ?> :</code> <strong><?php echo $d['isi_status'] ?>. </strong> <code><?php echo $d['type_status'] ?></code></p>
                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <?php
                                            if ($row_file['type_status'] === 'done') {
                                                echo "
                                        <div class='status-done'>
                                            <p><i class='bx bx-badge-check'></i> Done</p>
                                        </div>";
                                            } else {
                                                echo "<div class='status-progres'>
                                                        <p><i class='bx bx-loader-circle'></i>On Progres</p>
                                                         </div>";
                                            }
                                            ?>

                                        </td>
                                        <td style="text-align: center;"><a class="btn-download" href="editstatus.php?id=<?php echo $row_file['id_status']; ?>&id_kontrak=<?php echo $row_file['id_kontrak']; ?>"><i class='bx bx-edit'></i></a>
                                            <a class="btn-hapus" href="../controlers/process.php?action=deletestatus&id=<?php echo $row_file['id_status']; ?>&id_kontrak=<?php echo $row_file['id_kontrak']; ?>"><i class='bx bx-trash'></i></a>
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
</div>


<?php
include 'components/footer.php'
?>