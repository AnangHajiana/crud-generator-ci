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
            textarea{
                font-size:12px;
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
                        <a class="<?=$last==$row['Tables_in_'.DATABASE_NAME]?'active':''?>" href="<?=base_url()?>index.php/main/viewcode/<?=$row['Tables_in_'.DATABASE_NAME]?>"><?=$row['Tables_in_'.DATABASE_NAME]?></a>
                    <div>
                    <?php } ?>
                </td>
                <td>
                    <table>
                        <?php foreach($show_column as $row) {?>
                            <tr>
                                <!-- <td>
                                    <input onclick="onclickItemColumn(this)" value="<?=$row->Field?>" <?=$row->Key == 'PRI'?'checked readonly onclick="return false;"':''?> type="checkbox">
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
        <br>
        <h3>Panduan</h3>
        <ul>
            <li>Copy code dibawah ini pada file anda dan simpan di masing-masing folder dengan nama file sesuai judul yang ada pada tabel dibawah ini </li>
        </ul>
        <table>
            <tr>
                <th>Controller <?=ucfirst($table_name).'.php'?></th>
                <th>Model <?='M_'.$table_name.'.php'?></th>
                <th>View <?='v_'.$table_name.'.php'?></th>
                <th>View <?='v_'.$table_name.'_add.php';?></th>
                <th>View <?='v_'.$table_name.'_edit.php';?></th>
            </tr>
            <tr>
                <td>
                    <textarea wrap="auto" rows="50" cols="50">
                    <?=$controller_text?>
                    </textarea>
                </td>
                <td>
                    <textarea rows="50" cols="50">
                    <?=$model_text?>
                    </textarea>
                </td>
                <td>
                    <textarea rows="50" cols="50">
                    <?=$view_list_text?>
                    </textarea>
                </td>
                <td>
                    <textarea rows="50" cols="50">
                    <?=$view_add_text?>
                    </textarea>
                </td>
                <td>
                    <textarea rows="50" cols="50">
                    <?=$view_edit_text?>
                    </textarea>
                </td>
            </tr>
        </table>
        <div style="text-align:right">
            dikembangkan oleh <a target="_blank" href="https://ananghajiana.blogspot.com">ananghajiana.blogspot.com</a>
        </div>
        <script>
            var base_url = window.location.origin;
            // var dataTemp = [];
            function viewCode(){
                window.location = '<?=base_url()?>index.php/main/viewcode/<?=$table_name?>';
            }
             
            // function onclickItemColumn(param){
            //     console.log(param.value);
            //     if(param.checked){
            //         var addObj = [param.value];
            //         var dataConcate = dataTemp.concat(addObj);
            //         dataTemp = dataConcate;
            //     }else{
            //         console.log(dataTemp.indexOf(param.value));
            //         var index = dataTemp.indexOf(param.value);
            //         dataTemp.splice((index),1);
            //     }
                
            //     console.log(dataTemp);
            // }
        </script>
    </body>
</html>