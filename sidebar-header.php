<?php
    session_start();
    function sidehead($filesidebar) {
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
                    width: 55vw;

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
                <?php
                    if($filesidebar != "spelanggan.php") {
                ?>
                        <div class="nama">    
                            <?php
                                if(!empty($_SESSION['nama_pegawai'])) {
                                    echo "Hai, ".$_SESSION['nama_pegawai'];
                                } else {
                                    $url = 'login.php?error=3';
                                    redirect($url);
                                }
                                
                            ?>
                        </div>
                <?php
                    }
                ?>
            </div>
        </body>
        </html>
<?php
    }
?>