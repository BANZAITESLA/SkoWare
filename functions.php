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
                    icon : 'warning',
                    title : 'Peringatan',
                    text : 'Username dan Password tidak valid.',
                    textColor : '000000',
                    confirmButtonText: 'Ya',
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
                    confirmButtonText: 'Ya',
                    confirmButtonColor: '#6A6363',
                })
            });
        }

        function dberror() { /* alert untuk koneksi db error */
            $(document).ready(function() {
                Swal.fire({
                    icon : 'warning',
                    title : 'Peringatan',
                    text : 'Koneksi Database Error. Hubungi Administrator.',
                    confirmButtonText: 'Ya',
                    confirmButtonColor: '#6A6363',
                })
            });
        }

        function unknownerror() { /* alert untuk error yang tidak diketahui. validasi error. */
            $(document).ready(function() {
                Swal.fire({
                    icon : 'warning',
                    title : 'Peringatan',
                    text : 'Error tidak dikenal.',
                    confirmButtonText: 'Ya',
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
