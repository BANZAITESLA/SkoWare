<?php
    include_once('functions.php')
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Spectral:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <style>
        .sidebar {
            display: block;
            position: fixed;
            
            width: 20%;
            height: 80%;
            margin: 40px;
            padding: 20px 20px 15px 20px;
            border-radius: 10px;

            background: #C4C4C4;
            text-align: center;
        }
        h1 {
            margin-bottom: 40px;
            font-size: 26px;
        }
        .dropbtn {
        background-color: #A9A3A3;
        color: black;
        padding: 15px;
        width: 250px;
        font-size: 18px;
        font-family: inherit;
        font-weight: bold;
        border: 0 solid;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }
        .dropdown {
            position: relative;
            display: inline-block;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #A9A3A3;
            color: black;
            font-weight: bold;
            font-size: 18px;
            padding: 15px;
            min-width: 218px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            z-index: 1;
        }
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            border-radius: 10px;
        }
        .dropdown-content a:hover {
            background-color: #C4C4C4;
        }
        .dropdown:hover .dropdown-content {
            display: block;
        }
        .dropdown:hover .dropbtn {
            background-color: #908989;
            color: black;
        }
        .logout a{
            display: block;
            margin: 250px 10px 20px 10px;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);

            background-color: #A9A3A3;
            text-decoration: none;
            color: black;
            font-weight: bold;
            font-size: 18px;
        }
        .creator {
            width: 20%;
            bottom: 60px;
        }
    </style>
</head>
<body>
    <?php
        function sidebar() {
    ?>
        <div class="sidebar"> <!-- bagian sidebar -->
                <h1>Dashboard Pemilik Restoran</h1>
                <div class="dropdown">
                    <button class="dropbtn">Laporan Pendapatan</button>
                    <div class="dropdown-content">
                        <a href="OW-lapor-minggu.php">Mingguan</a>
                        <a href="OW-lapor-bulan.php">Bulanan</a>
                        <a href="OW-lapor-tahun.php">Tahunan</a>
                    </div>
                </div>

                <div class="logout">
                    <a id="out" href="logout.php">Logout</a>
                </div>

                <div class="creator"> <!-- tulisan creator -->
                    <?php
                        creator();
                    ?>
                </div>
            </div>
        </div>
    <?php } ;?>
</body>
</html>
<script src="https://kit.fontawesome.com/50adeae078.js" crossorigin="anonymous"></script>
<script src="dist/sweetalert2.all.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="js/jquery-ui.min.js"></script>