<?php
/**
* Model News
*/
class Pengiriman_model extends CI_Model {
    protected $tabel_supir = 'tb_supir';
    protected $tabel_mobil = 'tb_mobil';
    protected $tabel_pelanggan = 'tb_pelanggan';
    protected $tabel_pengiriman = 'tb_monitoring';
    protected $tabel_track = 'tb_timeline';

    public function __construct() {
        parent::__construct();
    }

    public function ambilData_Status($status){
        $this->db->where('status_mon', $status);
        $query = $this->db->get($this->tabel_pengiriman);
        return $query->result_array();
    }

    public function ambilData(){
        $query = $this->db->get($this->tabel_pengiriman);
        return $query->result_array();
    }

    public function cariData($id){
        $this->db->from($this->tabel_pengiriman);
        $this->db->where('id_mon', $id);
        $query = $this->db->get();

        return $query->result_array();
    }

    public function dataMap_pelanggan($id){
        $this->db->select('id_mon,end_mon');
        $this->db->from($this->tabel_pengiriman);
        $this->db->where('id_mon', $id);
        $query = $this->db->get();

        return $query->result_array();
    }

    public function cariData_Mobil($id){
        $this->db->select('id_mobil,nopol_mobil');
        $this->db->from($this->tabel_mobil);
        $this->db->where('id_mobil', $id);
        $query = $this->db->get();

        return $query->result_array();
    }

    public function cariData_Supir($id){
        $this->db->select('id_supir,nama_supir');
        $this->db->from($this->tabel_supir);
        $this->db->where('id_supir', $id);
        $query = $this->db->get();

        return $query->result_array();
    }

    public function cariData_Pelanggan($id){
        $this->db->select('id_pelanggan,nama_pelanggan');
        $this->db->from($this->tabel_pelanggan);
        $this->db->where('id_pelanggan', $id);
        $query = $this->db->get();

        return $query->result_array();
    }

    public function jumlahData(){
        $query = $this->db->select('*')
                ->from($this->tabel_pengiriman)
                ->get();

        return $query->count();
    }

    public function simpanTrack($data = array()){
       $this->db->insert($this->tabel_track, $data);

       return TRUE;
    }

    public function simpanData($data = array()){
       $this->db->insert($this->tabel_pengiriman, $data);

       return TRUE;
    }

    public function updateData($data = array()){
        $this->db->where('id_mon', $data['id_mon']);
        $this->db->update($this->tabel_pengiriman, $data);

        return TRUE;
    }

    public function hapusData($id){
        $this->db->where('id_mon', $id);
        $this->db->delete($this->tabel_pengiriman);
        if ($this->db->affected_rows() == 1) {

            return TRUE;
        } else {
            return FALSE;
        }
    }
}