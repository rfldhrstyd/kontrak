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

    function tampil_data()
    {
        $data = mysqli_query($this->koneksi, "select * from kontrak");
        while ($row = mysqli_fetch_array($data)) {
            $hasil[] = $row;
        }
        return $hasil;
    }

    function tambah_data($judul_kontrak, $nilai_kontrak, $aging_days, $no_kontrak, $no_wbs)
    {
        mysqli_query($this->koneksi, "insert into kontrak values ('','$judul_kontrak','$nilai_kontrak','$aging_days','$no_kontrak','$no_wbs')");
    }

    function delete_data($id_kontrak)
	{
		$query = mysqli_query($this->koneksi,"delete from kontrak where id_kontrak='$id_kontrak'");
	}
}
