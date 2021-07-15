<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Spectral:wght@400;700&display=swap" rel="stylesheet">
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
        function creator() {
    ?>
        <div class="creator"> <!-- tulisan created by -->
            Created with <i class="fas fa-heart"></i><br>
            SkoWare Dev Team
        </div>
    <?php
        }
    ?>

    <?php
        function logo() {
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
</body>
<script src="https://kit.fontawesome.com/50adeae078.js" crossorigin="anonymous"></script>
</html>