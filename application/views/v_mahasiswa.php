                    
<html>
	<head>
		<title>READ DATA</title>
		<style>
		a{
			text-decoration:none;
			color:#219229
		}
			#table-style {
				font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
				border-collapse: collapse;
				width: 100%;
			}
			
			#table-style td, #table-style th {
				border: 1px solid #ddd;
				padding: 8px;
			}
			
			#table-style tr:nth-child(even){background-color: #f2f2f2;}
			
			#table-style tr:hover {background-color: #ddd;}
			
			#table-style th {
				padding-top: 12px;
				padding-bottom: 12px;
				text-align: left;
				background-color: #4CAF50;
				color: white;
			}
		</style>
	</head>
	<body>
		<a href="<?=base_url();?>index.php/mahasiswa/add">(+) Tambah Data</a>
		<table id="table-style">
			<tr>
				
				<th>id</th>

				<th>nama</th>

				<th>npm</th>

				<th>nilai</th>

				<th>Opsi</th>
			</tr>
			<?php foreach($list as $row ){?>
			<tr>
				
				<td><?=$row->id;?></td>

				<td><?=$row->nama;?></td>

				<td><?=$row->npm;?></td>

				<td><?=$row->nilai;?></td>

				<td>
					<a href="<?=base_url();?>index.php/mahasiswa/edit?id=<?=$row->id?>">Edit</a> || <a href="<?=base_url();?>index.php/mahasiswa/delete?id=<?=$row->id?>">delete</a>
				</td>
			</tr>
			<?php } ?>
		</table>
	</body>
</html>
		                    