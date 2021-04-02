<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {
	protected $result = array();

	public function __construct() {
		parent::__construct();
		header('Content-Type: application/json');

		$this->result['deskripsi'] = "Laymon sudah didukung oleh API Laymon ".$this->config->item('laymon_version');

		$this->checkSession();

		$this->form_validation->set_message('customValidation', '{field} must have letter, comma, dot and space in character.');
		$this->form_validation->set_message('customAlamat', '{field} must have letter, comma, dot, space and slash in character.');
		$this->form_validation->set_message('customKapasitas', '{field} must consist of one of Besar, Sedang and Kecil.');
	}

	private function checkSession(){
		if(!$this->session->userdata('logged_in') === TRUE AND empty($this->session->userdata('user_id'))){
			exit();

			$this->result['message'] = 'Maaf anda tidak memenuhi syarat';
			$this->result['error'] = true;
		}
	}

	public function index(){
		echo json_encode($this->result, JSON_PRETTY_PRINT);
	}

	public function customValidation($str) {
		if (preg_match('/^[\w,. \/]+$/i', $str)){
	        return true;
	    }
	}

	public function customAlamat($str) {
		if (preg_match('/^[\w,. \/-]+$/i', $str)){
	        return true;
	    }
	}

	public function customKapasitas($str) {
		if ($str === 'Besar' OR $str === 'Sedang' OR $str === 'Kecil'){
	        return true;
	    }
	}

	public function customLevel($str) {
		if ($str === 'Admin' OR $str === 'Supir' OR $str === 'Pelanggan'){
	        return true;
	    }
	}

	/*
	* Profile
	*/

	public function profile(){
		$this->checkSession();

		// set validation rules
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');

		if ($this->form_validation->run() != false) {
			$id_user = intval($this->session->userdata('user_id'));
			$password_user = addslashes($this->input->post('password'));

			$dataInput_profile = array(
				'id_user' => $id_user,
				'password_user' => $password_user
			);

			$modelInput_profile = $this->user_model->updatePass($dataInput_profile);

			if ($modelInput_profile) {
				$this->result['error'] = false;
				$this->result['message'] = 'Data password berhasil diupdate!';
				$this->result['data'] = $dataInput_profile;
				$this->result['redirect'] = base_url('laymon/profile');
			} else {
				$this->result['error'] = true;
				$this->result['message'] = 'Data password gagal diupdate!';
				$this->result['data'] = $dataInput_profile;
				$this->result['redirect'] = base_url('laymon/profile');
			}
		} else {
			$this->result['error'] = true;
			$this->result['errorMsg'] = $this->form_validation->error_array();
			$this->result['message'] = 'Data password gagal diupdate!';
			$this->result['data'] = null;
			$this->result['redirect'] = base_url('laymon/profile');
		}

		echo json_encode($this->result, JSON_PRETTY_PRINT);
	}

	/*
	* Master Controller - Mobil
	*/

	public function mastermobil_create(){
		$this->checkSession();

		// set validation rules
		$this->form_validation->set_rules('nopol', 'No Polisi', 'trim|required|alpha_numeric_spaces|max_length[10]|is_unique[tb_mobil.nopol_mobil]');
		$this->form_validation->set_rules('merk', 'Merk', 'trim|required|alpha_numeric_spaces|max_length[70]');
		$this->form_validation->set_rules('kapasitas', 'Kapasitas', 'trim|required|callback_customKapasitas');

		if ($this->form_validation->run() != false) {
			$nopol_mobil = $this->input->post('nopol');
			$merk_mobil = $this->input->post('merk');
			$kapasitas_mobil = $this->input->post('kapasitas');

			$dataInput_mobil = array(
				'nopol_mobil' => $nopol_mobil,
				'merk_mobil' => $merk_mobil,
				'kapasitas_mobil' => $kapasitas_mobil
			);

			$modelInput_mobil = $this->mastermobil_model->simpanData($dataInput_mobil);

			if ($modelInput_mobil) {
				$this->result['error'] = false;
				$this->result['message'] = 'Data mobil berhasil disimpan!';
				$this->result['data'] = $dataInput_mobil;
				$this->result['redirect'] = base_url('laymon/mobil');
			} else {
				$this->result['error'] = true;
				$this->result['message'] = 'Data mobil gagal disimpan!';
				$this->result['data'] = $dataInput_mobil;
				$this->result['redirect'] = base_url('laymon/mobil');
			}
		} else {
			$this->result['error'] = true;
			$this->result['errorMsg'] = $this->form_validation->error_array();
			$this->result['message'] = 'Data mobil gagal disimpan!';
			$this->result['data'] = null;
			$this->result['redirect'] = base_url('laymon/mobil');
		}

		echo json_encode($this->result, JSON_PRETTY_PRINT);
	}

	public function mastermobil_read(){
		$this->checkSession();
		$modelRead_mobil = $this->mastermobil_model->ambilData();

		if ($modelRead_mobil) {
			$this->result['error'] = false;
			$this->result['message'] = 'Data Mobil';

			foreach ($modelRead_mobil as $valueMobil) {
				$dataMobil[] = array(
					'id_mobil' => $valueMobil['id_mobil'],
					'nopol_mobil' => $valueMobil['nopol_mobil'],
					'merk_mobil' => $valueMobil['merk_mobil'],
					'kapasitas_mobil' => $valueMobil['kapasitas_mobil'],
					'action' => '<center><a href="'.base_url('laymon/mobil/view/'.$valueMobil['id_mobil']).'"><button type="button" class="btn btn-sm btn-warning btn-flat">Ubah</button></a> <a href="'.base_url('laymon/mobil/delete/'.$valueMobil['id_mobil']).'"><button type="button" class="btn btn-sm btn-danger btn-flat">Hapus</button></a></center>',
				);
			}
			$this->result['data'] = $dataMobil;
		} else {
			$this->result['error'] = true;
			$this->result['message'] = 'Data Mobil tidak ditemukan';
			$this->result['data'] = null;
		}

		echo json_encode($this->result, JSON_PRETTY_PRINT);
	}

	public function mastermobil_update(){
		$this->checkSession();

		// set validation rules
		$this->form_validation->set_rules('id', 'Mobil ID', 'trim|required|numeric');
		$this->form_validation->set_rules('nopol', 'No Polisi', 'trim|required|alpha_numeric_spaces|max_length[10]|is_unique[tb_mobil.nopol_mobil]');
		$this->form_validation->set_rules('merk', 'Merk', 'trim|required|alpha_numeric_spaces|max_length[70]');
		$this->form_validation->set_rules('kapasitas', 'Kapasitas', 'trim|required|callback_customKapasitas');

		if ($this->form_validation->run() != false) {
			$id_mobil = $this->input->post('id');
			$nopol_mobil = $this->input->post('nopol');
			$merk_mobil = $this->input->post('merk');
			$kapasitas_mobil = $this->input->post('kapasitas');

			$dataUpdate_mobil = array(
				'id_mobil' => $id_mobil,
				'nopol_mobil' => $nopol_mobil,
				'merk_mobil' => $merk_mobil,
				'kapasitas_mobil' => $kapasitas_mobil
			);

			$modelUpdate_mobil = $this->mastermobil_model->updateData($dataUpdate_mobil);

			if ($modelUpdate_mobil) {
				$this->result['error'] = false;
				$this->result['message'] = 'Data mobil berhasil diupdate!';
				$this->result['data'] = $dataUpdate_mobil;
				$this->result['redirect'] = base_url('laymon/mobil');
			} else {
				$this->result['error'] = true;
				$this->result['message'] = 'Data mobil gagal diupdate!';
				$this->result['data'] = $dataUpdate_mobil;
				$this->result['redirect'] = base_url('laymon/mobil');
			}
		} else {
			$this->result['error'] = true;
			$this->result['errorMsg'] = $this->form_validation->error_array();
			$this->result['message'] = 'Data mobil gagal disimpan!';
			$this->result['data'] = null;
			$this->result['redirect'] = base_url('laymon/mobil');
		}

		echo json_encode($this->result, JSON_PRETTY_PRINT);
	}

	/*
	* Master Controller - User
	*/

	public function masteruser_create(){
		$this->checkSession();

		// set validation rules
		$this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_numeric|max_length[20]|is_unique[tb_user.username_user]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
		$this->form_validation->set_rules('level', 'Level', 'trim|required|callback_customLevel');

		if ($this->form_validation->run() != false) {
			$username_user = $this->input->post('username');
			$password_user = $this->input->post('password');
			$level_user = $this->input->post('level');

			$dataInput_user = array(
				'username_user' => $username_user,
				'password_user' => $password_user,
				'level_user' => $level_user
			);

			$modelInput_user = $this->user_model->create_user($dataInput_user);

			if ($modelInput_user) {
				$this->result['error'] = false;
				$this->result['message'] = 'Data user berhasil disimpan!';
				$this->result['data'] = $dataInput_user;
				$this->result['redirect'] = base_url('laymon/user');
			} else {
				$this->result['error'] = true;
				$this->result['message'] = 'Data user gagal disimpan!';
				$this->result['data'] = $dataInput_user;
				$this->result['redirect'] = base_url('laymon/user');
			}
		} else {
			$this->result['error'] = true;
			$this->result['errorMsg'] = $this->form_validation->error_array();
			$this->result['message'] = 'Data user gagal disimpan!';
			$this->result['data'] = null;
			$this->result['redirect'] = base_url('laymon/user');
		}

		echo json_encode($this->result, JSON_PRETTY_PRINT);
	}

	public function masteruser_read(){
		$this->checkSession();
		$modelRead_user = $this->user_model->ambilData();

		if ($modelRead_user) {
			$this->result['error'] = false;
			$this->result['message'] = 'Data Mobil';

			foreach ($modelRead_user as $valueUser) {
				$dataUser[] = array(
					'id_user' => $valueUser['id_user'],
					'username_user' => $valueUser['username_user'],
					'level_user' => '<span class="badge badge-info">'.$valueUser['level_user'].'</span>',
					'tglbuat_user' => $valueUser['tglbuat_user'],
					'action' => '<center><a href="'.base_url('laymon/user/view/'.$valueUser['id_user']).'"><button type="button" class="btn btn-sm btn-warning btn-flat">Ubah</button></a> <a href="'.base_url('laymon/user/delete/'.$valueUser['id_user']).'"><button type="button" class="btn btn-sm btn-danger btn-flat">Hapus</button></a> <a href="'.base_url('laymon/user/reset/'.$valueUser['id_user']).'"><button type="button" class="btn btn-sm btn-info btn-flat">Reset</button></a></center>',
				);
			}
			$this->result['data'] = $dataUser;
		} else {
			$this->result['error'] = true;
			$this->result['message'] = 'Data Mobil tidak ditemukan';
			$this->result['data'] = null;
		}

		echo json_encode($this->result, JSON_PRETTY_PRINT);
	}

	public function masteruser_update(){
		$this->checkSession();

		// set validation rules
		$this->form_validation->set_rules('level', 'Level', 'trim|required|callback_customLevel');

		if ($this->form_validation->run() != false) {
			$id_user = $this->input->post('id');
			$level_user = $this->input->post('level');

			$dataInput_user = array(
				'id_user' => $id_user,
				'level_user' => $level_user
			);

			$modelInput_user = $this->user_model->updateData($dataInput_user);

			if ($modelInput_user) {
				$this->result['error'] = false;
				$this->result['message'] = 'Data user berhasil diupdate!';
				$this->result['data'] = $dataInput_user;
				$this->result['redirect'] = base_url('laymon/user');
			} else {
				$this->result['error'] = true;
				$this->result['message'] = 'Data user gagal diupdate!';
				$this->result['data'] = $dataInput_user;
				$this->result['redirect'] = base_url('laymon/user');
			}
		} else {
			$this->result['error'] = true;
			$this->result['errorMsg'] = $this->form_validation->error_array();
			$this->result['message'] = 'Data user gagal diupdate!';
			$this->result['data'] = null;
			$this->result['redirect'] = base_url('laymon/user');
		}

		echo json_encode($this->result, JSON_PRETTY_PRINT);
	}

	/*
	* Master Controller - Supir
	*/

	public function mastersupir_create(){
		$this->checkSession();

		// set validation rules
		$this->form_validation->set_rules('iduser', 'User ID', 'trim|required|numeric|is_unique[tb_supir.id_user]');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|callback_customValidation|max_length[70]');
		$this->form_validation->set_rules('nohp', 'No HP', 'trim|required|numeric|max_length[13]|is_unique[tb_supir.nohp_supir]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required|callback_customAlamat');

		if ($this->form_validation->run() != false) {
			$id_user = $this->input->post('iduser');
			$nama_supir = $this->input->post('nama');
			$nohp_supir = $this->input->post('nohp');
			$alamat_supir = $this->input->post('alamat');

			$dataInput_supir = array(
				'id_user' => $id_user,
				'nama_supir' => $nama_supir,
				'nohp_supir' => $nohp_supir,
				'alamat_supir' => $alamat_supir
			);

			$modelInput_supir = $this->mastersupir_model->simpanData($dataInput_supir);

			if ($modelInput_supir) {
				$this->result['error'] = false;
				$this->result['message'] = 'Data supir berhasil disimpan!';
				$this->result['data'] = $dataInput_supir;
				$this->result['redirect'] = base_url('laymon/supir');
			} else {
				$this->result['error'] = true;
				$this->result['message'] = 'Data supir gagal disimpan!';
				$this->result['data'] = $dataInput_supir;
				$this->result['redirect'] = base_url('laymon/supir');
			}
		} else {
			$this->result['error'] = true;
			$this->result['errorMsg'] = $this->form_validation->error_array();
			$this->result['message'] = 'Data supir gagal disimpan!';
			$this->result['data'] = null;
			$this->result['redirect'] = base_url('laymon/supir');
		}

		echo json_encode($this->result, JSON_PRETTY_PRINT);
	}

	public function mastersupir_read(){
		$this->checkSession();
		$modelRead_supir = $this->mastersupir_model->ambilData();

		if ($modelRead_supir) {
			$this->result['error'] = false;
			$this->result['message'] = 'Data Supir';

			foreach ($modelRead_supir as $valueSupir) {
				if ($valueSupir['id_user'] === 0 OR empty($valueSupir['id_user'])) {
					$userName = '';
				} else {
					$modelReadUsername_supir = $this->mastersupir_model->cariData_User($valueSupir['id_user']);
					
					if ($modelReadUsername_supir) {
						$userName = $modelReadUsername_supir[0]['username_user'];
					} else {
						$userName = '';
					}
				}

				$dataSupir[] = array(
					'id_supir' => $valueSupir['id_supir'],
					'id_user' => $valueSupir['id_user'],
					'nama_supir' => $valueSupir['nama_supir'],
					'nohp_supir' => $valueSupir['nohp_supir'],
					'alamat_supir' => character_limiter($valueSupir['alamat_supir'], 90, '...'),
					'username_user' => '<span class="badge badge-info">'.$userName.'</span> <a href="'.base_url('laymon/supir/upuser/'.$valueSupir['id_supir']).'"><i class="fas fa-edit"></i></a>',
					'action' => '<center><a href="'.base_url('laymon/supir/view/'.$valueSupir['id_supir']).'"><button type="button" class="btn btn-sm btn-warning btn-flat">Ubah</button></a> <a href="'.base_url('laymon/supir/delete/'.$valueSupir['id_supir']).'"><button type="button" class="btn btn-sm btn-danger btn-flat">Hapus</button></a></center>',
				);
			}
			$this->result['data'] = $dataSupir;
		} else {
			$this->result['error'] = true;
			$this->result['message'] = 'Data Supir tidak ditemukan';
			$this->result['data'] = null;
		}

		echo json_encode($this->result, JSON_PRETTY_PRINT);
	}

	public function mastersupir_update(){
		$this->checkSession();

		// set validation rules
		$this->form_validation->set_rules('id', 'Supir ID', 'trim|required|numeric');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|callback_customValidation|max_length[70]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required|callback_customAlamat');

		if ($this->input->post('nohp_old') === $this->input->post('nohp')) {
			$this->form_validation->set_rules('nohp', 'No HP', 'trim|required|numeric|max_length[13]');
		} else {
			$this->form_validation->set_rules('nohp', 'No HP', 'trim|required|numeric|max_length[13]|is_unique[tb_supir.nohp_supir]');
		}

		if ($this->form_validation->run() != false) {
			$id_supir = $this->input->post('id');
			$nama_supir = $this->input->post('nama');
			$nohp_supir = $this->input->post('nohp');
			$alamat_supir = $this->input->post('alamat');

			$dataUpdate_supir = array(
				'id_supir' => $id_supir,
				'nama_supir' => $nama_supir,
				'nohp_supir' => $nohp_supir,
				'alamat_supir' => $alamat_supir
			);

			$modelUpdate_supir = $this->mastersupir_model->updateData($dataUpdate_supir);

			if ($modelUpdate_supir) {
				$this->result['error'] = false;
				$this->result['message'] = 'Data supir berhasil diupdate!';
				$this->result['data'] = $dataUpdate_supir;
				$this->result['redirect'] = base_url('laymon/supir');
			} else {
				$this->result['error'] = true;
				$this->result['message'] = 'Data supir gagal diupdate!';
				$this->result['data'] = $dataUpdate_supir;
				$this->result['redirect'] = base_url('laymon/supir');
			}
		} else {
			$this->result['error'] = true;
			$this->result['errorMsg'] = $this->form_validation->error_array();
			$this->result['message'] = 'Data supir gagal diupdate!';
			$this->result['data'] = null;
			$this->result['redirect'] = base_url('laymon/supir');
		}

		echo json_encode($this->result, JSON_PRETTY_PRINT);
	}

	public function mastersupir_updateUser(){
		$this->checkSession();

		// set validation rules
		$this->form_validation->set_rules('id', 'Supir ID', 'trim|required|numeric');
		$this->form_validation->set_rules('iduser', 'User ID', 'trim|required|numeric|is_unique[tb_supir.id_user]');

		if ($this->form_validation->run() != false) {
			$id_supir = $this->input->post('id');
			$id_user = $this->input->post('iduser');

			$dataUpdateUser_supir = array(
				'id_supir' => $id_supir,
				'id_user' => $id_user
			);

			$modelUpdateUser_supir = $this->mastersupir_model->updateData($dataUpdateUser_supir);

			if ($modelUpdateUser_supir) {
				$this->result['error'] = false;
				$this->result['message'] = 'Data supir berhasil diupdate!';
				$this->result['data'] = $dataUpdateUser_supir;
				$this->result['redirect'] = base_url('laymon/supir');
			} else {
				$this->result['error'] = true;
				$this->result['message'] = 'Data supir gagal diupdate!';
				$this->result['data'] = $dataUpdateUser_supir;
				$this->result['redirect'] = base_url('laymon/supir');
			}
		} else {
			$this->result['error'] = true;
			$this->result['errorMsg'] = $this->form_validation->error_array();
			$this->result['message'] = 'Data supir gagal diupdate!';
			$this->result['data'] = null;
			$this->result['redirect'] = base_url('laymon/supir');
		}

		echo json_encode($this->result, JSON_PRETTY_PRINT);
	}

	/*
	* Master Controller - Pelanggan
	*/

	public function masterpelanggan_create(){
		$this->checkSession();

		// set validation rules
		$this->form_validation->set_rules('iduser', 'User ID', 'trim|required|numeric|is_unique[tb_supir.id_user]');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|callback_customValidation|max_length[70]');
		$this->form_validation->set_rules('nohp', 'No HP', 'trim|required|numeric|max_length[13]|is_unique[tb_supir.nohp_supir]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required|callback_customAlamat');

		if ($this->form_validation->run() != false) {
			$id_user = $this->input->post('iduser');
			$nama_pelanggan = $this->input->post('nama');
			$nohp_pelanggan = $this->input->post('nohp');
			$alamat_pelanggan = $this->input->post('alamat');

			$dataInput_pelanggan = array(
				'id_user' => $id_user,
				'nama_pelanggan' => $nama_pelanggan,
				'nohp_pelanggan' => $nohp_pelanggan,
				'alamat_pelanggan' => $alamat_pelanggan
			);

			$modelInput_pelanggan = $this->masterpelanggan_model->simpanData($dataInput_pelanggan);

			if ($modelInput_pelanggan) {
				$this->result['error'] = false;
				$this->result['message'] = 'Data pelanggan berhasil disimpan!';
				$this->result['data'] = $dataInput_pelanggan;
				$this->result['redirect'] = base_url('laymon/pelanggan');
			} else {
				$this->result['error'] = true;
				$this->result['message'] = 'Data pelanggan gagal disimpan!';
				$this->result['data'] = $dataInput_pelanggan;
				$this->result['redirect'] = base_url('laymon/pelanggan');
			}
		} else {
			$this->result['error'] = true;
			$this->result['errorMsg'] = $this->form_validation->error_array();
			$this->result['message'] = 'Data pelanggan gagal disimpan!';
			$this->result['data'] = null;
			$this->result['redirect'] = base_url('laymon/pelanggan');
		}

		echo json_encode($this->result, JSON_PRETTY_PRINT);
	}

	public function masterpelanggan_read(){
		$this->checkSession();
		$modelRead_pelanggan = $this->masterpelanggan_model->ambilData();

		if ($modelRead_pelanggan) {
			$this->result['error'] = false;
			$this->result['message'] = 'Data Pelanggan';

			foreach ($modelRead_pelanggan as $valuePelanggan) {
				if ($valuePelanggan['id_user'] === 0 OR empty($valuePelanggan['id_user'])) {
					$userName = '';
				} else {
					$modelReadUsername_pelanggan = $this->masterpelanggan_model->cariData_User($valuePelanggan['id_user']);
					
					if ($modelReadUsername_pelanggan) {
						$userName = $modelReadUsername_pelanggan[0]['username_user'];
					} else {
						$userName = '';
					}
				}

				$dataPelanggan[] = array(
					'id_pelanggan' => $valuePelanggan['id_pelanggan'],
					'id_user' => $valuePelanggan['id_user'],
					'nama_pelanggan' => $valuePelanggan['nama_pelanggan'],
					'nohp_pelanggan' => $valuePelanggan['nohp_pelanggan'],
					'alamat_pelanggan' => character_limiter($valuePelanggan['alamat_pelanggan'], 90, '...'),
					'username_user' => '<span class="badge badge-info">'.$userName.'</span> <a href="'.base_url('laymon/pelanggan/upuser/'.$valuePelanggan['id_pelanggan']).'"><i class="fas fa-edit"></i></a>',
					'action' => '<center><a href="'.base_url('laymon/pelanggan/view/'.$valuePelanggan['id_pelanggan']).'"><button type="button" class="btn btn-sm btn-warning btn-flat">Ubah</button></a> <a href="'.base_url('laymon/pelanggan/delete/'.$valuePelanggan['id_pelanggan']).'"><button type="button" class="btn btn-sm btn-danger btn-flat">Hapus</button></a></center>',
				);
			}
			$this->result['data'] = $dataPelanggan;
		} else {
			$this->result['error'] = true;
			$this->result['message'] = 'Data Pelanggan tidak ditemukan';
			$this->result['data'] = null;
		}

		echo json_encode($this->result, JSON_PRETTY_PRINT);
	}

	public function masterpelanggan_update(){
		$this->checkSession();

		// set validation rules
		$this->form_validation->set_rules('id', 'Supir ID', 'trim|required|numeric');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|callback_customValidation|max_length[70]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required|callback_customAlamat');

		if ($this->input->post('nohp_old') === $this->input->post('nohp')) {
			$this->form_validation->set_rules('nohp', 'No HP', 'trim|required|numeric|max_length[13]');
		} else {
			$this->form_validation->set_rules('nohp', 'No HP', 'trim|required|numeric|max_length[13]|is_unique[tb_pelanggan.nohp_pelanggan]');
		}

		if ($this->form_validation->run() != false) {
			$id_pelanggan = $this->input->post('id');
			$nama_pelanggan = $this->input->post('nama');
			$nohp_pelanggan = $this->input->post('nohp');
			$alamat_pelanggan = $this->input->post('alamat');

			$dataUpdate_pelanggan = array(
				'id_pelanggan' => $id_pelanggan,
				'nama_pelanggan' => $nama_pelanggan,
				'nohp_pelanggan' => $nohp_pelanggan,
				'alamat_pelanggan' => $alamat_pelanggan
			);

			$modelUpdate_pelanggan = $this->masterpelanggan_model->updateData($dataUpdate_pelanggan);

			if ($modelUpdate_pelanggan) {
				$this->result['error'] = false;
				$this->result['message'] = 'Data pelanggan berhasil diupdate!';
				$this->result['data'] = $dataUpdate_pelanggan;
				$this->result['redirect'] = base_url('laymon/pelanggan');
			} else {
				$this->result['error'] = true;
				$this->result['message'] = 'Data pelanggan gagal diupdate!';
				$this->result['data'] = $dataUpdate_pelanggan;
				$this->result['redirect'] = base_url('laymon/pelanggan');
			}
		} else {
			$this->result['error'] = true;
			$this->result['errorMsg'] = $this->form_validation->error_array();
			$this->result['message'] = 'Data pelanggan gagal diupdate!';
			$this->result['data'] = null;
			$this->result['redirect'] = base_url('laymon/pelanggan');
		}

		echo json_encode($this->result, JSON_PRETTY_PRINT);
	}

	public function masterpelanggan_updateUser(){
		$this->checkSession();

		// set validation rules
		$this->form_validation->set_rules('id', 'Supir ID', 'trim|required|numeric');
		$this->form_validation->set_rules('iduser', 'User ID', 'trim|required|numeric|is_unique[tb_pelanggan.id_user]');

		if ($this->form_validation->run() != false) {
			$id_pelanggan = $this->input->post('id');
			$id_user = $this->input->post('iduser');

			$dataUpdateUser_pelanggan = array(
				'id_pelanggan' => $id_pelanggan,
				'id_user' => $id_user
			);

			$modelUpdateUser_pelanggan = $this->masterpelanggan_model->updateData($dataUpdateUser_pelanggan);

			if ($modelUpdateUser_pelanggan) {
				$this->result['error'] = false;
				$this->result['message'] = 'Data pelanggan berhasil diupdate!';
				$this->result['data'] = $dataUpdateUser_pelanggan;
				$this->result['redirect'] = base_url('laymon/pelanggan');
			} else {
				$this->result['error'] = true;
				$this->result['message'] = 'Data pelanggan gagal diupdate!';
				$this->result['data'] = $dataUpdateUser_pelanggan;
				$this->result['redirect'] = base_url('laymon/pelanggan');
			}
		} else {
			$this->result['error'] = true;
			$this->result['errorMsg'] = $this->form_validation->error_array();
			$this->result['message'] = 'Data pelanggan gagal diupdate!';
			$this->result['data'] = null;
			$this->result['redirect'] = base_url('laymon/pelanggan');
		}

		echo json_encode($this->result, JSON_PRETTY_PRINT);
	}

	/*
	* Pengiriman Controller
	*/

	public function pengiriman_dataMap(){
		$this->checkSession();
		$idM = intval($this->input->post('id'));

		if (!empty($idM) AND is_numeric($idM)) {
			$modelRead_datamap = $this->pengiriman_model->dataMap_pelanggan($idM)[0];

			if ($modelRead_datamap) {
				$this->result['error'] = false;
				$this->result['message'] = 'Data Map Tujuan Pengiriman';
				$this->result['data'] = $modelRead_datamap;
			} else {
				$this->result['error'] = true;
				$this->result['message'] = 'Data Map tidak ditemukan';
				$this->result['data'] = null;
			}
		} else {
			$this->result['error'] = true;
			$this->result['message'] = 'Data ID kosong atau bukan angka!';
			$this->result['data'] = null;
		}

		echo json_encode($this->result, JSON_PRETTY_PRINT);
	}

	public function pengirimanCreated_read(){
		$this->checkSession();
		$modelRead_pengiriman = $this->pengiriman_model->ambilData_Status('Created');

		if ($modelRead_pengiriman) {
			$this->result['error'] = false;
			$this->result['message'] = 'Data Pengiriman';

			foreach ($modelRead_pengiriman as $valuePengiriman) {
				if ($valuePengiriman['id_mobil'] === 0 OR empty($valuePengiriman['id_mobil'])) {
					$nopol_mobil = '';
				} else {
					$modelReadNOPOL_mobil = $this->pengiriman_model->cariData_Mobil($valuePengiriman['id_mobil']);
					
					if ($modelReadNOPOL_mobil) {
						$nopol_mobil = $modelReadNOPOL_mobil[0]['nopol_mobil'];
					} else {
						$nopol_mobil = '';
					}
				}

				if ($valuePengiriman['id_pelanggan'] === 0 OR empty($valuePengiriman['id_pelanggan'])) {
					$nama_pelanggan = '';
				} else {
					$modelReadNAMA_pelanggan = $this->pengiriman_model->cariData_Pelanggan($valuePengiriman['id_pelanggan']);
					
					if ($modelReadNAMA_pelanggan) {
						$nama_pelanggan = $modelReadNAMA_pelanggan[0]['nama_pelanggan'];
					} else {
						$nama_pelanggan = '';
					}
				}

				if ($valuePengiriman['id_supir'] === 0 OR empty($valuePengiriman['id_supir'])) {
					$nama_supir = '';
				} else {
					$modelReadNAMA_supir = $this->pengiriman_model->cariData_Supir($valuePengiriman['id_supir']);
					
					if ($modelReadNAMA_supir) {
						$nama_supir = $modelReadNAMA_supir[0]['nama_supir'];
					} else {
						$nama_supir = '';
					}
				}

				$dataPengiriman[] = array(
					'id_mon' => $valuePengiriman['id_mon'],
					'kodejalan' => $valuePengiriman['kodejalan_mon'],
					'nopol' => $nopol_mobil,
					'supir' => $nama_supir,
					'pelanggan' => $nama_pelanggan,
					'start' => $valuePengiriman['start_mon'],
					'end' => '<button type="button" class="btn btn-sm btn-success btn-flat" onclick="return dataMap('.$valuePengiriman['id_mon'].')">Show</button>',
					'status' => '<span class="badge badge-info">'.$valuePengiriman['status_mon'].'</span>',
					'tanggal' => $valuePengiriman['tglbuat_user'],
					'action' => '<center><a href="'.base_url('laymon/pengiriman/created/agree/'.$valuePengiriman['id_mon']).'"><button type="button" class="btn btn-sm btn-success btn-flat">Approve</button></a></center>',
				);
			}
			$this->result['data'] = $dataPengiriman;
		} else {
			$this->result['error'] = true;
			$this->result['message'] = 'Data Pengiriman tidak ditemukan';
			$this->result['data'] = null;
		}

		echo json_encode($this->result, JSON_PRETTY_PRINT);
	}

	public function pengirimanConfirmed_read(){
		$this->checkSession();
		$modelRead_pengiriman = $this->pengiriman_model->ambilData_Status('Confirmed');

		if ($modelRead_pengiriman) {
			$this->result['error'] = false;
			$this->result['message'] = 'Data Pengiriman';

			foreach ($modelRead_pengiriman as $valuePengiriman) {
				if ($valuePengiriman['id_mobil'] === 0 OR empty($valuePengiriman['id_mobil'])) {
					$nopol_mobil = '';
				} else {
					$modelReadNOPOL_mobil = $this->pengiriman_model->cariData_Mobil($valuePengiriman['id_mobil']);
					
					if ($modelReadNOPOL_mobil) {
						$nopol_mobil = $modelReadNOPOL_mobil[0]['nopol_mobil'];
					} else {
						$nopol_mobil = '';
					}
				}

				if ($valuePengiriman['id_pelanggan'] === 0 OR empty($valuePengiriman['id_pelanggan'])) {
					$nama_pelanggan = '';
				} else {
					$modelReadNAMA_pelanggan = $this->pengiriman_model->cariData_Pelanggan($valuePengiriman['id_pelanggan']);
					
					if ($modelReadNAMA_pelanggan) {
						$nama_pelanggan = $modelReadNAMA_pelanggan[0]['nama_pelanggan'];
					} else {
						$nama_pelanggan = '';
					}
				}

				if ($valuePengiriman['id_supir'] === 0 OR empty($valuePengiriman['id_supir'])) {
					$nama_supir = '';
				} else {
					$modelReadNAMA_supir = $this->pengiriman_model->cariData_Supir($valuePengiriman['id_supir']);
					
					if ($modelReadNAMA_supir) {
						$nama_supir = $modelReadNAMA_supir[0]['nama_supir'];
					} else {
						$nama_supir = '';
					}
				}

				$dataPengiriman[] = array(
					'id_mon' => $valuePengiriman['id_mon'],
					'kodejalan' => $valuePengiriman['kodejalan_mon'],
					'nopol' => $nopol_mobil,
					'supir' => $nama_supir,
					'pelanggan' => $nama_pelanggan,
					'start' => $valuePengiriman['start_mon'],
					'end' => '<button type="button" class="btn btn-sm btn-success btn-flat" onclick="return dataMap('.$valuePengiriman['id_mon'].')">Show</button>',
					'status' => '<span class="badge badge-info">'.$valuePengiriman['status_mon'].'</span>',
					'tanggal' => $valuePengiriman['tglbuat_user'],
					'action' => '<center><a href="'.base_url('laymon/pengiriman/confirmed/agree/'.$valuePengiriman['id_mon']).'"><button type="button" class="btn btn-sm btn-success btn-flat">Approve</button></a></center>',
				);
			}
			$this->result['data'] = $dataPengiriman;
		} else {
			$this->result['error'] = true;
			$this->result['message'] = 'Data Pengiriman tidak ditemukan';
			$this->result['data'] = null;
		}

		echo json_encode($this->result, JSON_PRETTY_PRINT);
	}
}