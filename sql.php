<html>
    <body>
        <form method="post" action="sql.php">
        <table width="500" border="0" cellspacing="1" cellpadding="2">
        <tr>
            <td width="100">Kelas</td>
            <td><input name="kode_kelas" type="text" id="Kelas"></td>
        </tr>
        <tr>
            <td width="120">Nama Kelas</td>
            <td><input name="nama_kelas" type="text" id="Nama Kelas"></td>
        </tr>
                <tr>
            <td width="110"> </td>
            <td>
                <input name="simpan" type="submit" id="simpan" value="Simpan">
            </td>
        </tr>
        </table>
    </form>
        <?php
            if(isset($_POST['simpan']))
            {
            $servername="localhost";
    $username="root";
    $password="";
    $database="dbmahasiswa";
    $koneksi=mysql_connect ($servername, $username, $password);

  if ($koneksi) {
    mysql_select_db ($database) or die ("Database Tidak Ditemukan");
     echo "<b> Koneksi Berhasil </b>";
   } else {
     echo "<b> Koneksi Gagal </b>";
   }
             
            if(! get_magic_quotes_gpc() )
            {
               $kode = addslashes ($_POST['kode_kelas']);
               $nama = addslashes ($_POST['nama_kelas']);
            }
            else
            {
               $kode = $_POST ['kode_kelas'];
               $nama = $_POST ['nama_kelas'];
               }
            
            //Memasukkan data kedalam tabel mahasiswa
            $sql = "INSERT INTO tb_kelas ".
                   "(kode_kelas,nama_kelas) ".
                   "VALUES('$kode','$nama')";
            mysql_select_db('biodata');
            $tambahdata = mysql_query( $sql, $koneksi );
            if(! $tambahdata )
            {
              die('Gagal Tambah Data: ' . mysql_error());
            }
            echo "Berhasil tambah data\n <br>";
            
            //Mengambil data dari tabel mahasiwa
            $sql = "SELECT kode_kelas,nama_kelas FROM tb_kelas";
            mysql_select_db('dbmahasiswa');
            $hasil = mysql_query($sql);
            
            // Hasil Inputan
            while ( $row = mysql_fetch_assoc($hasil) ) {
                echo "<br>";
                echo "Kode Kelas: " . $row["kode_kelas"]. " - Nama Kelas: " . $row["nama_kelas"]. "<br>";
            }
            mysql_close($koneksi);
            }
            else
            {
            }
        ?>
    </body>
</html>