<?php 
// mengaktifkan session php
session_start();
 
// menghubungkan dengan koneksi
include 'koneksi.php';
 
// menangkap data yang dikirim dari form
$username = $_POST['username'];
$password = md5($_POST['password']);
 
// menyeleksi data admin dengan username dan password yang sesuai
$login  = mysqli_query($koneksi,"select * from users where username='$username' and password='$password'");
 
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);
 
// cek apakah username dan password di temukan pada database
if($cek > 0){
 
	$data = mysqli_fetch_assoc($login);
 
	// cek jika user login sebagai admin
	if($data['level']=="super"){
 
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "super";
		// alihkan ke halaman dashboard admin
		header("location:../views/halaman_super.php?pesan=berhasil");
 
	// cek jika user login sebagai pegawai
	}else if($data['level']=="admin"){
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "admin";
		// alihkan ke halaman dashboard pegawai
		header("location:admin.php");
 
	// cek jika user login sebagai pengurus
	}else if($data['level']=="views"){
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "views";
		// alihkan ke halaman dashboard pengurus
		header("location:halaman_views.php");
 
	}else{
 
		// alihkan ke halaman login kembali
		header("location:../index.php?pesan=gagal");
	}	
}else{
	header("location:../index.php?pesan=gagal");
}
