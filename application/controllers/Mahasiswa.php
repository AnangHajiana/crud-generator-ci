                    
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('M_mahasiswa');
	}
	
	function index(){
		$data['list'] = $this->M_mahasiswa->list_mahasiswa();
		$this->load->view('v_mahasiswa',$data);
	}
	function add(){
		$this->load->view('v_mahasiswa_add');
	}
	function addsave(){
		$post = $this->input->post();
		$this->M_mahasiswa->add_mahasiswa($post);
		redirect('mahasiswa');
	}
	function edit(){
		$get = $this->input->get(); 
		$data['row'] = $this->M_mahasiswa->get_mahasiswa_by_id($get['id']);
		$this->load->view('v_mahasiswa_edit',$data);
	}
	function editsave(){
		$post = $this->input->post();
		$this->M_mahasiswa->update_mahasiswa($post);
		redirect('mahasiswa');
	}
	function delete(){
		$post = $this->input->get();
		$this->M_mahasiswa->delete_mahasiswa($post['id']);
		redirect('mahasiswa');
	}
}
		                    