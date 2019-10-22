                    
<?php
class M_mahasiswa extends CI_Model {

	public function list_mahasiswa()
	{
		$query = $this->db->get('mahasiswa');
		return $query->result();
	}

	public function get_mahasiswa_by_id($id){
		$this->db->where('id',$id);
		$query = $this->db->get('mahasiswa');
		return $query->row();
	}

	public function add_mahasiswa($data)
	{
		$this->db->insert('mahasiswa', $data);
	}

	public function update_mahasiswa($data)
	{
		$this->db->update('mahasiswa', $data, array('id' => $data['id']));
	}

	public function delete_mahasiswa($data)
	{
		$this->db->where('id',$data['id']);
		$this->db->delete('mahasiswa');
	}
	
}
		                    