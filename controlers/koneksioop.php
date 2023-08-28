<?php
class database
{

    var $host = "localhost";
    var $username = "root";
    var $password = "";
    var $database = "kontrakaging";
    var $koneksi = "";
    function __construct()
    {
        $this->koneksi = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        if (mysqli_connect_errno()) {
            echo "Koneksi database gagal : " . mysqli_connect_error();
        }
    }

    function jumlah_data()
    {
        $data = mysqli_query($this->koneksi, "select * from kontrak");
        $jumlah_barang = mysqli_num_rows($data);

        return $jumlah_barang;
    }

    function jumlah_file($id_kontrak_file)
    {
        $data = mysqli_query($this->koneksi, "select * from file where id_kontrak='$id_kontrak_file'");
        $jumlah_file_upload = mysqli_num_rows($data);

        return $jumlah_file_upload;
    }

    function tampil_data()
    {
        $data = mysqli_query($this->koneksi, "select * from kontrak");
        while ($row = mysqli_fetch_array($data)) {
            $hasil[] = $row;
        }
        return $hasil;
    }
    function tampil_file($id_kontrak_file)
    {
        $file = mysqli_query($this->koneksi, "select * from file where id_kontrak='$id_kontrak_file'");
        while ($row_file = mysqli_fetch_array($file)) {
            $hasilfile[] = $row_file;
        }
        $hasilfile = !empty($hasilfile) ? $hasilfile : '';
        return $hasilfile;
    }

    function tambah_data($judul_kontrak, $nilai_kontrak, $aging_days, $no_kontrak, $no_wbs)
    {
        mysqli_query($this->koneksi, "insert into kontrak values ('','$judul_kontrak','$nilai_kontrak','$aging_days','$no_kontrak','$no_wbs')");
    }

    function get_by_id($id_kontrak)
    {
        $query = mysqli_query($this->koneksi, "select * from kontrak where id_kontrak='$id_kontrak'");
        return $query->fetch_array();
    }

    function update_data($id_kontrak, $judul_kontrak, $nilai_kontrak, $aging_days, $no_kontrak, $no_wbs)
    {
        mysqli_query($this->koneksi, "update kontrak set judul_kontrak='$judul_kontrak',nilai_kontrak='$nilai_kontrak',aging_days='$aging_days',no_kontrak='$no_kontrak',no_wbs='$no_wbs' where id_kontrak='$id_kontrak'");
    }

    function delete_data($id_kontrak)
    {
        $query = mysqli_query($this->koneksi, "delete from kontrak where id_kontrak='$id_kontrak'");
    }
    function delete_data_file($id_file)
    {
        $query = mysqli_query($this->koneksi, "delete from file where id_file='$id_file'");
    }
}
