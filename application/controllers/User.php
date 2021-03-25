<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User class.
 *
 * @extends CI_Controller
 */
class User extends CI_Controller {

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
	 * login function.
	 *
	 * @access public
	 * @return void
	 */
	public function login() {
		// check session
		if($this->session->userdata('logged_in') === TRUE AND $this->session->userdata('role') === 'Admin'){
			redirect(base_url("laymon"), 'refresh');
		} elseif ($this->session->userdata('logged_in') === TRUE AND $this->session->userdata('role') === 'Supir') {
			redirect(base_url("supir"), 'refresh');
		} elseif ($this->session->userdata('logged_in') === TRUE AND $this->session->userdata('role') === 'Pelanggan') {
			redirect(base_url("dashboard"), 'refresh');
		}

		// create the data object
		$data = new stdClass();

		// set validation rules
		$this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_numeric|min_length[5]|max_length[20]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');

		if ($this->form_validation->run() == false) {
			$this->load->view('user/login', $data);

		} else {

			// set variables from the form
			$username = addslashes($this->input->post('username'));
			$password = addslashes($this->input->post('password'));

			if ($this->user_model->resolve_user_login($username, $password)) {

			  $user_id = $this->user_model->get_user_id_from_username($username);
			  $user = $this->user_model->get_user($user_id);

			  // set session user datas
			  $data_session = array(
			    'user_id' => intval($user->id_user),
			    'username' => addslashes($user->username_user),
			    'role' => addslashes($user->level_user),
			    'logged_in' => TRUE
			  );
			  $this->session->set_userdata($data_session);

			  // check role for redirect
			  if ($user->level_user == 'Admin') {
			    redirect(base_url('laymon'), 'refresh');
			  } elseif ($user->level_user == 'Supir') {
			    redirect(base_url('supir'), 'refresh');
			  } elseif ($user->level_user == 'Pelanggan') {
			    redirect(base_url('dashboard'), 'refresh');
			  }
			} else {
			  // login failed
			  $data->error = 'Wrong username or password.';

			  // send error to the view
			  $this->load->view('user/login', $data);
			}

		}

	}

	/**
	 * logout function.
	 *
	 * @access public
	 * @return void
	 */
	public function logout() {
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === TRUE) {
			// remove session datas
			foreach ($_SESSION as $key => $value) {
				unset($_SESSION[$key]);
			}

			// user logout ok
			redirect(base_url('login'), 'refresh');
		} else {
			// there user was not logged in, we cannot logged him out,
			// redirect him to site root
			redirect('/');
		}
	}
}