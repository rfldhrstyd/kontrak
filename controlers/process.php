<?php 
include('koneksioop.php');
$koneksi = new database();

$action = $_GET['action'];
if($action == "add")
{
	$koneksi->tambah_data($_POST['judul_kontrak'],$_POST['nilai_kontrak'],$_POST['aging_days'],$_POST['no_kontrak'],$_POST['no_wbs']);
	header('location:../views/kontrakaging.php?pesan=berhasil');
}elseif($action=="delete")
{
	$id_kontrak = $_GET['id'];
	$koneksi->delete_data($id_kontrak);
	header('location:../views/kontrakaging.php?pesan=hapus');
}
?>