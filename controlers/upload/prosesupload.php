<?php
// Baca lokasi file sementar dan nama file dari form (fupload)
$lokasi_file = $_FILES['fupload']['tmp_name'];
$nama_file   = $_FILES['fupload']['name'];
// Tentukan folder untuk menyimpan file
$folder = "files/$nama_file";
// tanggal sekarang
$tgl_upload = date("Ymd");
// Apabila file berhasil di upload
if (move_uploaded_file($lokasi_file, "$folder")) {
    //   echo "Nama File : <b>$nama_file</b> sukses di upload";

    // Masukkan informasi file ke database
    $konek = mysqli_connect("localhost", "root", "", "kontrakaging");

    $query = "INSERT INTO file (nama_file, tgl_upload, id_kontrak)
            VALUES('$nama_file', '$tgl_upload', '$_POST[id_kontrak]')";

    mysqli_query($konek, $query);

    header("location:../../views/detailkontrak.php?id=$_POST[id_kontrak]&pesan=berhasilupload");
} else {
    header("location:../../views/detailkontrak.php?id=$_POST[id_kontrak]&pesan=gagalupload");
}
