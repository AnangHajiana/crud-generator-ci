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
            </tr>
            <tr>
                <td>
                    <?php foreach($show_tables as $row) {$row = (array) $row;?>
                    <div>
                        <a href="<?=base_url()?>index.php/main/selectedtable/<?=$row['Tables_in_'.DATABASE_NAME]?>"><?=$row['Tables_in_'.DATABASE_NAME]?></a>
                    <div>
                    <?php } ?>
                </td>
            </tr>
        </table>
        <div style="text-align:right">
            dikembangkan oleh <a target="_blank" href="https://ananghajiana.blogspot.com">ananghajiana.blogspot.com</a>
        </div>
    </body>
</html>