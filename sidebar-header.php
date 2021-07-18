<?php
    function sidehead($filesidebar) {
        session_start();
        include_once("$filesidebar");
        include_once("functions.php");
?>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Dashboard Koki</title>
            <style>
                body {
                    background-color: #F5F5F5;
                }
                .head {
                    position: fixed;
                    display: flex;
                    margin-top: 40px;
                    margin-left: 28%;
                }
                .nama {
                    display: flex;
                    justify-content: flex-end;
                    align-items: center;
                    width: 50vw;

                    font-weight: bold;
                    font-size: 16px;
                }
            </style>
        </head>
        <body>
            
            <?php
                sidebar();
            ?>
            <div class="head">
                <div class="aturlogo">
                    <?php
                        logo();
                    ?>
                </div>
                <div class="nama">    
                    <?php
                        echo "Hai, ".$_SESSION['nama_pegawai'];
                    ?>
                </div>
            </div>
        </body>
        </html>
<?php
    }
?>
