<?php
/**
* Model News
*/
class Mastersupir_model extends CI_Model {
	protected $tabel_supir = 'tb_supir';
    protected $tabel_user = 'tb_user';
    protected $tabel_pelanggan = 'tb_pelanggan';
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
		$query = $this->db->get($this->tabel_supir);
		return $query->result_array();
	}

    public function cariData_User($id){
        $this->db->from($this->tabel_user);
        $this->db->where('id_user', $id);
        $query = $this->db->get();

        return $query->result_array();
    }

	public function cariData_Supir($id){
		$this->db->from($this->tabel_supir);
		$this->db->where('id_supir', $id);
		$query = $this->db->get();

		return $query->result_array();
	}

    public function jumlahData(){
        $query = $this->db->select('*')
                ->from($this->tabel_supir)
                ->get();

        return $query->count();
    }

    public function simpanData($data = array()){
       $this->db->insert($this->tabel_supir, $data);

       return TRUE;
    }

    public function updateData($data = array()){
        $this->db->where('id_supir', $data['id_supir']);
        $this->db->update($this->tabel_supir, $data);

        return TRUE;
    }

    public function hapusData($id){
        $this->db->where('id_supir', $id);
        $this->db->delete($this->tabel_supir);
        if ($this->db->affected_rows() == 1) {

            return TRUE;
        } else {
        	return FALSE;
        }
    }
}