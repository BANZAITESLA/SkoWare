<?php
    include_once("spelanggan.php");
    include_once("functions.php");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pelanggan</title>
    <style>
        body {
            background-color: #F5F5F5;
        }
        .isi {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 80vh;
            margin-left: 30%;
            padding-top: 40px;
        }
    </style>
</head>
<body>
    <?php
        sidebar();
    ?>
        <div class="isi">
            <?php
                logo();
            ?>
        </div>
</body>
</html>