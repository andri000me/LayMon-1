<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supir extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->checkSession();
	}

	private function checkSession(){
		if(!$this->session->userdata('logged_in') === TRUE AND empty($this->session->userdata('user_id'))){
			redirect(base_url(), 'refresh');
			exit();
		}
	}

	public function index(){
		$data['home_url'] = 'supmon';
		$data ['sub_title'] = 'Administrator';
		$data['master'] = 'dashboard';

		$this->load->view('header', $data);
		$this->load->view('dashboard', $data);
		$this->load->view('footer', $data);
	}

	/*
	* Pengiriman Controller
	*/

	public function pengiriman_Data($status = null){
		if ($status === null) {
			show_404();
		} else {
			if ($status === 'created') {
				$data['home_url'] = 'supmon';
				$data ['sub_title'] = 'Administrator';
				$data['master'] = 'pengiriman';
				$data['masterData'] = $status;

				$this->load->view('header', $data);
				$this->load->view('supir/pengiriman/pengiriman_data', $data);
				$this->load->view('footer', $data);
			} elseif ($status === 'confirmed') {
				$data['home_url'] = 'supmon';
				$data ['sub_title'] = 'Administrator';
				$data['master'] = 'pengiriman';
				$data['masterData'] = $status;

				$this->load->view('header', $data);
				$this->load->view('supir/pengiriman/pengiriman_data', $data);
				$this->load->view('footer', $data);
			} elseif ($status === 'add') {
				$data['home_url'] = 'supmon';
				$data ['sub_title'] = 'Administrator';
				$data['master'] = 'pengiriman';

				$data['csrf'] = array(
					'name' => $this->security->get_csrf_token_name(),
					'hash' => $this->security->get_csrf_hash()
				);

				$data['datasMobil'] = $this->mastermobil_model->ambilData();
				$data['datasSupir'] = $this->mastersupir_model->ambilData();
				$data['datasPelanggan'] = $this->masterpelanggan_model->ambilData();

				$this->load->view('header', $data);
				$this->load->view('supir/pengiriman/create', $data);
				$this->load->view('footer', $data);
			} else {
				show_404();
			}
		}
	}

	public function mon_edit($id){
		$data['home_url'] = 'supmon';
		$data ['sub_title'] = 'Administrator';
		$data['master'] = 'pengiriman';

		$data['csrf'] = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);

		$data['datasMobil'] = $this->mastermobil_model->ambilData();
		$data['datasSupir'] = $this->mastersupir_model->ambilData();
		$data['datasPelanggan'] = $this->masterpelanggan_model->ambilData();

		$data['id_mon'] = $id;
		$data['dataPengiriman'] = $this->pengiriman_model->cariData($id)[0];

		$this->load->view('header', $data);
		$this->load->view('supir/pengiriman/update', $data);
		$this->load->view('footer', $data);
	}

	public function mon_delete($id){
		$modelHapus_pengiriman = $this->pengiriman_model->hapusData($id);

		if ($modelHapus_pengiriman) {
			echo "<script>alert('Data pengiriman berhasil dihapus!')</script>";
			redirect('supmon/pengiriman/created', 'refresh');
		} else {
			echo "<script>alert('Data pengiriman gagal dihapus!')</script>";
			redirect('supmon/pengiriman/created', 'refresh');
		}
	}

	public function pengiriman_createdApprove($id){
		$dataApprove = array(
			'id_mon' => intval($id),
			'status_mon' => 'Approved'
		);

		$modelApprove_pengiriman = $this->pengiriman_model->updateData($dataApprove);

		if ($modelApprove_pengiriman) {
			echo "<script>alert('Data pengiriman berhasil diapprove!')</script>";
			redirect('supmon/pengiriman/created', 'refresh');
		} else {
			echo "<script>alert('Data pengiriman gagal diapprove!')</script>";
			redirect('supmon/pengiriman/created', 'refresh');
		}
	}

	public function pengiriman_confirmedApprove($id){
		$dataApprove = array(
			'id_mon' => intval($id),
			'status_mon' => 'Completed'
		);

		$modelApprove_pengiriman = $this->pengiriman_model->updateData($dataApprove);

		if ($modelApprove_pengiriman) {
			echo "<script>alert('Data pengiriman berhasil dikonfirmasi!')</script>";
			redirect('laymon/pengiriman/created', 'refresh');
		} else {
			echo "<script>alert('Data pengiriman gagal dikonfirmasi!')</script>";
			redirect('laymon/pengiriman/created', 'refresh');
		}
	}
}