<html>
    <head>
        <title>crud generator</title>
        <style>
            table {
                border-collapse: collapse;
            }
                table, th, td {
                border: 0.1px solid black;
            }
            a{
                text-decoration : none;
                color : #02028c;
            }
            a:hover{
                color: #3636ff;
            }

            .active{
                color: #3636ff;
            }

            body{
                background-color:#cacaca;
                font-family:'Segoe UI'
            }
        </style>
    </head>
    <body>
        <table>
            <tr>
                <td>Pilih Tabel</td>
                <td>Daftar Kolom</td>
            </tr>
            <tr>
                <td>
                    <?php foreach($show_tables as $row) {$row = (array) $row;?>
                    <div>
                        <?php 
                            $parts = explode('/', $_SERVER['REQUEST_URI']);
                            $last = end($parts);
                        ?>
                        <a class="<?=$last==$row['Tables_in_'.DATABASE_NAME]?'active':''?>" href="<?=base_url()?>index.php/main/selectedtable/<?=$row['Tables_in_'.DATABASE_NAME]?>"><?=$row['Tables_in_'.DATABASE_NAME]?></a>
                    <div>
                    <?php } ?>
                </td>
                <td>
                    <table>
                        <?php foreach($show_column as $row) {?>
                            <tr>
                                <!-- <td>
                                    <input <?=$row->Key == 'PRI'?'checked readonly onclick="return false;"':''?> type="checkbox">
                                </td> -->
                                <td>
                                    <?=$row->Field?>
                                </td>
                                <td>
                                    <?=$row->Key=='PRI'?'*'.$row->Key.'MARY KEY':$row->Key?>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                    <br>
                    <button onclick="viewCode()">Lihat Kode</button>
                </td>
            </tr>
        </table>
        <div style="text-align:right">
            dikembangkan oleh <a target="_blank" href="https://ananghajiana.blogspot.com">ananghajiana.blogspot.com</a>
        </div>
        <script>
            var base_url = window.location.origin;
            function viewCode(){
                window.location = base_url+'/crud-generator/index.php/main/viewcode/<?=$table_name?>';
            }
        </script>
    </body>
</html>