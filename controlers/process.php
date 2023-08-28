<?php
include('koneksioop.php');
$koneksi = new database();

$action = $_GET['action'];
if ($action == "add") {
	$koneksi->tambah_data($_POST['judul_kontrak'], $_POST['nilai_kontrak'], $_POST['aging_days'], $_POST['no_kontrak'], $_POST['no_wbs']);
	header('location:../views/kontrakaging.php?pesan=berhasil');
} else if ($action == "edit") {
	$koneksi->update_data($_POST['id_kontrak'], $_POST['judul_kontrak'], $_POST['nilai_kontrak'], $_POST['aging_days'], $_POST['no_kontrak'], $_POST['no_wbs']);
	header('location:../views/kontrakaging.php?pesan=edit');
} else if ($action == "delete") {
	$id_kontrak = $_GET['id'];
	$koneksi->delete_data($id_kontrak);
	header('location:../views/kontrakaging.php?pesan=hapus');
} else if ($action == "deletefile") {
	$id_file = $_GET['id'];
	$id_kontrak = $_GET['id_kontrak'];
	$koneksi->delete_data_file($id_file);
	header("location:../views/detailkontrak.php?id=$id_kontrak&pesan=hapus");
}
