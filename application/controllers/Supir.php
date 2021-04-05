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
		if ($this->session->userdata('role') != 'Supir') {
			echo "<script>alert('Halaman ini hanya untuk hak akses supir saja!')</script>";

			if ($this->session->userdata('role') === 'Admin') {
				redirect('laymon', 'refresh');
			} elseif ($this->session->userdata('role') === 'Pelanggan') {
				redirect('pelmon', 'refresh');
			}
		} else {
			$data['home_url'] = 'supmon';
			$data ['sub_title'] = 'Administrator';
			$data['master'] = 'dashboard';

			$this->load->view('header', $data);
			$this->load->view('dashboard', $data);
			$this->load->view('footer', $data);
		}
	}

	/*
	* Pengiriman Controller
	*/

	public function pengiriman_Data($status = null){
		if ($this->session->userdata('role') != 'Supir') {
			echo "<script>alert('Halaman ini hanya untuk hak akses supir saja!')</script>";

			if ($this->session->userdata('role') === 'Admin') {
				redirect('laymon', 'refresh');
			} elseif ($this->session->userdata('role') === 'Pelanggan') {
				redirect('pelmon', 'refresh');
			}
		} else {
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
				} elseif ($status === 'approved') {
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
	}

	public function livemonitoring($id){
		if ($this->session->userdata('role') != 'Supir') {
			echo "<script>alert('Halaman ini hanya untuk hak akses supir saja!')</script>";

			if ($this->session->userdata('role') === 'Admin') {
				redirect('laymon', 'refresh');
			} elseif ($this->session->userdata('role') === 'Pelanggan') {
				redirect('pelmon', 'refresh');
			}
		} else {
			$dataDenny = ($this->pengiriman_model->cariData($id)) ? $this->pengiriman_model->cariData($id)[0] : '';

			if (is_array($dataDenny)) {
				$dataProgress = array(
					'id_mon' => intval($id),
					'status_mon' => 'Progress'
				);

				$modelProgress_pengiriman = $this->pengiriman_model->updateData($dataProgress);

				if ($modelProgress_pengiriman) {
					$data['home_url'] = 'supmon';
					$data ['sub_title'] = 'Administrator';
					$data['master'] = 'pengiriman-track';

					$data['csrf'] = array(
						'name' => $this->security->get_csrf_token_name(),
						'hash' => $this->security->get_csrf_hash()
					);

					$data['id_mon'] = $id;

					$this->load->view('header', $data);
					$this->load->view('supir/pengiriman/track', $data);
					$this->load->view('footer', $data);
				} else {
					echo "<script>alert('Data pengiriman gagal diupdate!')</script>";
					redirect('supmon/pengiriman/approved', 'refresh');
				}
			} else {
				echo "<script>alert('Data tidak ditemukan!')</script>";
				redirect('supmon/pengiriman/approved', 'refresh');
			}
		}
	}

	public function mon_edit($id){
		if ($this->session->userdata('role') != 'Supir') {
			echo "<script>alert('Halaman ini hanya untuk hak akses supir saja!')</script>";

			if ($this->session->userdata('role') === 'Admin') {
				redirect('laymon', 'refresh');
			} elseif ($this->session->userdata('role') === 'Pelanggan') {
				redirect('pelmon', 'refresh');
			}
		} else {
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
	}

	public function mon_delete($id){
		if ($this->session->userdata('role') != 'Supir') {
			echo "<script>alert('Halaman ini hanya untuk hak akses supir saja!')</script>";

			if ($this->session->userdata('role') === 'Admin') {
				redirect('laymon', 'refresh');
			} elseif ($this->session->userdata('role') === 'Pelanggan') {
				redirect('pelmon', 'refresh');
			}
		} else {
			$modelHapus_pengiriman = $this->pengiriman_model->hapusData($id);

			if ($modelHapus_pengiriman) {
				echo "<script>alert('Data pengiriman berhasil dihapus!')</script>";
				redirect('supmon/pengiriman/created', 'refresh');
			} else {
				echo "<script>alert('Data pengiriman gagal dihapus!')</script>";
				redirect('supmon/pengiriman/created', 'refresh');
			}
		}
	}

	public function pengiriman_arrivedApprove($id){
		if ($this->session->userdata('role') != 'Supir') {
			echo "<script>alert('Halaman ini hanya untuk hak akses supir saja!')</script>";

			if ($this->session->userdata('role') === 'Admin') {
				redirect('laymon', 'refresh');
			} elseif ($this->session->userdata('role') === 'Pelanggan') {
				redirect('pelmon', 'refresh');
			}
		} else {
			$dataArrived = array(
				'id_mon' => intval($id),
				'status_mon' => 'Arrived'
			);

			$modelArrived_pengiriman = $this->pengiriman_model->updateData($dataArrived);

			if ($modelArrived_pengiriman) {
				echo "<script>alert('Data pengiriman berhasil diupdate!')</script>";
				redirect('supmon/pengiriman/approved', 'refresh');
			} else {
				echo "<script>alert('Data pengiriman gagal diupdate!')</script>";
				redirect('supmon/pengiriman/approved', 'refresh');
			}
		}
	}
}