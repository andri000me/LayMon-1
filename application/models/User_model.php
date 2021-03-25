<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User_model class.
 *
 * @extends CI_Model
 */
class User_model extends CI_Model {
	protected $tabel = 'tb_user';
	/**
	 * __construct function.
	 *
	 * @access public
	 * @return void
	 */

	public function __construct() {
		parent::__construct();
	}

	/**
	 * create_user function.
	 *
	 * @access public
	 * @param mixed $username
	 * @param mixed $password
	 * @return bool true on success, false on failure
	 */
	public function create_user($username, $password, $level) {

		$dataMasuk = array(
			'username_user' => $username,
			'password_user' => $this->hPass($password),
			'level_user' => $level,
		);

		return $this->db->insert($this->tabel, $dataMasuk);

	}

	/**
	 * resolve_user_login function.
	 *
	 * @access public
	 * @param mixed $username
	 * @param mixed $password
	 * @return bool true on success, false on failure
	 */
	public function resolve_user_login($username, $password) {

		$this->db->select('password_user');
		$this->db->from($this->tabel);
		$this->db->where('username_user', $username);
		$hash = $this->db->get()->row('password_user');

		return $this->verify_password_hash($password, $hash);

	}

	/**
	 * get_user_id_from_username function.
	 *
	 * @access public
	 * @param mixed $username
	 * @return int the user id
	 */
	public function get_user_id_from_username($username) {

		$this->db->select('id_user');
		$this->db->from($this->tabel);
		$this->db->where('username_user', $username);

		return $this->db->get()->row('id_user');

	}

	/**
	 * get_user function.
	 *
	 * @access public
	 * @param mixed $user_id
	 * @return object the user object
	 */
	public function get_user($user_id) {

		$this->db->from($this->tabel);
		$this->db->where('id_user', $user_id);
		return $this->db->get()->row();

	}

	public function akunTersedia(){
        $query = $this->db->query("SELECT * FROM tb_user WHERE id_user NOT IN(SELECT id_user FROM tb_supir) AND id_user NOT IN(SELECT id_user FROM tb_pelanggan) AND level_user != 'Admin'");

        return $query->result_array();
    }

	/**
	 * hPass function.
	 *
	 * @access private
	 * @param mixed $password
	 * @return string|bool could be a string on success, or bool false on failure
	 */
	private function hPass($password) {

		return password_hash($password, PASSWORD_DEFAULT);

	}

	/**
	 * verify_password_hash function.
	 *
	 * @access private
	 * @param mixed $password
	 * @param mixed $hash
	 * @return bool
	 */
	private function verify_password_hash($password, $hash) {

		return password_verify($password, $hash);

	}

}