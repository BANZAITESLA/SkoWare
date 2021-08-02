<?php
    include_once("functions.php");
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pegawai</title>
    <link href="https://fonts.googleapis.com/css2?family=Spectral:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <style>
        body {
            display: block;
            margin: 40px;

            background-color: #F5F5F5;
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
        .form {
            margin-top: 40px;
            width: 100%;
        }
        .form-control {
            display: flex;
            flex-direction: column;
            align-items: center;

            margin-top: 15px;
        }
        .form-control label {
            align-items: flex-start;
            margin-bottom: 5px;
            width: 25%;

            font-weight: bold;
            font-size: 16px;
        }
        .form-control input {
            display: block;
            border: 0 solid;
            border-radius: 10px;
            width: 25%;

            background-color: #C4C4C4;

            font-family: inherit;
            padding: 10px;
        }
        .masuk-control {
            display: flex;
            justify-content: center;
            align-items: center;

            margin-top: 10px;
        }
        .masuk {
            padding: 10px;
            margin-top: 15px;

            border: 0 solid;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            width: 10%;

            background-color: #6A6363;
            color: #FFFFFF;
            font-family: inherit;
        }
    </style>
</head>

<body>
    <?php
        logo();
    ?>

    <?php
        if (isset($_GET["error"])) { /* jika login error, panggil function js */
            $error = $_GET["error"];
            if ($error == 1) {
                echo '<script type="text/javascript">','loginsalah();','</script>';
            } else if ($error == 2) {
                echo '<script type="text/javascript">','logindulu();','</script>';
            } else if ($error == 3) {
                echo '<script type="text/javascript">','dberror();','</script>';
            } else{
                echo '<script type="text/javascript">','unknownerror();','</script>';
            }
        }
    ?>
    <div class="judul"> <!-- judul page -->
        PORTAL <br>
        LOGIN PEGAWAI
    </div>
    
        <form class="form" action="konfirmasi-login.php" method="post"> <!-- form login -->
            <div class="form-control">
                <label for="username">Username</label>
                <input type="text" placeholder="Masukan ID Anda" name="username"></input>
            </div>
            <div class="form-control">
                <label for="password">Password</label>
                <input type="password" placeholder="Masukan Password Anda" name="password"></input>
            </div>
            <div class="masuk-control">
                <input class="masuk" type="submit" value="Masuk" name="masuk"></input>
            </div>
        </form>
</body>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
</html>