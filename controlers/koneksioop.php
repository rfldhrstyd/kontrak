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
    function jumlah_pic($id_kontrak_file)
    {
        $data = mysqli_query($this->koneksi, "select * from pic where id_kontrak='$id_kontrak_file'");
        $jumlah_file_upload = mysqli_num_rows($data);

        return $jumlah_file_upload;
    }
    function jumlah_status($id_kontrak_file)
    {
        $data = mysqli_query($this->koneksi, "select * from status where id_kontrak='$id_kontrak_file'");
        $jumlah_file_upload = mysqli_num_rows($data);

        return $jumlah_file_upload;
    }

    function tampil_data()
    {
        $data = mysqli_query($this->koneksi, "select * from kontrak");
        while ($row = mysqli_fetch_array($data)) {
            $hasil[] = $row;
        }
        $hasil = !empty($hasil) ? $hasil : '';
        return $hasil;
    }

    function tampil_user()
    {
        $data = mysqli_query($this->koneksi, "select * from users");
        while ($row = mysqli_fetch_array($data)) {
            $hasil[] = $row;
        }
        $hasil = !empty($hasil) ? $hasil : '';
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

    function tampil_pic($id_kontrak_file)
    {
        $file = mysqli_query($this->koneksi, "select * from pic where id_kontrak='$id_kontrak_file'");
        while ($row_file = mysqli_fetch_array($file)) {
            $hasilfile[] = $row_file;
        }
        $hasilfile = !empty($hasilfile) ? $hasilfile : '';
        return $hasilfile;
    }

    function tampil_status($id_kontrak_file)
    {
        $file = mysqli_query($this->koneksi, "select * from status where id_kontrak='$id_kontrak_file'");
        while ($row_file = mysqli_fetch_array($file)) {
            $hasilfile[] = $row_file;
        }
        $hasilfile = !empty($hasilfile) ? $hasilfile : '';
        return $hasilfile;
    }

    function tambah_data($judul_kontrak, $nilai_kontrak, $aging_days, $no_kontrak, $no_wbs, $tgl_dari, $tgl_sampai)
    {
        mysqli_query($this->koneksi, "insert into kontrak values ('','$judul_kontrak','$nilai_kontrak','$aging_days','$no_kontrak','$no_wbs','$tgl_dari','$tgl_sampai')");
    }

    function tambah_data_pic($jenis_pic, $nama_pic, $id_kontrak)
    {
        mysqli_query($this->koneksi, "insert into pic values ('','$jenis_pic','$nama_pic','$id_kontrak')");
    }

    function tambah_data_user($userame, $password, $level)
    {
        mysqli_query($this->koneksi, "insert into users values ('','$userame','$password','$level')");
    }

    function tambah_data_status($isi_status, $type_status, $tgl_upload, $id_kontrak)
    {
        mysqli_query($this->koneksi, "insert into status values ('','$isi_status','$type_status','$tgl_upload','$id_kontrak')");
    }
    function add_data_log($id_status, $isi_status, $type_status, $tgl_upload)
    {
        mysqli_query($this->koneksi, "insert into log_status values ('','$id_status','$isi_status','$type_status','$tgl_upload')");
    }

    function get_by_id($id_kontrak)
    {
        $query = mysqli_query($this->koneksi, "select * from kontrak where id_kontrak='$id_kontrak'");
        return $query->fetch_array();
    }

    function get_by_id_pic($id_pic)
    {
        $query = mysqli_query($this->koneksi, "select * from pic where id_pic='$id_pic'");
        return $query->fetch_array();
    }

    function get_by_id_status($id_status)
    {
        $query = mysqli_query($this->koneksi, "select * from status where id_status='$id_status'");
        return $query->fetch_array();
    }

    function update_data($id_kontrak, $judul_kontrak, $nilai_kontrak, $aging_days, $no_kontrak, $no_wbs, $tgl_dari, $tgl_sampai)
    {
        mysqli_query($this->koneksi, "update kontrak set judul_kontrak='$judul_kontrak',nilai_kontrak='$nilai_kontrak',aging_days='$aging_days',no_kontrak='$no_kontrak',no_wbs='$no_wbs',tgl_dari='$tgl_dari',tgl_sampai='$tgl_sampai' where id_kontrak='$id_kontrak'");
    }
    function update_data_pic($id_pic, $jenis_pic, $nama_pic, $id_kontrak)
    {
        mysqli_query($this->koneksi, "update pic set jenis_pic='$jenis_pic',nama_pic='$nama_pic',id_kontrak='$id_kontrak' where id_pic='$id_pic'");
    }

    function update_data_user($username, $password, $level)
    {
        mysqli_query($this->koneksi, "update users set password='$password', level='$level' where username='$username'");
    }

    function update_data_status($id_status, $isi_status, $type_status, $tgl_upload, $id_kontrak)
    {
        mysqli_query($this->koneksi, "update status set isi_status='$isi_status',type_status='$type_status', tgl_upload='$tgl_upload', id_kontrak='$id_kontrak'  where id_status='$id_status'");
    }

    function delete_data($id_kontrak)
    {
        $query = mysqli_query($this->koneksi, "delete from kontrak where id_kontrak='$id_kontrak'");
    }
    function delete_data_file($id_file)
    {
        $query = mysqli_query($this->koneksi, "delete from file where id_file='$id_file'");
    }
    function delete_data_pic($id_pic)
    {
        $query = mysqli_query($this->koneksi, "delete from pic where id_pic='$id_pic'");
    }
    function delete_data_status($id_status)
    {
        $query = mysqli_query($this->koneksi, "delete from status where id_status='$id_status'");
    }

    function delete_data_user($id_user)
    {
        $query = mysqli_query($this->koneksi, "delete from users where id_user='$id_user'");
    }
}
