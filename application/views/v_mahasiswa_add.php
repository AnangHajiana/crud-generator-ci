                    
<html>
	<head>
		<title>CREATE DATA</title>
	</head>
	<style>
	a{
		text-decoration:none;
		color:#219229
	}
	input[type=text] {
		width: 100%;
		padding: 12px 20px;
		margin: 8px 0;
		display: inline-block;
		border: 1px solid #ccc;
		border-radius: 4px;
		box-sizing: border-box;
	}

	input[type=submit] {
		background-color: #4CAF50;
		color: white;
		padding: 14px 20px;
		margin: 8px 0;
		border: none;
		border-radius: 4px;
		cursor: pointer;
	}
	
	input[type=submit]:hover {
		background-color: #45a049;
	}
	
	div {
		border-radius: 5px;
		background-color: #f2f2f2;
		padding: 20px;
	}
	</style>
	<body>
		<a href="<?=base_url();?>index.php/mahasiswa">< Kembali</a>
		<form method="post" action="<?=base_url();?>index.php/mahasiswa/addsave">
			<table>
					
				<tr>
					<td>Nama</td>
					<td><input type="text" name="nama"></td>
				</tr>

				<tr>
					<td>Npm</td>
					<td><input type="text" name="npm"></td>
				</tr>

				<tr>
					<td>Nilai</td>
					<td><input type="text" name="nilai"></td>
				</tr>

			</table>
			<input type="submit" value="Simpan">
		</form>
	</body>
</html>
		                    