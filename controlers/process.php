<?php
include('koneksioop.php');
$koneksi = new database();



$action = $_GET['action'];
if ($action == "add") {
	$koneksi->tambah_data($_POST['judul_kontrak'], $_POST['nilai_kontrak'], $_POST['aging_days'], $_POST['no_kontrak'], $_POST['no_wbs'], $_POST['tgl_dari'], $_POST['tgl_sampai']);
	header('location:../views/kontrakaging.php?pesan=berhasil');
} else if ($action == "edit") {
	$koneksi->update_data($_POST['id_kontrak'], $_POST['judul_kontrak'], $_POST['nilai_kontrak'], $_POST['aging_days'], $_POST['no_kontrak'], $_POST['no_wbs'], $_POST['tgl_dari'], $_POST['tgl_sampai']);
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
} else if ($action == "addpic") {
	$id_kontrak = $_POST['id_kontrak'];
	$koneksi->tambah_data_pic($_POST['jenis_pic'], $_POST['nama_pic'], $_POST['id_kontrak']);
	header("location:../views/detailkontrak.php?id=$id_kontrak&pesan=berhasil");
} else if ($action == "deletepic") {
	$id_pic = $_GET['id'];
	$id_kontrak = $_GET['id_kontrak'];
	$koneksi->delete_data_pic($id_pic);
	header("location:../views/detailkontrak.php?id=$id_kontrak&pesan=hapus");
} else if ($action == "editpic") {
	$id_kontrak = $_POST['id_kontrak'];
	$koneksi->update_data_pic($_POST['id_pic'], $_POST['jenis_pic'], $_POST['nama_pic'], $_POST['id_kontrak']);
	header("location:../views/detailkontrak.php?id=$id_kontrak&pesan=edit");
}else if($action == "addstatus") {
	$id_kontrak = $_POST['id_kontrak'];
	$tgl_upload = date('Ymd');
	$koneksi->tambah_data_status($_POST['isi_status'], $_POST['type_status'], $tgl_upload, $_POST['id_kontrak']);
	header("location:../views/detailkontrak.php?id=$id_kontrak&pesan=berhasil");
}else if ($action == "editstatus") {
	$id_kontrak = $_POST['id_kontrak'];
	$tgl_upload = date('Ymd');
	$koneksi->update_data_status($_POST['id_status'], $_POST['isi_status'], $_POST['type_status'], $tgl_upload, $_POST['id_kontrak']);
	$koneksi->add_data_log($_POST['hidden_id'], $_POST['hidden_isi'], $_POST['hidden_type'], $tgl_upload);
	header("location:../views/detailkontrak.php?id=$id_kontrak&pesan=edit");
}else if ($action == "deletestatus") {
	$id_status = $_GET['id'];
	$id_kontrak = $_GET['id_kontrak'];
	$koneksi->delete_data_status($id_status);
	header("location:../views/detailkontrak.php?id=$id_kontrak&pesan=hapus");
}else if ($action == "adduser") {
	$koneksi->tambah_data_user($_POST['username'], md5($_POST['password']), $_POST['level']);
	
}else if ($action == "deleteuser") {
	$id_user = $_GET['id'];
	$koneksi->delete_data_user($id_user);
	header("location:../views/halamanuser.php?pesan=hapus");
} else if ($action == "edituser") {
	$koneksi->update_data_user($_POST['username'], md5($_POST['password']), $_POST['level']);
	header("location:../views/halamanuser.php?pesan=edit");
}
