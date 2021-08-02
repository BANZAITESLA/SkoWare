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
        .button a {
            display: block;
            margin: 10px 10px 20px 10px;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);

            background-color: #A9A3A3;
            text-decoration: none;
            color: black;
            font-weight: bold;
            font-size: 18px;
        }
        .logout a{
            display: block;
            margin: 200px 10px 20px 10px;
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
                <h1>Dashboard Kasir</h1>

                <div class="button"> <!-- isi button -->
                    <a href="pembayaran.php">Pembayaran Minuman</a>
                    <a href="KS-laporan.php">Laporan Keuangan</a>
                </div>

                <div class="logout">
                    <a href="logout.php">Logout</a>
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
<script src="https://kit.fontawesome.com/50adeae078.js" crossorigin="anonymous"></script>
</html>