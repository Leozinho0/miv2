<?php
session_start();


//Includes
require_once 'class/conn.class.php';
require_once 'html_functions.php';

if(isset($_GET['address'])){

if(isset($_SESSION['conn'][$_GET['address']]['status']) && $_SESSION['conn'][$_GET['address']]['status'] === true){
    //$conn = new Conn($_SESSION['conn'][$_GET['address']]['banco'], $_SESSION['conn'][$_GET['address']]['address'], $_SESSION['conn'][$_GET['address']]['usr'], $_SESSION['conn'][$_GET['address']]['psw']);
    $conn = new Conn($_SESSION['conn'][$_GET['address']]['banco'], $_GET['address'], $_SESSION['conn'][$_GET['address']]['usr'], $_SESSION['conn'][$_GET['address']]['psw']);
    $arr_databases = array();
    $arr_databases = $conn->showDatabases($_SESSION['conn'][$_GET['address']]['banco']);
    //
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Database Populator - Home</title>
        <style>
            @font-face{
                font-family: "openSans";
                src: URL("fonts/openSans/OpenSans-Regular.ttf");
                font-style: normal;
                font-weight: normal;
            }
            @font-face{
                font-family: "openSans";
                src: URL("fonts/openSans/OpenSans-Bold.ttf");
                font-style: normal;
                font-weight: bold;
            }            
            @font-face{
                font-family: "openSans";
                src: URL("fonts/openSans/OpenSans-Italic.ttf");
                font-style: italic;
                font-weight: normal;
            }            
            @font-face{
                font-family: "openSans";
                src: URL("fonts/openSans/OpenSans-BoldItalic.ttf");
                font-style: italic;
                font-weight: bold;
            }
            body, html{
                margin: 0;
                padding: 0;
                height: 100%;
                background-color: #ECF0F1;
                color: black;
                font-family: "openSans";
                overflow-y: hidden;
            }
            .left_container{
                //background-color: blue;
                width: 300px;
                height: 100%;
                float: left;
            }   
            .right_container{
                //background-color: purple;
                height: 100%;
                float: left;
                width: calc(100% - 300px);
            }
            #header_left_container{
                //background-color: red;
                height: 70px;
                border-bottom: 1px solid white;
            }
            #header_left_container_logo{
                text-align: center;
                color: #ECF0F1;
                font-size: 20px;
                font-weight: bolder;
                text-shadow: 1px 1px 10px #000;
                padding: 5px;

            }
            #header_left_container_logo img{
                vertical-align: middle;
                padding-right: 10px;
            }
            .header_left_container_toolbar{
                padding: 0px;
                text-align: center;
                margin: 0px;
            }
            .header_left_container_toolbar li{
                //background-color: green;
                display: inline-block;
            }
            #header_right_container{
                //background-color: grey;
                width: 100%;
                height: 70px;
                overflow-y: hidden;
            }
            #header_right_container_utoolbar{
                background-color: #D1D5D8;
            }
            .header_right_container_ltoolbar{
                //background-color: yellow;
            }
            .header_right_container_ltoolbar ul{
                margin: 0px;
                padding: 0px;
            }
            .header_right_container_ltoolbar li{
                display: inline-block;
                padding: 15px;
                //background-color: #F0F0F0;
                border-right: 2px solid white;
            }
            .header_right_container_ltoolbar li:hover, .header_right_container_ltoolbar a:hover{
                background-color: #D1D5D8;
                //color: #ECF0F1;
            }
            #body_left_container{
                //background-color: yellow;
                height: calc(100% - 71px);
                overflow-y: scroll;
                white-space: nowrap;
            }
            #body_right_container{
                background-color: white;
                height: calc(100% - 70px);
                overflow-y: scroll;
            }
            .ul_tables{
                 list-style: none;
                 padding: 0;
                 margin-left: 15px;
            }
            .li_tables{
                margin-left: 1em;
            }
            .li_tables a{
                display: inline-block;
            }
            .TESTE{
                width: 500px;
                border: 1px solid #D1D5D8;
                margin: 0 10px 10px 0;
            }
            h2{
                margin: 0px;
                color: grey;
            }
            .header_right_container_ltoolbar a{
                text-decoration: none;
                color: grey;
                font-weight: bolder;
                //text-shadow: 1px 1px 10px #000;
            }
            .ajax_main_loading {
                display: none;
                z-index: 9999;
                text-align: center;
                background-color: black;
                opacity: 0.3;
                height: 100%;
                position: absolute;
                width: 100%;
            }
            .ajax_main_loading img{
                width: 80px;
                opacity: 1;
                position: relative;
                top: 40%;
            }
            .default_links{

            }
            .database_ul li:hover{
                background-color: #D1D5D8;
            }
        </style>
        <link rel="stylesheet" href="css/pc_sql.css">
        <link rel="stylesheet" href="css/pc_massive_insert.css">

        <script src="js/jquery.js"></script>
        <script src="js/scripts.js"></script>
    </head>
    <body>
        <div class="ajax_main_loading">
            <img src="img/loading.png" alt="">
        </div>
        <div class="left_container" id="teste_leo">
            <div id="header_left_container">
                <div id="header_left_container_logo">
                    <img src="img/db_icon.png" alt="" width="35"><span>Database Populator</span>
                </div>
                <div>
                    <ul class="header_left_container_toolbar">
                        <li>
                            <a href="">
                                <img src="img/original/img/b_home.png" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="javascript: disconnect();">
                                <img src="img/pmahomme/img/s_loggoff.png" alt="">
                            </a>

                        </li>
                        <li>
                            <a href="">
                                <img src="img/pmahomme/img/s_cog.png" alt="">
                            </a>

                        </li>
                        <li>
                            <a href="">
                                <img src="img/pmahomme/img/b_docs.png" alt="">
                            </a>

                        </li>
                        <li>
                            <a href="">
                                <img src="img/pmahomme/img/s_lock.png" alt="">
                            </a>

                        </li>
                        <li>
                            <a href="javascript: window.location.reload();">
                                <img src="img/pmahomme/img/s_reload.png" alt="">
                            </a>

                        </li>
                    </ul>
                </div>
            </div>
            <div id="body_left_container">
                <?php html_databases($arr_databases); ?>
            </div>
        </div>
        <div class="right_container">
            <div id="header_right_container">
                <div id="header_right_container_utoolbar">
                    <div class="toolbar_collapse" style="float: left; padding: 0 5px;">
                        <a href="#" onclick="div_RightToLeftCollapse('#teste_leo');">
                            <img src="img/pmahomme/img/bd_prevpage.png" alt="">
                        </a>
                    </div>
                    <div>
                        <img src="img/pmahomme/img/s_host.png" alt="">
                        <span id="connection_address"> <?php echo $_GET['address']; ?> </span>
                    </div>
                </div>
                <div class="header_right_container_ltoolbar">
                    <ul>
                        <li>
                            <a href="javascript: load_page_content('pc_massive_insert');">
                                <img src="img/pmahomme/img/s_db.png" alt="">
                                Inserir Registros
                            </a>
                        </li>
                        <li>
                            <a href="javascript: load_page_content('pc_sql');">
                                <img src="img/pmahomme/img/b_sql.png" alt="">
                                SQL
                            </a>                            
                        </li>
                        <li>
                            <a href="javascript: load_page_content('');">
                                <img src="img/pmahomme/img/b_import.png" alt="">
                                Importar
                            </a>
                        </li>
                        <li>
                            <a href="javascript: load_page_content('');">
                                <img src="img/pmahomme/img/b_export.png" alt="">
                                Exportar
                            </a>
                        </li>
                        <li>
                            <a href="javascript: load_page_content('');">
                                <img src="img/pmahomme/img/s_rights.png" alt="">
                                Configurações de Usuário
                            </a>                            
                        </li>
                        <li>
                            <a href="javascript: load_page_content('');">
                                <img src="img/pmahomme/img/s_process.png" alt="">
                                Ajustes Gerais
                            </a>                            
                        </li>
                        <li>
                            <a href="javascript: load_page_content('');">
                                <img src="img/pmahomme/img/s_info.png" alt="">
                                Sobre
                            </a>                            
                        </li>
                    </ul>
                </div>
            </div>
            <!-- dá um include no arquivo que dá include nas telas da app com display none -->
            <div id="body_right_container">
            </div>
            
        </div>
    </body>
    </html>
    <?php
}
else{
    include "desconn_redir.php";
}
    
}else{
    header('location: index.php');
}


?>