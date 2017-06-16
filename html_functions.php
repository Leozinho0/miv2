<?php
//Retorna ul > li com as bases de dados
function html_databases($base){
    echo "<style>
             .database_ul{
                 list-style: none;
                 padding: 0;
                 margin-left: 15px;
             }
          </style>";
    
    echo "<ul class='database_ul'>";
    foreach($base as $key){
        echo "<li id='database_$key[0]' title='$key[0]'>";
        echo '<img src="img/pmahomme/img/b_plus.png" name= "icon_plus" alt="" width=15px style="padding-right: 5px;" onclick="hide_icon(this); js_listTables(this);" > ';
        echo '<img src="img/pmahomme/img/b_minus.png" name= "icon_minus" alt="" width=15px style="display: none; padding-right: 10px;" onclick="hide_icon(this); js_listTables(this);" >';
        echo $key[0];
        echo "</li>";
    }
    echo "</ul>";
}
//


?>