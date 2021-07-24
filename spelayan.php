<?php
    include_once('functions.php');
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
        .creator {
            width: 20%;
            bottom: 60px;
        }


       

        .pemesananselesai  {
            display: block;
            width: 15%;
            height: 40%;
            margin-left: 28%;
            
            text-decoration: none;
            color: black;
            font-weight: bold;
            font-size: 18px;
            text-align: center;
        }

        .logout a{
            display: block;
            margin: 115px 10px 20px 10px;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);

            background-color: #A9A3A3;
            text-decoration: none;
            color: black;
            font-weight: bold;
            font-size: 18px;
        }
        
       
    </style>
</head>
<body>
    <?php
        function sidebar() {
    ?>
            <div class="sidebar"> <!-- bagian sidebar -->
                <h1>Dashboard Pelayan</h1>
                <div class="button"> <!-- isi button -->
                    <a href="L012.php">Pengaturan Meja dan Kursi</a>
                    <a href="L016.php">Waiting List</a>
                    <a href="L018.php">Pengantaran Pesanan</a>
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
     

   

    <?php
        function pemesananselesai() {
    ?>
        <div class="pemesananselesai"> <!-- bagian pemesanan selesai -->
                <div class="button"> <!-- isi button -->
                    <a href="L012.php">01</a>
                    <a href="L012.php">02</a>
                </div>
        </div>
    <?php } ;?>

    
    
</body>
<script src="https://kit.fontawesome.com/50adeae078.js" crossorigin="anonymous"></script>
<script src="dist/sweetalert2.all.min.js"></script>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
</html>