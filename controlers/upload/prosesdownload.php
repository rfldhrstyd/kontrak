<?php
// Downloads files
// Tentukan folder file yang boleh di download
$folder = "files/";
$filename = $_GET['file'];
$file_extension = strtolower(substr(strrchr($filename,"."),1));
// Lalu cek menggunakan fungsi file_exist
if (!file_exists($folder.$_GET['file'])) {
 echo "<script>alert('File sudah tidak ada');</script>";
 exit;
}
else if ($file_extension=='php'){
 echo "<script>alert('File sudah tidak ada');</script>";
 exit;
}
// Apabila mendownload file di folder 
else {
 
 //header("Cache-Control: public");
 //header("Content-Description: File Transfer");
 header("Content-Disposition: attachment; filename=".basename($filename));
 header("Content-Type: application/octet-stream;");
 //header("Content-Transfer-Encoding: binary");
 readfile("files/".$filename);
}
