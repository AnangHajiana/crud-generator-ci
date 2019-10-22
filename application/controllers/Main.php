<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
        $data['show_tables'] = $this->db->query('SHOW TABLES;')->result();
		$this->load->view('v_main',$data);
    }
    
    public function selectedtable($table_name){
        $data['show_tables'] = $this->db->query('SHOW TABLES;')->result();
		$data['show_column'] = $this->db->query("DESCRIBE $table_name")->result();
		$data['table_name'] = $table_name;
		$this->load->view('v_main_selection_column',$data);
	}
	
	public function viewcode($table_name){
		$data['show_tables'] = $this->db->query('SHOW TABLES;')->result();
		$data['show_column'] = $this->db->query("DESCRIBE $table_name")->result();
		$data['table_name'] = $table_name;
		$column_primary = $this->get_column_primary($data['show_column']);
		$data['controller_text'] = $this->generate_controller($table_name);
		$data['model_text'] = $this->generate_model($table_name,$column_primary);
		$data['view_list_text'] = $this->generate_view_list($table_name,$column_primary,$data['show_column']);
		$data['view_add_text'] = $this->generate_add_list($table_name,$column_primary,$data['show_column']);
		$data['view_edit_text'] = $this->generate_edit_list($table_name,$column_primary,$data['show_column']);
		$this->load->view('v_main_view_code',$data);
	}

	private function get_column_primary($list_column = []){
		$primary_field = "";
		foreach($list_column as $row){
			if($row->Key == "PRI"){
				$primary_field = $row->Field;
			}
		}
		return $primary_field;
	}

	private function generate_controller($table_name = 'example'){
		
		$class_name = ucfirst($table_name);
		$text_code = "
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ".$class_name." extends CI_Controller {
	function __construct() {
		parent::__construct();
		\$this->load->model('M_".$table_name."');
	}
	
	function index(){
		\$data['list'] = \$this->M_".$table_name."->list_".$table_name."();
		\$this->load->view('v_".$table_name."',\$data);
	}
	function add(){
		\$this->load->view('v_".$table_name."_add');
	}
	function addsave(){
		\$post = \$this->input->post();
		\$this->M_".$table_name."->add_".$table_name."(\$post);
		redirect('".$table_name."');
	}
	function edit(){
		\$get = \$this->input->get(); 
		\$data['row'] = \$this->M_".$table_name."->get_".$table_name."_by_id(\$get['id']);
		\$this->load->view('v_".$table_name."_edit',\$data);
	}
	function editsave(){
		\$post = \$this->input->post();
		\$this->M_".$table_name."->update_".$table_name."(\$post);
		redirect('".$table_name."');
	}
	function delete(){
		\$post = \$this->input->get();
		\$this->M_".$table_name."->delete_".$table_name."(\$post['id']);
		redirect('".$table_name."');
	}
}
		";

		return $text_code;
	}

	private function generate_model($table_name = 'example',$column_primary = 'id'){
		$model_name = "M_".$table_name;
		$text_code = "
<?php
class $model_name extends CI_Model {

	public function list_".$table_name."()
	{
		\$query = \$this->db->get('".$table_name."');
		return \$query->result();
	}

	public function get_".$table_name."_by_id(\$id){
		\$this->db->where('".$column_primary."',\$id);
		\$query = \$this->db->get('".$table_name."');
		return \$query->row();
	}

	public function add_".$table_name."(\$data)
	{
		\$this->db->insert('".$table_name."', \$data);
	}

	public function update_".$table_name."(\$data)
	{
		\$this->db->update('".$table_name."', \$data, array('".$column_primary."' => \$data['id']));
	}

	public function delete_".$table_name."(\$data)
	{
		\$this->db->where('".$column_primary."',\$data['id']);
		\$this->db->delete('".$table_name."');
	}
	
}
		";
		return $text_code;
	}

	private function generate_view_list($table_name = 'example',$column_primary = 'id',$list_column=[]){
		$th_data = "";
		foreach($list_column as $row){
			$th_data .= "\n				<th>".$row->Field."</th>\n";
		}

		$td_data = "";
		foreach($list_column as $row){
			$td_data .= "\n				<td><?=\$row->".$row->Field.";?></td>\n";
		}
		$text_code = "
<html>
	<head>
		<title>READ DATA</title>
		<style>
		a{
			text-decoration:none;
			color:#219229
		}
			#table-style {
				font-family: \"Trebuchet MS\", Arial, Helvetica, sans-serif;
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
		<a href=\"<?=base_url();?>index.php/".$table_name."/add\">(+) Tambah Data</a>
		<table id=\"table-style\">
			<tr>
				".
				$th_data
				."
				<th>Opsi</th>
			</tr>
			<?php foreach(\$list as \$row ){?>
			<tr>
				".$td_data."
				<td>
					<a href=\"<?=base_url();?>index.php/".$table_name."/edit?id=<?=\$row->".$column_primary."?>\">Edit</a> || <a href=\"<?=base_url();?>index.php/".$table_name."/delete?id=<?=\$row->".$column_primary."?>\">delete</a>
				</td>
			</tr>
			<?php } ?>
		</table>
	</body>
</html>
		";
		if($column_primary == ""){
			$text_code = "Tidak dapat membuat view, PRIMARY KEY Pada tabel ".$table_name." tidak ada.";
		}
		return $text_code;
	}

	private function generate_add_list($table_name = 'example',$column_primary = 'id',$list_column=[]){
		$field_data = "";
		foreach($list_column as $row){
			if($row->Key == "PRI"){
				continue;
			}
			$field_data .= "\n				<tr>\n";
			$field_data .= "					<td>".ucfirst(str_replace("_","",$row->Field))."</td>\n";
			$field_data .= "					<td><input type=\"text\" name=\"".$row->Field."\"></td>\n";
			$field_data .= "				</tr>\n";
		}

		$td_data = "";
		$column_primary = "";
		foreach($list_column as $row){
			$td_data .= "\n				<td><?=\$row->".$row->Field.";?></td>\n";
			if($row->Key == "PRI"){
				$column_primary = $row->Field;
			}
		}
		$text_code = "
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
		<a href=\"<?=base_url();?>index.php/".$table_name."\">< Kembali</a>
		<form method=\"post\" action=\"<?=base_url();?>index.php/".$table_name."/addsave\">
			<table>
					".
					$field_data
					."
			</table>
			<input type=\"submit\" value=\"Simpan\">
		</form>
	</body>
</html>
		";
		return $text_code;
	}

	private function generate_edit_list($table_name = 'example',$column_primary = 'id',$list_column){
		$field_data = "";
		foreach($list_column as $row){
			if($row->Key == "PRI"){
					$field_data .= "\n				<input type=\"hidden\" name=\"".$row->Field."\" value=\"<?=\$row->".$row->Field."?>\">";
			}else{
				$field_data .= "\n				<tr>\n";
				$field_data .= "					<td>".ucfirst(str_replace("_","",$row->Field))."</td>\n";
				$field_data .= "					<td><input type=\"text\" name=\"".$row->Field."\" value=\"<?=\$row->".$row->Field."?>\"></td>\n";
				$field_data .= "				</tr>\n";
			}
		}

		$td_data = "";
		foreach($list_column as $row){
			$td_data .= "\n				<td><?=\$row->".$row->Field.";?></td>\n";
		}
		$text_code = "
<html>
	<head>
		<title>EDIT DATA</title>
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
	</head>
	<body>
		<a href=\"<?=base_url();?>index.php/".$table_name."\">< Kembali</a>
		<form method=\"post\" action=\"<?=base_url();?>index.php/".$table_name."/editsave\">
			<table>
					".
					$field_data
					."
			</table>
			<input type=\"submit\" value=\"Simpan\">
		</form>
	</body>
</html>
		";
		return $text_code;
	}
}
