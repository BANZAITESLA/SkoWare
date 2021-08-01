<?php
    include_once("sidebar-header.php");
    sidehead("spelayan.php");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kasir</title>
    <link href="https://fonts.googleapis.com/css2?family=Spectral:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <style>
        body {
            background-color: #F5F5F5;
        }
        .isi {
            position: absolute;
            display: block;
            top: 155px;
            left: 29%;
            width: 67vw;
            height: 35vw;
        }
        .judul {
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;

            font-weight: bold;
            font-size: 24px;
            letter-spacing: 10px;
        }
        .caridantambah {
            display: flex;
            flex-direction: row;
            justify-content: space-between;

            margin-top: 20px;
        }
        .cari input {
            padding: 10px;
            border: 0 solid;
            border-radius: 10px 0px 0px 10px;
            background-color: #C4C4C4;

            font-family: inherit;
        }
        .cari a {
            padding: 10px;
            border-radius: 0px 10px 10px 0px;
            background-color: #C4C4C4;

            font-size: 14px;
            color: black;
        }
        .tambah {
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            width: 100px;
            padding: 5px;

            background-color: #6A6363;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }
        .tambah a {
            text-decoration: none;
            color: white;
            font-size: 14px;
        }
        .table {
            margin-top: 15px;
        }
        thead, tr {
            display:table;
            table-layout:fixed;
            width: 67vw;
        }
        tbody {
            display:block;
            overflow-y:auto;
            max-height:24vw; /* ubah untuk menyesuaikan tinggi tabel */
            width: 100%;
        }
        th {
            height: 40px;
            background: #F5F5F5;
        }
        td {
            height: 30px;
        }
        tr:nth-child(2n+1) {
            background : #C4C4C4;
        }
        tr:nth-of-type(even) {
            background : white;
        }
        td .button {
            padding: 3px;
            width: 70px;

            background-color: #6A6363;
            border-radius: 10px;
            border: 0 solid;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);

            text-decoration: none;
            color: white;
            font-family: inherit;
            font-size: 12px;
        }
		.form {
            display: inherit;
        }
        .simpan {
            position: fixed;
            padding: 8px;
            bottom: 50px;
            right: 50px;

            background-color: #6A6363;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            
        }
        .simpan a {
            text-decoration: none;
            color: white;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="isi">
        <div class="judul"> <!-- judul page -->
            WAITING LIST
        </div>
        <div class="caridantambah">
            <div class="cari"> <!-- cari item -->
                <input type="text" placeholder="Cari Waiting List" id="cari">
                <a href="#"><i class="fas fa-search"></i></a>
                </input>
            </div>
            <div class="tambah"> <!-- button tambah -->
                <a href="PL-tambah-wl.php">Tambah Data</a>
            </div>
        </div>
        <div class="table">
        <?php
        $db = dbConnect();
        if ($db->connect_errno == 0) {
            $sql = "SELECT  b.id_pesanan, b.waktu_datang, b.no_telp, p.id_pelanggan, p.nama_pelanggan, p.jml_pelanggan
            FROM pesanan b LEFT JOIN pelanggan p ON b.id_pelanggan=p.id_pelanggan";
            $res = $db->query($sql);
            if ($res) {
    ?>
                <table cellspacing="0" cellpadding="5">
                    <thead>
                        <tr>
                        <th width="130px">ID Pesanan</th>
                        <th width="160px">Nama Pelanggan</th>
                        <th width="160px">Waktu</th>
						<th width="130px">No Telepone</th> 
						<th width="100px">Jumlah Pelanggan</th>
                        <th width="200px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
    <?php
                        $data = $res->fetch_all(MYSQLI_ASSOC); // ambil seluruh baris data
                        foreach ($data as $barisdata) { // telusuri satu per satu
    ?>
                            <tr>
                                <td align=center><?php echo $barisdata["id_pesanan"];?></td>
                                <td align=center ><?php echo $barisdata["nama_pelanggan"];?></td>
                                <td align=center ><?php echo $barisdata["waktu_datang"];?></td>
                                <td align=center ><?php echo $barisdata["no_telp"];?></td>
                                <td align=center ><?php echo $barisdata["jml_pelanggan"];?></td>
                            
                                <td align="center" width="70px">
                                            <a href="PL-edit-wl.php?id_pesanan=<?php echo $barisdata["id_pesanan"]; ?>">
                                        <button class="button">Edit</button>
                                <td align="center" width="70px">
                                            <a href="#" id="hapus=<?php echo $barisdata["id_pesanan"];?>">
                                        <button class="button">Hapus</button>
                                        
                                    </a>
                                </td>
                            </tr>

                            <script> 
                                document.getElementById("hapus=<?php echo $barisdata["id_pesanan"];?>").addEventListener('click', function() { /* ketika button kosongkan diklik */
                                    Swal.fire({ /* validasi hapus data */
                                        icon : 'question',
                                        title : 'Konfirmasi',
                                        text : 'Yakin Hapus Pesanan?',
                                        confirmButtonText: 'Hapus',
                                        confirmButtonColor: '#DA4453',
                                        showCancelButton : true,
                                        cancelButtonText: 'Tidak',
                                        cancelButtonColor: '#6A6363'
                                    }).then((result) => {
                                        if (result.isConfirmed) { /* jika user mengklik 'Hapus' */
                                            $(function(){
                                                $.ajax ({ /* ajax hapus sesuai id menu */
                                                    type: 'POST',
                                                    url : "PL-konfir-hapuswaitinglist.php?id_pesanan=<?php echo $barisdata["id_pesanan"];?>"
                                                })
                                            })
                                            Swal.fire({
                                                icon : 'success',
                                                title : 'Berhasil',
                                                text : 'Pesanan telah dihapus.',
                                                confirmButtonText : 'Ok',
                                                confirmButtonColor : '#6A6363'
                                            }).then((result) => { /* jika proses berhasil maka load table kembali */
                                                $(document).ready(function(){
                                                    $('#table').load("L016.php");
                                                })
                                            })
                                        }
                                    })
                                })
                            </script>
    <?php
                        }
    ?>
                </table>
    <?php
                $res->free();
            }
        }
    ?>
</div>
        </div>
        <script>
        $(document).ready(function(){
            load_data();

            function load_data(query) { /* ajax untuk menampilkan hasil table */
                $.ajax({
                    url:"L016.php",
                    method:"POST",
                    data:{query:query},
                    success:function(data) {
                        $('#table').html(data);
                    }
                });
            }

            $('#cari').keyup(function() { /* jquery ketika terdapat input cari */
                var pencarian = $(this).val();
                if(pencarian != '') {
                    load_data(pencarian);
                } else {
                    load_data();
                }
            });
            
        });
    </script>
  
</body>
</html>
<script src="dist/sweetalert2.all.min.js"></script>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/jquery-ui.min.js"></script>