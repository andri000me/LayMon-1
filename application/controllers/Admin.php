<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
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
		if ($this->session->userdata('role') != 'Admin') {
			echo "<script>alert('Halaman ini hanya untuk hak akses admin saja!')</script>";
			
			if ($this->session->userdata('role') === 'Supir') {
				redirect('supmon', 'refresh');
			} elseif ($this->session->userdata('role') === 'Pelanggan') {
				redirect('pelmon', 'refresh');
			}
		} else {
			$data['home_url'] = 'laymon';
			$data ['sub_title'] = 'Administrator';
			$data['master'] = 'dashboard';

			$this->load->view('header', $data);
			$this->load->view('dashboard', $data);
			$this->load->view('footer', $data);
		}
	}

	/*
	* Master Controller - Mobil
	*/

	public function mobil_read(){
		if ($this->session->userdata('role') != 'Admin') {
			echo "<script>alert('Halaman ini hanya untuk hak akses admin saja!')</script>";
			
			if ($this->session->userdata('role') === 'Supir') {
				redirect('supmon', 'refresh');
			} elseif ($this->session->userdata('role') === 'Pelanggan') {
				redirect('pelmon', 'refresh');
			}
		} else {
			$data['home_url'] = 'laymon';
			$data ['sub_title'] = 'Administrator';
			$data['master'] = 'mobil';

			$this->load->view('header', $data);
			$this->load->view('admin/mobil/read', $data);
			$this->load->view('footer', $data);
		}
	}

	public function mobil_create(){
		if ($this->session->userdata('role') != 'Admin') {
			echo "<script>alert('Halaman ini hanya untuk hak akses admin saja!')</script>";
			
			if ($this->session->userdata('role') === 'Supir') {
				redirect('supmon', 'refresh');
			} elseif ($this->session->userdata('role') === 'Pelanggan') {
				redirect('pelmon', 'refresh');
			}
		} else {
			$data['home_url'] = 'laymon';
			$data ['sub_title'] = 'Administrator';
			$data['master'] = 'mobil';

			$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
			);

			$this->load->view('header', $data);
			$this->load->view('admin/mobil/create', $data);
			$this->load->view('footer', $data);
		}
	}

	public function mobil_update($id){
		if ($this->session->userdata('role') != 'Admin') {
			echo "<script>alert('Halaman ini hanya untuk hak akses admin saja!')</script>";
			
			if ($this->session->userdata('role') === 'Supir') {
				redirect('supmon', 'refresh');
			} elseif ($this->session->userdata('role') === 'Pelanggan') {
				redirect('pelmon', 'refresh');
			}
		} else {
			$data['home_url'] = 'laymon';
			$data ['sub_title'] = 'Administrator';
			$data['master'] = 'mobil';

			$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
			);

			$data['id_mobil'] = $id;
			$data['dataMobil'] = $this->mastermobil_model->cariData($id)[0];

			$this->load->view('header', $data);
			$this->load->view('admin/mobil/update', $data);
			$this->load->view('footer', $data);
		}
	}

	public function mobil_delete($id){
		if ($this->session->userdata('role') != 'Admin') {
			echo "<script>alert('Halaman ini hanya untuk hak akses admin saja!')</script>";
			
			if ($this->session->userdata('role') === 'Supir') {
				redirect('supmon', 'refresh');
			} elseif ($this->session->userdata('role') === 'Pelanggan') {
				redirect('pelmon', 'refresh');
			}
		} else {
			$modelHapus_mobil = $this->mastermobil_model->hapusData($id);

			if ($modelHapus_mobil) {
				echo "<script>alert('Data mobil berhasil dihapus!')</script>";
				redirect('laymon/mobil', 'refresh');
			} else {
				echo "<script>alert('Data mobil gagal dihapus!')</script>";
				redirect('laymon/mobil', 'refresh');
			}
		}
	}

	/*
	* Master Controller - User
	*/

	public function user_read(){
		if ($this->session->userdata('role') != 'Admin') {
			echo "<script>alert('Halaman ini hanya untuk hak akses admin saja!')</script>";
			
			if ($this->session->userdata('role') === 'Supir') {
				redirect('supmon', 'refresh');
			} elseif ($this->session->userdata('role') === 'Pelanggan') {
				redirect('pelmon', 'refresh');
			}
		} else {
			$data['home_url'] = 'laymon';
			$data ['sub_title'] = 'Administrator';
			$data['master'] = 'user';

			$this->load->view('header', $data);
			$this->load->view('admin/user/read', $data);
			$this->load->view('footer', $data);
		}
	}

	public function user_create(){
		if ($this->session->userdata('role') != 'Admin') {
			echo "<script>alert('Halaman ini hanya untuk hak akses admin saja!')</script>";
			
			if ($this->session->userdata('role') === 'Supir') {
				redirect('supmon', 'refresh');
			} elseif ($this->session->userdata('role') === 'Pelanggan') {
				redirect('pelmon', 'refresh');
			}
		} else {
			$data['home_url'] = 'laymon';
			$data ['sub_title'] = 'Administrator';
			$data['master'] = 'user';

			$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
			);

			$this->load->view('header', $data);
			$this->load->view('admin/user/create', $data);
			$this->load->view('footer', $data);
		}
	}

	public function user_update($id){
		if ($this->session->userdata('role') != 'Admin') {
			echo "<script>alert('Halaman ini hanya untuk hak akses admin saja!')</script>";
			
			if ($this->session->userdata('role') === 'Supir') {
				redirect('supmon', 'refresh');
			} elseif ($this->session->userdata('role') === 'Pelanggan') {
				redirect('pelmon', 'refresh');
			}
		} else {
			$data['home_url'] = 'laymon';
			$data ['sub_title'] = 'Administrator';
			$data['master'] = 'user';

			$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
			);

			$data['id_user'] = $id;
			$data['dataUser'] = $this->user_model->cariData($id)[0];

			$this->load->view('header', $data);
			$this->load->view('admin/user/update', $data);
			$this->load->view('footer', $data);
		}
	}

	public function user_delete($id){
		if ($this->session->userdata('role') != 'Admin') {
			echo "<script>alert('Halaman ini hanya untuk hak akses admin saja!')</script>";
			
			if ($this->session->userdata('role') === 'Supir') {
				redirect('supmon', 'refresh');
			} elseif ($this->session->userdata('role') === 'Pelanggan') {
				redirect('pelmon', 'refresh');
			}
		} else {
			$validasiAcc = $this->user_model->validasiAccount($id);

			if ($validasiAcc > 0) {
				$modelHapus_user = $this->user_model->hapusData($id);

				if ($modelHapus_user) {
					echo "<script>alert('Data user berhasil dihapus!')</script>";
					redirect('laymon/user', 'refresh');
				} else {
					echo "<script>alert('Data user gagal dihapus!')</script>";
					redirect('laymon/user', 'refresh');
				}
			} else {
				echo "<script>alert('Diharapkan menghapus data pelanggan atau supir terlebih dahulu yang menggunakan user ini.')</script>";
				redirect('laymon/user', 'refresh');
			}
		}
	}

	public function user_resetPass($id){
		if ($this->session->userdata('role') != 'Admin') {
			echo "<script>alert('Halaman ini hanya untuk hak akses admin saja!')</script>";
			
			if ($this->session->userdata('role') === 'Supir') {
				redirect('supmon', 'refresh');
			} elseif ($this->session->userdata('role') === 'Pelanggan') {
				redirect('pelmon', 'refresh');
			}
		} else {
			$modelGetU_user = $this->user_model->getUsername($id);

			$dataReset = array('username_user' => $modelGetU_user);
			$modelReset_user = $this->user_model->resetPass($dataReset);

			if ($modelReset_user) {
				echo "<script>alert('Password user berhasil direset!')</script>";
				redirect('laymon/user', 'refresh');
			} else {
				echo "<script>alert('Password user gagal direset!')</script>";
				redirect('laymon/user', 'refresh');
			}
		}
	}

	/*
	* Master Controller - Supir
	*/

	public function supir_read(){
		if ($this->session->userdata('role') != 'Admin') {
			echo "<script>alert('Halaman ini hanya untuk hak akses admin saja!')</script>";
			
			if ($this->session->userdata('role') === 'Supir') {
				redirect('supmon', 'refresh');
			} elseif ($this->session->userdata('role') === 'Pelanggan') {
				redirect('pelmon', 'refresh');
			}
		} else {
			$data['home_url'] = 'laymon';
			$data ['sub_title'] = 'Administrator';
			$data['master'] = 'supir';

			$this->load->view('header', $data);
			$this->load->view('admin/supir/read', $data);
			$this->load->view('footer', $data);
		}
	}

	public function supir_create(){
		if ($this->session->userdata('role') != 'Admin') {
			echo "<script>alert('Halaman ini hanya untuk hak akses admin saja!')</script>";
			
			if ($this->session->userdata('role') === 'Supir') {
				redirect('supmon', 'refresh');
			} elseif ($this->session->userdata('role') === 'Pelanggan') {
				redirect('pelmon', 'refresh');
			}
		} else {
			if ($this->user_model->akunTersedia_supirNum() === 0 OR $this->user_model->akunTersedia_supirNum() < 1) {
				echo "<script>alert('Data account user untuk Supir tidak tersedia, Mohon membuat akun dengan hak akses supir terlebih dahulu.')</script>";
				redirect('laymon/supir', 'refresh');
			} else {
				$data['home_url'] = 'laymon';
				$data ['sub_title'] = 'Administrator';
				$data['master'] = 'supir';

				$data['dataAkunTersedia'] = $this->user_model->akunTersedia_supir();

				$data['csrf'] = array(
					'name' => $this->security->get_csrf_token_name(),
					'hash' => $this->security->get_csrf_hash()
				);

				$this->load->view('header', $data);
				$this->load->view('admin/supir/create', $data);
				$this->load->view('footer', $data);
			}
		}
	}

	public function supir_update($id){
		if ($this->session->userdata('role') != 'Admin') {
			echo "<script>alert('Halaman ini hanya untuk hak akses admin saja!')</script>";
			
			if ($this->session->userdata('role') === 'Supir') {
				redirect('supmon', 'refresh');
			} elseif ($this->session->userdata('role') === 'Pelanggan') {
				redirect('pelmon', 'refresh');
			}
		} else {
			$data['home_url'] = 'laymon';
			$data ['sub_title'] = 'Administrator';
			$data['master'] = 'supir';

			$data['dataAkunTersedia'] = $this->user_model->akunTersedia_supir();

			$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
			);

			$data['id_supir'] = $id;
			$data['dataSupir'] = $this->mastersupir_model->cariData_Supir($id)[0];

			$this->load->view('header', $data);
			$this->load->view('admin/supir/update', $data);
			$this->load->view('footer', $data);
		}
	}

	public function supir_updateUser($id){
		if ($this->session->userdata('role') != 'Admin') {
			echo "<script>alert('Halaman ini hanya untuk hak akses admin saja!')</script>";
			
			if ($this->session->userdata('role') === 'Supir') {
				redirect('supmon', 'refresh');
			} elseif ($this->session->userdata('role') === 'Pelanggan') {
				redirect('pelmon', 'refresh');
			}
		} else {
			$data['home_url'] = 'laymon';
			$data ['sub_title'] = 'Administrator';
			$data['master'] = 'supir';

			$data['dataAkunTersedia'] = $this->user_model->akunTersedia_supir();

			$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
			);

			$data['id_supir'] = $id;
			$data['dataSupir'] = $this->mastersupir_model->cariData_Supir($id)[0];

			$this->load->view('header', $data);
			$this->load->view('admin/supir/updateUser', $data);
			$this->load->view('footer', $data);
		}
	}

	public function supir_delete($id){
		if ($this->session->userdata('role') != 'Admin') {
			echo "<script>alert('Halaman ini hanya untuk hak akses admin saja!')</script>";
			
			if ($this->session->userdata('role') === 'Supir') {
				redirect('supmon', 'refresh');
			} elseif ($this->session->userdata('role') === 'Pelanggan') {
				redirect('pelmon', 'refresh');
			}
		} else {
			$modelHapus_supir = $this->mastersupir_model->hapusData($id);

			if ($modelHapus_supir) {
				echo "<script>alert('Data Supir berhasil dihapus!')</script>";
				redirect('laymon/supir', 'refresh');
			} else {
				echo "<script>alert('Data Supir gagal dihapus!')</script>";
				redirect('laymon/supir', 'refresh');
			}
		}
	}

	/*
	* Master Controller - Pelanggan
	*/

	public function pelanggan_read(){
		if ($this->session->userdata('role') != 'Admin') {
			echo "<script>alert('Halaman ini hanya untuk hak akses admin saja!')</script>";
			
			if ($this->session->userdata('role') === 'Supir') {
				redirect('supmon', 'refresh');
			} elseif ($this->session->userdata('role') === 'Pelanggan') {
				redirect('pelmon', 'refresh');
			}
		} else {
			$data['home_url'] = 'laymon';
			$data ['sub_title'] = 'Administrator';
			$data['master'] = 'pelanggan';

			$this->load->view('header', $data);
			$this->load->view('admin/pelanggan/read', $data);
			$this->load->view('footer', $data);
		}
	}

	public function pelanggan_create(){
		if ($this->session->userdata('role') != 'Admin') {
			echo "<script>alert('Halaman ini hanya untuk hak akses admin saja!')</script>";
			
			if ($this->session->userdata('role') === 'Supir') {
				redirect('supmon', 'refresh');
			} elseif ($this->session->userdata('role') === 'Pelanggan') {
				redirect('pelmon', 'refresh');
			}
		} else {
			if ($this->user_model->akunTersedia_pelangganNum() === 0 OR $this->user_model->akunTersedia_pelangganNum() < 1) {
				echo "<script>alert('Data account user untuk Supir tidak tersedia, Mohon membuat akun dengan hak akses pelanggan terlebih dahulu.')</script>";
				redirect('laymon/pelanggan', 'refresh');
			} else {
				$data['home_url'] = 'laymon';
				$data ['sub_title'] = 'Administrator';
				$data['master'] = 'pelanggan';

				$data['dataAkunTersedia'] = $this->user_model->akunTersedia_pelanggan();

				$data['csrf'] = array(
					'name' => $this->security->get_csrf_token_name(),
					'hash' => $this->security->get_csrf_hash()
				);

				$this->load->view('header', $data);
				$this->load->view('admin/pelanggan/create', $data);
				$this->load->view('footer', $data);
			}
		}
	}

	public function pelanggan_update($id){
		if ($this->session->userdata('role') != 'Admin') {
			echo "<script>alert('Halaman ini hanya untuk hak akses admin saja!')</script>";
			
			if ($this->session->userdata('role') === 'Supir') {
				redirect('supmon', 'refresh');
			} elseif ($this->session->userdata('role') === 'Pelanggan') {
				redirect('pelmon', 'refresh');
			}
		} else {
			$data['home_url'] = 'laymon';
			$data ['sub_title'] = 'Administrator';
			$data['master'] = 'pelanggan';

			$data['dataAkunTersedia'] = $this->user_model->akunTersedia_supir();

			$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
			);

			$data['id_pelanggan'] = $id;
			$data['dataPelanggan'] = $this->masterpelanggan_model->cariData_Pelanggan($id)[0];

			$this->load->view('header', $data);
			$this->load->view('admin/pelanggan/update', $data);
			$this->load->view('footer', $data);
		}
	}

	public function pelanggan_updateUser($id){
		if ($this->session->userdata('role') != 'Admin') {
			echo "<script>alert('Halaman ini hanya untuk hak akses admin saja!')</script>";
			
			if ($this->session->userdata('role') === 'Supir') {
				redirect('supmon', 'refresh');
			} elseif ($this->session->userdata('role') === 'Pelanggan') {
				redirect('pelmon', 'refresh');
			}
		} else {
			$data['home_url'] = 'laymon';
			$data ['sub_title'] = 'Administrator';
			$data['master'] = 'pelanggan';

			$data['dataAkunTersedia'] = $this->user_model->akunTersedia_pelanggan();

			$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
			);

			$data['id_pelanggan'] = $id;
			$data['dataPelanggan'] = $this->masterpelanggan_model->cariData_Pelanggan($id)[0];

			$this->load->view('header', $data);
			$this->load->view('admin/pelanggan/updateUser', $data);
			$this->load->view('footer', $data);
		}
	}

	public function pelanggan_delete($id){
		if ($this->session->userdata('role') != 'Admin') {
			echo "<script>alert('Halaman ini hanya untuk hak akses admin saja!')</script>";
			
			if ($this->session->userdata('role') === 'Supir') {
				redirect('supmon', 'refresh');
			} elseif ($this->session->userdata('role') === 'Pelanggan') {
				redirect('pelmon', 'refresh');
			}
		} else {
			$modelHapus_pelanggan = $this->masterpelanggan_model->hapusData($id);

			if ($modelHapus_pelanggan) {
				echo "<script>alert('Data Pelanggan berhasil dihapus!')</script>";
				redirect('laymon/pelanggan', 'refresh');
			} else {
				echo "<script>alert('Data Pelanggan gagal dihapus!')</script>";
				redirect('laymon/pelanggan', 'refresh');
			}
		}
	}

	/*
	* Pengiriman Controller
	*/

	public function pengiriman_Data($status = null){
		if ($this->session->userdata('role') != 'Admin') {
			echo "<script>alert('Halaman ini hanya untuk hak akses admin saja!')</script>";
			
			if ($this->session->userdata('role') === 'Supir') {
				redirect('supmon', 'refresh');
			} elseif ($this->session->userdata('role') === 'Pelanggan') {
				redirect('pelmon', 'refresh');
			}
		} else {
			if ($status === null) {
				show_404();
			} else {
				if ($status === 'created') {
					$data['home_url'] = 'laymon';
					$data ['sub_title'] = 'Administrator';
					$data['master'] = 'pengiriman';
					$data['masterData'] = $status;

					$this->load->view('header', $data);
					$this->load->view('admin/pengiriman/pengiriman_data', $data);
					$this->load->view('footer', $data);
				} elseif ($status === 'confirmed') {
					$data['home_url'] = 'laymon';
					$data ['sub_title'] = 'Administrator';
					$data['master'] = 'pengiriman';
					$data['masterData'] = $status;

					$this->load->view('header', $data);
					$this->load->view('admin/pengiriman/pengiriman_data', $data);
					$this->load->view('footer', $data);
				} else {
					show_404();
				}
			}
		}
	}

	public function pengiriman_createdApprove($id){
		if ($this->session->userdata('role') != 'Admin') {
			echo "<script>alert('Halaman ini hanya untuk hak akses admin saja!')</script>";
			
			if ($this->session->userdata('role') === 'Supir') {
				redirect('supmon', 'refresh');
			} elseif ($this->session->userdata('role') === 'Pelanggan') {
				redirect('pelmon', 'refresh');
			}
		} else {
			$dataApprove = array(
				'id_mon' => intval($id),
				'status_mon' => 'Approved'
			);

			$modelApprove_pengiriman = $this->pengiriman_model->updateData($dataApprove);

			if ($modelApprove_pengiriman) {
				echo "<script>alert('Data pengiriman berhasil diapprove!')</script>";
				redirect('laymon/pengiriman/created', 'refresh');
			} else {
				echo "<script>alert('Data pengiriman gagal diapprove!')</script>";
				redirect('laymon/pengiriman/created', 'refresh');
			}
		}
	}

	public function pengiriman_confirmedApprove($id){
		if ($this->session->userdata('role') != 'Admin') {
			echo "<script>alert('Halaman ini hanya untuk hak akses admin saja!')</script>";
			
			if ($this->session->userdata('role') === 'Supir') {
				redirect('supmon', 'refresh');
			} elseif ($this->session->userdata('role') === 'Pelanggan') {
				redirect('pelmon', 'refresh');
			}
		} else {
			$dataApprove = array(
				'id_mon' => intval($id),
				'status_mon' => 'Completed'
			);

			$modelApprove_pengiriman = $this->pengiriman_model->updateData($dataApprove);

			if ($modelApprove_pengiriman) {
				echo "<script>alert('Data pengiriman berhasil dikonfirmasi!')</script>";
				redirect('laymon/pengiriman/confirmed', 'refresh');
			} else {
				echo "<script>alert('Data pengiriman gagal dikonfirmasi!')</script>";
				redirect('laymon/pengiriman/confirmed', 'refresh');
			}
		}
	}
}