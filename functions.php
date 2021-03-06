<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Spectral:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <style>
        .creator {
            position: fixed;
            display: block;

            font-family: 'Spectral', serif;
            font-weight: bold;
            font-size: 12px;
            color: rgba(0, 0, 0, 0.8);
        }
        .logo {
            display: block;
        }
        .logo .sko {
            font-size: 38px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <?php
        function dbConnect() { /* function untuk koneksi ke db */
            $db = new mysqli("localhost","root","","db_skoware"); 
            return $db; 
        }

        function getMenu($id) {
            $db=dbConnect();
            if($db->connect_errno==0){
                $res=$db->query("SELECT * FROM menu_minuman WHERE id_menu='$id'");
                if($res){
                    if($res->num_rows>0){
                        $data=$res->fetch_assoc();
                        $res->free();
                        return $data;
                    }
                    else
                        return false;
                }
                else
                    return false; 
            }
            else
                return false;
        }
        
        function getDataPelanggan($id_pelanggan) {
            $db = dbConnect();
            if ($db->connect_errno == 0) {
                $res = $db->query("SELECT  id_pelanggan, nama_pelanggan, jml_pelanggan FROM pelanggan 
                WHERE id_pelanggan='$id_pelanggan'");
                if ($res) {
                    if ($res->num_rows > 0) {
                        $data = $res->fetch_assoc();
                        $res->free();
                        return $data;
                    } else
                    return FALSE;
                } else
                return FALSE;
            } else
            return FALSE;
        } 

        function getDataMejaDanKursi($no_meja) {
            $db = dbConnect();
            if ($db->connect_errno == 0) {
                $res = $db->query("SELECT m.no_meja, m.status, b.id_pesanan, b.tgl_bayar, b.waktu_datang, b.no_telp, b.total, p.id_pelanggan, p.nama_pelanggan, p.jml_pelanggan 
                                    FROM meja_dan_kursi m LEFT JOIN pesanan b ON m.id_pesanan=b.id_pesanan LEFT JOIN pelanggan p ON p.id_pelanggan = b.id_pelanggan WHERE m.no_meja = $no_meja");
                if ($res) {
                    if ($res->num_rows > 0) {
                        $data = $res->fetch_assoc();
                        $res->free();
                        return $data;
                    } else
                    return FALSE;
                } else
                return FALSE;
            } else
            return FALSE;
        }

        function getMejaKosong() {
            $db = dbConnect();
            if ($db->connect_errno == 0) {
                $res = $db->query("SELECT * FROM meja_dan_kursi WHERE id_pesanan IS NULL AND `status` = 'Tersedia'");
                if ($res) {
                    if ($res->num_rows > 0) {
                        $data=$res->fetch_all(MYSQLI_ASSOC);
                        $res->free();
                        return $data;
                    } else
                    return FALSE;
                } else
                return FALSE;
            } else
            return FALSE;
        }

        function getDataPesanan($id_pesanan) {
            $db = dbConnect();
            if ($db->connect_errno == 0) {
                $res = $db->query("SELECT b.id_pesanan, b.tgl_bayar, CAST(b.waktu_datang AS DATE) AS tanggal, DATE_FORMAT(b.waktu_datang,'%H:%i:%s') waktu, b.no_telp, b.total, p.id_pelanggan, p.nama_pelanggan, p.jml_pelanggan FROM pesanan b LEFT JOIN pelanggan p ON b.id_pelanggan=p.id_pelanggan WHERE id_pesanan='$id_pesanan'");
                if ($res) {
                    if ($res->num_rows > 0) {
                        $data = $res->fetch_assoc();
                        $res->free();
                        return $data;
                    } else
                    return FALSE;
                } else
                return FALSE;
            } else
            return FALSE;
        }

        function getDetail($meja, $menu) {
            $db = dbConnect();
            if ($db->connect_errno == 0) {
                $res = $db->query("SELECT * FROM detail_pesanan, meja_dan_kursi, menu_minuman WHERE no_meja = '$meja' AND meja_dan_kursi.id_pesanan = detail_pesanan.id_pesanan AND detail_pesanan.id_menu = '$menu' AND detail_pesanan.id_menu = menu_minuman.id_menu");
                if ($res) {
                    if ($res->num_rows > 0) {
                        $data = $res->fetch_assoc();
                        $res->free();
                        return $data;
                    } else
                    return FALSE;
                } else
                return FALSE;
            } else
            return FALSE;
        }

        function getStatus($pesan, $menu) {
            $db = dbConnect();
            if ($db->connect_errno == 0) {
                $res = $db->query("SELECT `status` FROM detail_pesanan WHERE id_pesanan = '$pesan' AND id_menu = '$menu'");
                if ($res) {
                    if ($res->num_rows > 0) {
                        $data = $res->fetch_assoc();
                        $res->free();
                        return $data;
                    } else
                    return FALSE;
                } else
                return FALSE;
            } else
            return FALSE;
        }

        function redirect($url) { /* function untuk redirect url jika header tidak berfungsi */
            if (!headers_sent())
            {    
                header('Location: '.$url);
                exit;
                }
            else
                {  
                echo '<script type="text/javascript">';
                echo 'window.location.href="'.$url.'";';
                echo '</script>';
                echo '<noscript>';
                echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
                echo '</noscript>'; exit;
            }
        }

        function creator() { /* function untuk cap creator */
    ?>
        <div class="creator"> <!-- tulisan created by -->
            Created with <i class="fas fa-heart"></i><br>
            SkoWare Dev Team
        </div>
    <?php
        }
    ?>

    <?php
        function logo() { /* function untuk logo SkoWare */
    ?>
        <div class="logo">
            <div class="sko">
                SkoWare.<br>
            </div>
            <div class="good">
                Good Food Good Mood
            </div>
        </div>
    <?php
        }
    ?>

    <script>
        function loginsalah() { /* alert untuk username dan password salah */
            $(document).ready(function() {
                Swal.fire({
                    icon : 'error',
                    title : 'Kesalahan',
                    text : 'Username dan Password tidak valid.',
                    textColor : '000000',
                    confirmButtonText: 'Ok',
                    confirmButtonColor: '#6A6363'
                })
            });
        }

        function logindulu() { /* alert untuk redirect url ketika session login tidak valid */
            $(document).ready(function() {
                Swal.fire({
                    icon : 'warning',
                    title : 'Peringatan',
                    text : 'Silahkan Login Terlebih Dahulu.',
                    confirmButtonText: 'Ok',
                    confirmButtonColor: '#6A6363',
                })
            });
        }

        function dberror() { /* alert untuk koneksi db error */
            $(document).ready(function() {
                Swal.fire({
                    icon : 'error',
                    title : 'Kesalahan',
                    text : 'Koneksi Database Error. Hubungi Administrator.',
                    confirmButtonText: 'Ok',
                    confirmButtonColor: '#6A6363',
                })
            });
        }

        function sqlerror() { /* alert untuk query sql error */
            $(document).ready(function() {
                Swal.fire({
                    icon : 'error',
                    title : 'Kesalahan',
                    text : 'Tambah Data Gagal. Cek kembali ID yang diinput.',
                    confirmButtonText: 'Ok',
                    confirmButtonColor: '#6A6363',
                })
            });
        }

        function uploaderror() { /* alert untuk upload gambar error */
            $(document).ready(function() {
                Swal.fire({
                    icon : 'error',
                    title : 'Kesalahan',
                    text : 'Upload Gambar Gagal. Cek kembali Input Gambar serta Type dan Ukuran gambar.',
                    confirmButtonText: 'Ok',
                    confirmButtonColor: '#6A6363',
                })
            });
        }

        function nodata() { /* alert untuk data tidak ditemukan */
            $(document).ready(function() {
                Swal.fire({
                    icon : 'warning',
                    title : 'Peringatan',
                    text : 'Data Tidak Ditemukan.',
                    confirmButtonText: 'Ok',
                    confirmButtonColor: '#6A6363',
                })
            });
        }

        function inputkosong() { /* alert untuk data kosong */
            $(document).ready(function() {
                Swal.fire({
                    icon : 'warning',
                    title : 'Peringatan',
                    text : 'Silahkan Input Data Terlebih Dahulu.',
                    confirmButtonText: 'Ok',
                    confirmButtonColor: '#6A6363',
                })
            });
        }

        function idkosong() { /* alert untuk data kosong */
            $(document).ready(function() {
                Swal.fire({
                    icon : 'warning',
                    title : 'Peringatan',
                    text : 'ID Tidak Boleh Kosong.',
                    confirmButtonText: 'Ok',
                    confirmButtonColor: '#6A6363',
                })
            });
        }

        function mejakosong() { /* alert untuk data kosong */
            $(document).ready(function() {
                Swal.fire({
                    icon : 'error',
                    title : 'Kesalahan',
                    text : 'Simpan Data Gagal. No Meja Kosong.',
                    confirmButtonText: 'Ok',
                    confirmButtonColor: '#6A6363',
                })
            });
        }

        function unknownerror() { /* alert untuk error yang tidak diketahui. validasi error. */
            $(document).ready(function() {
                Swal.fire({
                    icon : 'error',
                    title : 'Kesalahan',
                    text : 'Error tidak dikenal.',
                    confirmButtonText: 'Ok',
                    confirmButtonColor: '#6A6363',
                })
            });
        }

        function tambahsuccess() { /* alert untuk tambah data berhasil */
            $(document).ready(function() {
                Swal.fire({
                    icon : 'success',
                    title : 'Berhasil',
                    text : 'Data Berhasil Disimpan.',
                    confirmButtonText: 'Ok',
                    confirmButtonColor: '#6A6363',
                })
            });
        }

      function hapussuccess() { /* alert untuk tambah hapus berhasil */
            $(document).ready(function() {
                Swal.fire({
                    icon : 'success',
                    title : 'Berhasil',
                    text : 'Data Berhasil Dihapus.',
                    confirmButtonText: 'Ok',
                    confirmButtonColor: '#6A6363',
                })
            });
        }

    </script>
</body>
<script src="https://kit.fontawesome.com/50adeae078.js" crossorigin="anonymous"></script>
<script src="dist/sweetalert2.all.min.js"></script>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
</html>
