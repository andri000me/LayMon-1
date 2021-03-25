<?php
/**
* Model News
*/
class Mastermobil_model extends CI_Model {
	protected $tabel = 'tb_mobil';
	/**
	 * __construct function.
	 *
	 * @access public
	 * @return void
	 */

	public function __construct() {
		parent::__construct();
	}

	public function ambilData(){
		$query = $this->db->get($this->tabel);
		return $query->result_array();
	}

	public function cariData($id){
		$this->db->from($this->tabel);
		$this->db->where('id_mobil', $id);
		$query = $this->db->get();

		return $query->result_array();
	}

    public function jumlahData(){
        $query = $this->db->select('*')
                ->from($this->tabel)
                ->get();

        return $query->num_rows();
    }

    public function simpanData($data = array()){
       $this->db->insert($this->tabel, $data);

       return TRUE;
    }

    public function updateData($data = array()){
        $this->db->where('id_mobil', $data['id_mobil']);
        $this->db->update($this->tabel, $data);

        return TRUE;
    }

    public function hapusData($id){
        $this->db->where('id_mobil', $id);
        $this->db->delete($this->tabel);
        if ($this->db->affected_rows() == 1) {

            return TRUE;
        } else {
        	return FALSE;
        }
    }
}